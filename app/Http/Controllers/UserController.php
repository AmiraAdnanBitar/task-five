<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RateRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

class UserController extends Controller
{
    public function index()
    {
        $users=User::all();

        return view('user.show_users',compact('users'));
    }
    // public function show_user_favorite_book()
    // {
    //     // $user=User::find(2);
    //     // return $user->user_favorite_books;


    //     // $book=Book::find(4);
    //     // return $book->who_loved_this_book;
    // }
    public function toggleFavorite($book_id)
    {
        $user = Auth::user();
        if (Auth::check()) 
        {
            $book = Book::findOrFail($book_id);

            if ($user->user_favorite_books()->where('book_id', $book_id)->exists()) {
            
                $user->user_favorite_books()->detach($book_id);
            } 
            else
            {
            
                $user->user_favorite_books()->attach($book_id);
            }

            return redirect()->back();
        }
        else
        {
            return  view('welcome');
        }
    }

    public function store_rate($book_id, RateRequest $req )
    {


        $user = Auth::user();
        if (Auth::check()) 
        {
            $book = Book::findOrFail($book_id);
            if ($user->rate_books()->where('book_id', $book_id)->exists()) 
            {
                $user->rate_books()->updateExistingPivot($book_id, [
                    'rating' => $req->rate,
                ]);
            }
            else
            {
                $user->rate_books()->attach($book_id,[
                    'rating' => $req->rate,
                ]);
            }

            return view('homepage');
        }
        else
        {
            return  view('welcome');
        }

    }

}
