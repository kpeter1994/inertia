<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;


class PostController extends Controller
{
    public function index()
    {
        /*sleep(3);*/
        /*Átalakítjuk Kollekcióvá, hogy ne adjon át mindent*/
        $posts = PostResource::collection(Post::latest()->take(5)->get());

        return inertia ('Post/Index', compact('posts'));
    }

    public function create(){
        return inertia('Post/Create');
    }

    public function store(StorePostRequest $request){

        Post::create($request->validated());

        return redirect()->route('posts.index')->with('message', 'Post create successfully!');

    }

    public function destroy(Post $post){
        $post->delete();

        return redirect()->route('posts.index')->with('message','Post delete successfully');
    }

    public function edit(Post $post)
    {

        return inertia('Post/Edit', compact('post'));
    }

    public function update(StorePostRequest $request, Post $post){

        $post->update($request->validated());

        return redirect()->route('posts.index')->with('message', 'Post updated successfully!');
    }
}
