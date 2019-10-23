<?php

namespace App\Http\Controllers\API\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Subscription;
use Carbon\Carbon;

class CoursesController extends Controller
{
    public function index()
    {
        return Course::all();
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'max:100',
            'category_id' => 'required',
        ]);
        $category = Category::findOrFail($request->category_id);
        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->category_id = $request->category_id;
        $course->amount = $category->amount;
        $course->save();

        return response('course category created successfully');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return $course;
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($request->category_id);
        $course = Course::findOrFail($id);
        $course->title = $request->title;
        $course->description = $request->description;
        $course->category_id = $request->category_id;
        $course->amount = $category->amount;
        $course->save();

        return response('course category updated successfully');
    }
    public function delete($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return response('course category deleted successfully');
    }

    //return courses based on users subscription
    public function userCourses($id)
    {
        // get user subscriptions
        $subscriptions = Subscription::where('user_id', $id)->get();
        $current_date = Carbon::now();
        // check if subscription exists
        if ($subscriptions) {
            //loop through each subscription
            foreach ($subscriptions as $subscription) {

                //check if subscription has expired
                if ($current_date <= $subscription->expires_at) {
                    //return courses that fal into the subscription category
                    $courses = Course::whereCategoryId($subscription->category_id)->get();
                    return $courses;
                }

                return response('You have no active subscription');
            }
        }
    }
}
