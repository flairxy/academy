<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Content;
use App\Subscription;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Course;
use App\Gallery;

class ContentController extends Controller
{
    public function index()
    {
        return Content::all();
    }

    public function contents($user_id, $course_id)
    {
        $current_date = Carbon::now();
        $contents = Content::whereCourseId($course_id)->get();
        $course = Course::findOrFail($course_id);
        $subscriptions = Subscription::where('user_id', $user_id)->whereCategoryId($course->category_id)->get();

        if ($subscriptions) {
            foreach ($subscriptions as $subscription) {

                if ($current_date <= $subscription->expires_at) {
                    return $contents;
                }
                return $contents->makeHidden(['url']);
            }
        }
        return $contents->makeHidden(['url']);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'description' => 'max:155',
            'duration' => 'required',
            'course_id' => 'required',
            'url' => 'required'
        ]);

        $content = new Content();
        $content->duration = $request->duration;
        $content->description = $request->description;
        $content->url = $request->url;
        $content->course_id = $request->course_id;
        $content->save();

        return response('content created successfully');
    }

    public function edit($id)
    {
        $content = Content::findOrFail($id);
        return $content;
    }

    public function update(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $content->duration = $request->duration;
        $content->description = $request->description;
        $content->url = $request->url;
        $content->course_id = $request->course_id;
        $content->save();

        return response('content updated successfully');
    }
    public function delete($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();
        return response('content deleted successfully');
    }

    public function upload(Request $request)

    {

        $this->validate($request, [

            'filename' => 'required|array',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        if ($request->hasFile('filename')) {

            foreach ($request->file('filename') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/gallery/', $name);
                $gallery = new Gallery();
                $gallery->name = $name;
                $gallery->save();
            }
        }
        return response('Your images has been successfully uploaded');
    }

    public function getImages(){
        return Gallery::all();
    }

    public function deleteFile($id){
        $file = Gallery::findOrFail($id);
        $file->delete();

        return response('File deleted');
    }
}
