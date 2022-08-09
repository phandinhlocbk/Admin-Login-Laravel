<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Post;
use App\Models\User;


class PostController extends Controller
{
    //
    public function index() {
        //$posts = auth()->user()->posts;
        $posts = Post::all();
       
        return view('admin.posts.index', ['posts'=>$posts]);
    }

    public function show(Post $post) {
        return view('layouts.blog-post', ['post'=>$post]);
    }

    public function destroy(Post $post) {
        $post->delete();
        Session::flash('message','Post awas deleted');
        return back();
    }

    public function edit(Post $post){
        $this->authorize('view', $post);
        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function update(Post $post, Request $request) {
        $inputs = $request->validate([
            'title'=>'required|min:8|max:255',
            'post_image' => 'file',
            'body'=>'required'
        ]);
        
        if(request('post_image')) {
           $inputs['post_image'] = $request->file('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $this->authorize('update');

        auth()->user()->posts()->save($post);

        Session::flash('post-update','Post awas created');

        return redirect()->route('posts.index');

    }


    public function create() {
        return view('admin.posts.create');
    }
    public function store(Request $request){
        $inputs = $request->validate([
            'title'=>'required|min:8|max:255',
            'post_image' => 'file',
            'body'=>'required'
        ]);
        
        if(request('post_image')) {
           $inputs['post_image'] = $request->file('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);

        Session::flash('post-create','Post awas created');

        return redirect()->route('posts.index');
    }

}
