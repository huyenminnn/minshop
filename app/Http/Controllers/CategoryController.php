<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.category');
    }

    //DataTable
    public function getData(){
        $categories = Category::get();
        return Datatables::of($categories)
            ->addColumn('action', function ($category) {
                return '<button type="button" class="btn btn-success btn-show" data-id="'.$category->id.'">Detail</button>
                        <button type="button" class="btn btn-warning btn-edit" data-id="'.$category->id.'">Edit</button>
                        <button type="button" class="btn btn-danger btn-delete" data-id="'.$category->id.'">Delete</button>';
            })->make(true);
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
    public function store(CategoryRequest $request)
    {
        $cate = new Category();
        $cate->name = $request->name;
        $cate->slug = $request->slug;
        $cate->parent_id = $request->parent_id;
        $cate->description = $request->description;
        $cate->save();
        return $cate;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return $category;
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
    public function update(CategoryRequest $request, $id)
    {
        $cate = Category::find($id)->update($request->all());
        return response()->json(['data'=>$cate]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return response()->json(['data'=>'removed']);
    }
}
