<?php

namespace App\Http\Controllers\Dash;


use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function __construct()
    {

    }

    public function index(){
        return view('blog.welcome')->with('posts' , Post::orderBy('updated_at','DESC')->paginate(15)->fragment('posts')->onEachSide(0));
    }

    public function show(Post $post){
        $comments = $post->comments()->orderBy('updated_at','DESC')->paginate(5)->onEachSide(0);
        return view('blog.post')->with('post' , $post)->with('comments' , $comments);
    }

    public function showProfile(){

        $posts = Post::where('user_id' , auth()->user()->id)->orderBy('updated_at','DESC')->paginate(5)->fragment('posts')->onEachSide(0);

        return view('blog.profile')->with('user',auth()->user())->with('posts' , $posts);
    }

    public function publisherprofile($id){

        $posts = Post::where('user_id' , $id)->orderBy('updated_at','DESC')->paginate(5)->fragment('posts')->onEachSide(0);

        $user = User::findOrFail($id);

        return view('blog.profile')->with('user',$user)->with('posts' , $posts);
    }
}
