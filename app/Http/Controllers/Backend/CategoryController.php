<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\SlugGenerator;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    use SlugGenerator;


    function viewCategory()
    {
        $categories = Category::latest()->paginate(20);
        $editCategory = null;
        return view('backend.categories.viewCategory', compact('categories', 'editCategory'));
    }


    function storeCategory(Request $request)
    {

        $category = new Category();
        $category->title = $request->title;
        $category->slug = $this->generateSlug($request->title, Category::class);
        $category->save();
        return back();
    }



    function editCategory($slug){
        $categories = Category::latest()->paginate(4);

        $editCategory = Category::where('slug', $slug)->first();

        return view('backend.categories.viewCategory', compact('categories', 'editCategory'));
    }


    function updateCategory(Request $request,$slug) {
        $editCategory = Category::where('slug', $slug)->first();
        $editCategory->title = $request->title;
        $editCategory->save();
        return redirect()->route('category.show');
    }


    function deleteCategory($id) {
        Category::find($id)->delete();
        return back();
    }
}
