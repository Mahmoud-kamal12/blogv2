<?php

namespace App\Http\Controllers\Dash;


use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->IsAdmin()) {
            $comments = Comment::orderBy('updated_at','DESC')->paginate(10)->onEachSide(0);
            return view('dashboard.comments.index')->with('comments',$comments);
        }

        $comments = Comment::where('user_id' , auth()->user()->id)->orderBy('updated_at','DESC')->paginate(10)->onEachSide(0);
        return view('dashboard.comments.index')->with('comments',$comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required',
            'post_id' => 'exists:posts,id'
        ]);
        $validated['user_id'] = auth()->user()->id;
        Comment::create($validated);
        return redirect(route('show.post' , Post::find($validated['post_id'])));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        session()->flash('success' , "Comment Deleted successfuly");
        return redirect()->back();
    }
}
