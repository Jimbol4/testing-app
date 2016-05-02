<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use Auth;

class PostsController extends Controller
{
    public function index() {
        $posts = Post::all();
        
        return view('posts.index', compact('posts'));
    }
    
    public function create() {
        return view('posts.create');
    }
    
    public function store(PostRequest $request) {
        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        
        $post->save();
        
        return redirect('posts');
        
    }
}
