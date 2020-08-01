<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index(){
        //$posts = Post::All(); 
        $posts = auth()->user()->posts()->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }
    public function show(Post $post){  
        $this->authorize('show', $post );
        return view('blog-post', compact('post'));
    }
    public function create(){ 
        $this->authorize('create', Post::class );
        return view('admin.posts.create');
    }
    public function store(Request $request){
        $this->authorize('create', Post::class );
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body'  => 'required|min:8'
        ]); 

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);
        session()->flash('message-success', $inputs['title'] . ' was created'); 
        return redirect()->route('post.index');
    }
    public function destroy(Post $post){
        $this->authorize('delete', $post );
        $post->delete();
        session()->flash('message', 'Post was deleted'); 
        return back();
    }
    public function edit(Post $post){
        return view('admin.posts.edit', compact('post'));
    }
    public function update(Post $post){
        $this->authorize('update', $post );
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body'  => 'required|min:8'
        ]);  
        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
       
        $post->save();
        session()->flash('message-success', $inputs['title'] . ' was edited'); 
        return redirect()->route('post.index');
    }
}
