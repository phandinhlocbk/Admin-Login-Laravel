<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    //

    public function index() {
        // $posts = Post::all();
        $posts=auth()->user()->posts()->paginate(5);
        return view('admin.posts.index',['posts'=>$posts]);
    }

    public function destroy(Post $post) {
        $post -> delete();

        Session::flash('message', 'Post was deleted');
        return back();
    }

    public function edit(Post $post) {
        $this->authorize('view', $post);
        return view('admin.posts.edit',['post'=>$post]);
    }

    public function update(Post $post) {
        $data = request()->validate([
            'title' => 'required|min:8|max:255',
            'body'=>'required',
        ]);
        $this->authorize('update', $post);
        $post->fill([
            'title' => $data['title'],
            'body' => $data['body']
        ])->save();

        
        session()->flash('post-updated-message', 'Post with title was updated'.$data['title']);
        return redirect()->route('posts.index');
    } 


    public function show(Post $post) {
        return view('layouts.blog-post', ['post'=> $post]);
    }

    public function create() {
    
        return view('admin.posts.create');
    }

    public function store(Request $request) {
        $data = request()->validate([
            'title' => 'required|min:8|max:255',
            'body'=>'required',
        ]);
       
        auth()->user()->posts()->create($data);
        Session()->flash('post-createdmessage', 'Post awas created');

        return back();
    }
}
