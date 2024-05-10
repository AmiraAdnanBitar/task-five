<?php

namespace App\Http\Controllers;


use App\Models\SubCategory;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Requests\SubRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
    
        // $subCategory = SubCategory::find(1);
        // return SubCategory::find(1);//::with('maincategory')->get();          //////maiiiiiin category
        // return  $subCategory::with('maincategory')->get();            //////sub category

        // $subs = SubCategory::all();
        // return view('subcategory.allsubcategory',compact('subs'));



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubRequest $request)
    {

        $new_sub=new SubCategory();
        $new_sub->sub_category_name=$request->SubCategory;
        $new_sub->main_category_id=(int)$request->main;
        $new_sub->save();

        return  redirect('subcategory');
        // return  redirect()->route('category.index.sub');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sub = SubCategory::find((int)$id);

        if ($sub) {
            $sub->delete();
        }
        return  redirect('subcategory');
    }
}
