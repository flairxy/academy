<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Excludable;


class Content extends Model
{
    use Excludable;

    protected $fillable = ['course_id', 'description', 'url', 'duration'];

}
