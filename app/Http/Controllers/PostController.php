<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{

    public function home(){
        $posts=Post::get();
        return view('dashboard',compact('posts'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=auth()->user()->posts;
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post=new Post;

        $post->title=$request->title;
        $post->content=$request->content;
        $post->user_id=auth()->user()->id;
        $post->save();

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post= Post::findOrFail($id);
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post= Post::findOrFail($id);
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $post= Post::findOrFail($id);
        $post->title=$request->title;
        $post->content=$request->content;
        $post->save();

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post= Post::findOrFail($id);
        $post->delete();
        return response(['status'=>'success','message'=>'the post deleted successfully']);
    }
}
