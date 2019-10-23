<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    public function index(){
        return Category::all();
    }

    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'amount' => 'required|min:1',
            'duration' => 'required',
        ]);

        Category::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'duration' => $request->duration
        ]);
        return response('Category created');
    }

    public function update(Request $request, $id){
        Category::whereId($id)->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'duration' => $request->duration
        ]);
        return response('Category updated');
    }

    public function delete($id){
        $category = Category::findOrFail($id);
        $category->delete();

        return response('category deleted');
    }
}
