<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Requests\MainRequest;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // $main=MainCategory::all(1);
        // return $main;//->subcategory;
        // $mains = MainCategory::all();
        // return view('maincategory.allmaincategory',compact('mains'));
        // foreach ($main->subcategory as $subvalue) {
        //     echo $subvalue->sub_category_name;
        // }
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
    public function store(MainRequest $request)
    {   
        // dd(5);
    
        // dd($request);
        $new_main=new MainCategory();
        $new_main = MainCategory::create([
            'main_category_name' => $request->MainCategory,
        ]);
        return  redirect('maincategory');
        // return  redirect()->route('category.index');
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
    
        $main = MainCategory::find((int)$id);

        if ($main) {
            $main->delete();
        }
        return  redirect('maincategory');
    
    }
}
