<?php

namespace App\Http\Controllers\API\User;

use App\Category;
use App\Http\Controllers\Controller;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $user->dob = $request->dob;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->address = $request->address;
        $user->instagram = $request->instagram;
        $user->save();

        return response('profile update successful');
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed|max:255',
            'old_password' => 'required|max:255',
        ]);

        $user = User::findOrFail($id);
        $hashedPassword = $user->password;

        if (Hash::check($request->old_password, $hashedPassword) && !Hash::check($request->password, $hashedPassword)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return response([
                'status' => 'success',
                'message' => 'Password update successful'
            ]);
        }
        return response([
            'status' => 'error',
            'message' => 'Failed to update password. Check provided information'
        ]);
    }

    public function activeSubscriptions($id)
    {
        $subscriptions = Subscription::whereUserId($id)->whereStatus(1)->get();
        $sub_catId = Subscription::whereUserId($id)->pluck('category_id');
        $categories = Category::whereIn('id', $sub_catId)->get();
        return [
            'subscriptions' => $subscriptions,
            'categories' => $categories
        ];
    }
}
