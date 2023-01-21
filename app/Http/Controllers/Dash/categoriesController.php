<?php

namespace App\Http\Controllers\Dash;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\categories\storeValidation;
use App\Http\Requests\categories\updateValidation;
use Illuminate\Http\Request;

class categoriesController extends Controller
{


        /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        return view('dashboard.categories.index')->with('categories',Category::paginate(10)->onEachSide(0));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\storeValidation  $request
     * @return \Illuminate\Http\Response
     */

    public function store(storeValidation $request)
    {
        // $category = new Category();
        Category::create($request->all());
        session()->flash('success' , 'Category Added successfuly');
        return redirect(route('categories.index'));
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
    public function edit(Category $category)
    {
        return view('dashboard.categories.create')->with('category' , $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateValidation $request, Category $category)
    {
        // $category->name = $request->name;
        // $category->save();

        $category->update([
            'name' => $request->name,
        ]);

        session()->flash('success' , "Category Updated successfuly");
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success' , "Category Deleted successfuly");
        return redirect(route('categories.index'));
    }
}
