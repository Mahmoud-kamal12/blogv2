<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\pots\storeValidation as PotsStoreValidation;
use App\Http\Requests\pots\updateValidation;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Mockery\Expectation;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class postController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkcategory')->only('create');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->IsAdmin()) {
            return view('dashboard.posts.index')->with('posts' , Post::orderBy('updated_at','DESC')->paginate(10)->onEachSide(0));
        }else{
            return view('dashboard.posts.index')->with('posts' , Post::where('user_id', '=', auth()->user()->id)->orderBy('updated_at','DESC')->paginate(15)->onEachSide(0));
        }

    }

    public function withtrashed()
    {
        if (auth()->user()->IsAdmin()) {
            return view('dashboard.posts.index')->with('posts' , Post::withTrashed()->orderBy('updated_at','DESC')->paginate(10));
        }else{
            return view('dashboard.posts.index')->with('posts' , Post::withTrashed()->where('user_id', '=', auth()->user()->id)->orderBy('updated_at','DESC')->paginate(15));
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Category::find(1)->posts);
        return view('dashboard.posts.create')->with('categories' , Category::all())->with('tags' , Tag::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PotsStoreValidation $request)
    {

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' =>$request->content,
            'image' => Helper::uploadImage($request , new Post()),
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id
        ]);
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        session()->flash('success' , "Post Added successfuly");

        return redirect(route('posts.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->IsAdmin()){
            $post = Post::withTrashed()->where('id',$id)->first();
        }else{
            $post = Post::withTrashed()->where('id',$id)->where('user_id' , auth()->user()->id)->first();
        }
        if($post == null ){
            abort(404);
        }
        return view('dashboard.posts.create' ,
            ['post' => $post ,
            'categories' => Category::all() ,
            'tags' => Tag::all()]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateValidation $request, $id)
    {
        $data = $request->only(['title', 'description', 'content' , 'category_id']);

        if(auth()->user()->IsAdmin()){
            $post = Post::withTrashed()->where('id',$id)->first();
        }else{
            $post = Post::withTrashed()->where('id',$id)->where('user_id' , auth()->user()->id)->first();
        }
        if($post == null ){
            abort(404);
        }

        if($path = Helper::uploadImage($request , $post , true)){
            $data['image'] = $path;
        }


        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        $post->update($data);

        session()->flash('success' , "Post Updated successfuly");

        if ($post->trashed()) {
            return redirect(route('trashed.index'));
        }

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::withTrashed()->where('id' , $id)->first();

        if ($posts->trashed()) {

            Storage::disk('public')->delete($posts->image);

            $posts->forceDelete();
            session()->flash('success' , "Post Deleted successfuly");
            $trashed = Post::onlyTrashed()->where('user_id', '=', auth()->user()->id)->orderBy('updated_at','DESC')->paginate(15);
            return redirect(route('trashed.index'));

        }else {

            $posts->delete();
            session()->flash('success' , "Post Trashed successfuly");
            return redirect (route('posts.index'));

        }

    }


    public function trashed()
    {
        if (auth()->user()->IsAdmin()) {
            $trashed = Post::onlyTrashed()->orderBy('updated_at','DESC')->paginate(15);

            return view('dashboard.posts.index' )->with('posts' , $trashed);
        }else{
            $trashed = Post::onlyTrashed()->orderBy('updated_at','DESC')->where('user_id', '=', auth()->user()->id)->paginate(15);
            return view('dashboard.posts.index')->with('posts' , $trashed);

        }


    }

    public function restore($post)
    {

        Post::withTrashed()->where('id',$post)->restore();

        session()->flash('success' , "Post Restored successfuly");

        return redirect(route('posts.index'));
    }

}
