<?php

namespace App\Http\Controllers\Dash;

use App\Models\Category;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            ['nummber' => 0 , 'color' => 'secondary' , 'route' => 'posts.index' , 'name' => 'Posts'] ,
            ['nummber' => 0 , 'color' => 'primary' , 'route' => 'posts.withtrashed' , 'name' => 'Total Posts'] ,
            ['nummber' => 0 , 'color' => 'success' , 'route' => 'trashed.index' , 'name' => 'Trashed Posts'],
            ['nummber' => 0 , 'color' => 'info' , 'route' => 'comment.index' , 'name' => 'Comments'],
            ['nummber' => 0 , 'color' => 'warning' , 'route' => 'users.index' , 'name' => 'Users'],
            ['nummber' => 0 , 'color' => 'danger' , 'route' => 'tags.index' , 'name' => 'Tags'],
            ['nummber' => 0 , 'color' => 'secondary' , 'route' => 'categories.index' , 'name' => 'Categories']
        ];

        if (auth()->user()->IsAdmin()) {
            $data[0]['nummber'] = Post::all()->count();
            $data[1]['nummber'] = Post::withTrashed()->GET()->count();
            $data[2]['nummber'] = Post::onlyTrashed()->get()->count();
            $data[3]['nummber'] = Comment::all()->count();
            $data[4]['nummber'] = User::all()->count();
            $data[5]['nummber'] = Tag::all()->count();
            $data[6]['nummber'] = Category::all()->count();
            return view('dashboard.index')->with('data' , $data);
        }else{
            $data[0]['nummber'] = Post::where('user_id' ,auth()->user()->id )->get()->count();
            $data[1]['nummber'] = Post::where('user_id' ,auth()->user()->id )->withTrashed()->get()->count();
            $data[2]['nummber'] = Post::where('user_id' ,auth()->user()->id )->onlyTrashed()->get()->count();
            $data[3]['nummber'] = Comment::where('user_id' ,auth()->user()->id )->get()->count();
            return view('dashboard.index')->with('data' , array_slice($data, 0 , 4));

        }

    }
}
