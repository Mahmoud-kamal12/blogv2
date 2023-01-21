<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\tags\storeValidation;
use App\Http\Requests\tags\updateValidation;
use App\Models\Tag;
use Illuminate\Http\Request;

class tagController extends Controller
{

    public function __construct()
    {
        $this->middleware('vertifyisadmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.tags.index')->with('tags',Tag::orderBy('updated_at','DESC')->paginate(10)->onEachSide(0));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeValidation $request)
    {
        Tag::create($request->all());
        session()->flash('success' , 'Tag Added successfuly');
        return redirect(route('tags.index'));
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
    public function edit(Tag $tag)
    {
        return view('dashboard.tags.create')->with('tag' , $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateValidation $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name,
        ]);

        session()->flash('success' , "Tag Updated successfuly");
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        session()->flash('success' , "Tag Deleted successfuly");
        return redirect(route('tags.index'));
    }
}
