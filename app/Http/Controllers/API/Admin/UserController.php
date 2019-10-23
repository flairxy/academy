<?php

namespace App\Http\Controllers\API\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Subscription;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return User::whereRole(0)->get();
    }

    public function user($id)
    {
        return User::findOrFail($id);
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->all());
        $user->save();

        return response('user updated');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response('user deleted successfully');
    }

    public function updatePassword(Requst $request, $id)
    {
        $user = User::findOrFail($id);

        return response('password updated successfully');
    }

    public function subscriptions()
    {

        $subscriptions = Subscription::whereStatus(1)->get();
        $sub_catId = Subscription::pluck('category_id');
        $categories = Category::whereIn('id', $sub_catId)->get();
        return [
            'subscriptions' => $subscriptions,
            'categories' => $categories
        ];
    }

    public function deleteSub($id)
    {
        $sub = Subscription::findOrFail($id);
        $sub->delete();

        return response('Subscription deleted');
    }
}
