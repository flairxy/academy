<?php

namespace App\Model\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use function config;
use function normalizePath;
use function storage_path;

trait IsFileModel
{

    protected static function bootIsFileModel()
    {
        static::creating(function ($model) {
            $model->disk = config('filesystems.default');
            return true;
        });
    }

    /**
     * @param $hash
     *
     * @return mixed
     */
    public static function findByHash($hash)
    {
        return self::where('hash', $hash);
    }

    /**
     * @param bool $with_ext
     *
     * @return mixed|string
     */
    public function basename($with_ext = true)
    {
        $basename = basename($this->path);

        return $with_ext ? $basename : str_replace('.' . $this->extension(), '', $basename);
    }

    /**
     * @return mixed
     */
    public function extension()
    {
        $parts = explode('.', basename($this->path));
        return $parts[count($parts) - 1];
    }

    /**
     * @return void
     */
    public abstract function cleanUp();

    /**
     *
     */
    public function hardDelete()
    {
        $this->cleanUp();
        $this->forceDelete();
    }

    /**
     * @param $type
     *
     * @return array|mixed
     */
    public abstract static function extensions($type);

    /**
     * @return mixed
     */
    public function isOnLD()
    {
        return Storage::disk('local')->exists($this->path);
    }

    /**
     * @return mixed
     */
    public function isOnS3()
    {
        return Storage::disk('s3')->exists($this->path);
    }

    /**
     * @return mixed
     */
    public function isOnTemp()
    {
        return Storage::disk('temp')->exists($this->path);
    }

    public function fileExists()
    {
        return $this->getDriver()->exists($this->path);
    }

    public function copyToLD($deleteOriginal = false)
    {
        if (!$this->isOnLD() && $this->fileExists()) {
            Storage::disk('local')->put($this->path, $this->getDriver()->get($this->path));
            if ($deleteOriginal) {
                $this->getDriver()->delete($this->path);
            }
        }
    }

    public function copyToS3($deleteOriginal = false)
    {
        if (!$this->isOnS3() && $this->fileExists()) {
            Storage::disk('s3')->put($this->path, $this->getDriver()->get($this->path));
            if ($deleteOriginal) {
                $this->getDriver()->delete($this->path);
            }
        }
    }

    public function copyToTemp()
    {
        if (!$this->isOnTemp() && $this->fileExists()) {
            Storage::disk('temp')->put($this->path, $this->getDriver()->get($this->path));
        }
    }

    public function getTempDirPath($copyToTemp = true)
    {
        if ($copyToTemp) {
            $this->copyToTemp();
        }
        return normalizePath(Storage::disk('temp')->path($this->path));
    }

    public function fixLocation()
    {
        if ($this->disk === 'local') {
            $this->copyToLD(true);
        } elseif ($this->disk === 's3') {
            $this->copyToS3(true);
        }
    }

    /**
     * Rearrange file
     */
    public function __destruct()
    {
        $this->fixLocation();
    }

    public static function cleanTemp($oldOnly = true, $expire = 1440)
    {
        return self::deleteDir(storage_path('app/temp'), $oldOnly, $expire);
    }

    public static function deleteDir($dirPath, $oldOnly = true, $expire = 1440)
    {
        if (!is_dir($dirPath)) {
            return [0, 0];
        }

        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }

        $count = 0;
        $ignoredFiles = 0;
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                list($subCount, $subIgnoredFiles) = self::deleteDir($file, $oldOnly, $expire);
                $count += $subCount;
                $ignoredFiles += $subIgnoredFiles;
            } else {
                $time = filectime($file);
                if ($oldOnly) {
                    $old = Carbon::createFromTimestamp($time)
                                    ->addMinutes($expire)->isPast();
                    if ($old) {
                        unlink($file);
                        $count++;
                    } else {
                        $ignoredFiles++;
                    }
                } else {
                    unlink($file);
                    $count++;
                }
            }
        }
        //Remove if no ignore file
        $ignoredFiles ?: rmdir($dirPath);
        return [$count, $ignoredFiles];
    }

    public function getDriver($location = null)
    {
        if (!$location) {
            $location = $this->disk ?: 's3';
        }
        
        if ($location !== 's3' || empty($this->oer_bucket)) {
            return Storage::disk($location);
        }

        return Storage::createS3Driver([
                    'driver' => 's3',
                    'key' => config('filesystems.disks.s3.key'),
                    'secret' => config('filesystems.disks.s3.secret'),
                    'region' => config('filesystems.disks.s3.region'),
                    'bucket' => $this->oer_bucket,
        ]);
    }

}
