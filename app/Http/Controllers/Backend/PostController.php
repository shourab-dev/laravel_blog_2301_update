<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Helpers\SlugGenerator;
use App\Http\Controllers\Controller;
use App\Http\Helpers\MediaUploader;

class PostController extends Controller
{
    use SlugGenerator, MediaUploader;
    function addPost()
    {

        $categories = Category::latest()->get();
        $subCategories = SubCategory::latest()->get();
        return view('backend.posts.addPost', compact('categories', 'subCategories'));
    }


    function storePost(Request $request)
    {
        $title = $this->generateSlug($request->title, Post::class);
        $fileName = $this->uploadSingleMedia($title, $request->featuredImg);


        $post = new Post();
        $post->title = $request->title;
        $post->slug = $title;
        $post->user_id = auth()->user()->id;
        $post->category_id = $request->category;
        $post->sub_category_id = $request->subcategory;
        $post->featured_img = $fileName;
        $post->content = $request->content;

        $post->save();
        notify()->success('Welcome to Laravel Notify ⚡️');
        return back();
    }

    function getAllPost() {
        $posts = Post::where('user_id', auth()->user()->id)->get();
        return view('backend.posts.allPost', compact('posts'));
    }
}
