<?php

namespace App\Http\Controllers\api;


use App\Models\Book;
use App\Models\User;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Requests\RateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    { 
        // $this->middleware('auth:sanctum');
    }
    
    public function toggleFavorite( $book_id)
    {
    
        $user =auth()->user();
        $book = Book::find($book_id);
        if(empty($book))
            return response()->json([
                'message' => 'This book is not found',
            ]);

        // return 1;
        if ($user->user_favorite_books()->where('book_id', $book_id)->exists()) {
            // return 1;
            $user->user_favorite_books()->detach($book_id);
            return response()->json([
                'message' => 'Favorit book unstored',
            ]);
        } 
        else
        {
            
            $user->user_favorite_books()->attach($book_id);
            return response()->json([
                'message' => 'Favorit book stored',
            ]);
        }
    
    
    }

    public function store_book_rate($book_id, RateRequest $req )
    {

        $user = Auth::user();$book = Book::find($book_id);
        if(empty($book))
            return response()->json([
                'message' => 'This book is not found',
            ]);

        if ($user->rate_books()->where('book_id', $book_id)->exists()) 
        {
            $user->rate_books()->updateExistingPivot($book_id, [
                'rating' => $req->rate,
            ]);
            return response()->json([
                'message' => 'This book is rerated',
            ]);
        }
        else
        {
            $user->rate_books()->attach($book_id,[
                'rating' => $req->rate,
                
            ]);
            return response()->json([
                'message' => 'This book is rated',
            ]);
        }

    
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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
    }
}
