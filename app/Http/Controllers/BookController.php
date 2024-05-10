<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(5);
        // $books = Book::all();
        // return view('bookshow',compact('books'));

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
    public function store(BookRequest $request)
    {
        // dd($request);
        // $request->validate( [
        //     'bookname' => 'required|string|max:255|unique:books,booktitle',
        //     'bookauthor' => 'required|string|max:255',
        //     'bookdisc' => 'required|string',
        // ]);
    
        
        $book=new Book();
        $book->booktitle=$request->bookname;
        $book->bookauthor=$request->bookauthor;
        $book->bookdiscribtion=$request->bookdisc;

        $book->sub_category_id=(int)$request->subid;
        // dd($book->sub_category_id);
        $book->save();
        return redirect('showall');
        // return  redirect()->route('index');

        

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
        //
        $book=Book::find($id);
        $book->delete();
        return view('showall');
        } 
}
