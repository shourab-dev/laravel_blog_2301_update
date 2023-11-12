<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\SlugGenerator;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{

use SlugGenerator;


    function
    viewSubCategory()
    {
        //*SUBCATEGORY
        $subcategories = SubCategory::with('category')->get();
        // dd($subcategories);



        $categories = Category::with("subcategories")->select('id', 'title')->latest()->get();
        
        return view('backend.categories.viewSubCategory', compact('categories','subcategories'));
    }

    function storeSubCategory(Request $request){
       
        $sub  = new SubCategory();
        $sub->category_id = $request->category_id;
        $sub->title = $request->title;
        $sub->slug = $this->generateSlug($request->title, SubCategory::class);
        $sub->save();
        return back();


    }



    function getSubCategory(Request $request) {
       $subcategories = SubCategory::where('category_id', $request->categoryId )->get();
       return $subcategories;
    }

}
