<?php

namespace App\Http\Controllers\api;

use App\Models\Book;
use App\Models\SubCategory;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResourse;
use App\Http\Requests\BookApiRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\BookUpdateApiRequest;

class BookController extends Controller
{   
    use ApiResponceTrait;
    public function bookInSpecificMainCategory($id)
    {
        $subs_id=SubCategory::where('main_category_id',(int)$id)->get()->pluck('id');
        $books = Book::whereIn('sub_category_id',$subs_id)->get();

        if($books->isEmpty() && MainCategory::find((int)$id) )
            return $this->MainCategoryResponse("no Books",MainCategory::find((int)$id)->main_category_name,MainCategory::find((int)$id));
            
            // return response()->json([
            //     'Books' =>  "no Books" ,
            //     'Main Category'=> MainCategory::find((int)$id)->main_category_name,
            //     'Main Category Details'=> MainCategory::find((int)$id),
            // ]);
        if($books && MainCategory::find((int)$id) && SubCategory::where('main_category_id',(int)$id)->get() )
            return $this->MainCategoryResponse( BookResourse::collection($books) ,MainCategory::find((int)$id)->main_category_name, MainCategory::find((int)$id));
            
            // return response()->json([
            //     'Books' =>  $books ,
            //     'Main Category'=> MainCategory::find((int)$id)->main_category_name,
            //     'Main Category Details'=> MainCategory::find((int)$id),
            // ]);
        
        return $this->MainCategoryResponse( "no Books" , "no Main Category",  "no Main Category Details");
        
        // return response()->json([
        //         'Books' =>  "no Books" ,
        //         'Main Category'=> "no Main Category",
        //     ]);

    }
    public function bookInSpecificSubCategory($id)
    {
        $books = Book::where('sub_category_id',$id)->get();
        // $books = Book::whereIn('sub_category_id',$subs_id)->get();
        if($books->isEmpty() && SubCategory::find((int)$id) )
            return $this->SubCategoryResponse("no Books",SubCategory::find((int)$id)->sub_category_name,SubCategory::find((int)$id));
            
                // return response()->json([

                //     'Books' =>  "no Books" ,
                //     'Sub Category'=> SubCategory::find((int)$id)->sub_category_name,
                //     'Sub Category Details'=> SubCategory::find((int)$id),
                // ]);
        if($books && SubCategory::find((int)$id) )
            return $this->SubCategoryResponse( BookResourse::collection($books) ,SubCategory::find((int)$id)->sub_category_name,SubCategory::find((int)$id));
        
            // return response()->json([
    
            //     'Books' =>  $books ,
            //     'Sub Category'=> SubCategory::find((int)$id)->sub_category_name,
            //     'Sub Category Details'=> SubCategory::find((int)$id),
            // ]);
        
        return $this->SubCategoryResponse( "no Books" , "no Sub Category",  "no Sub Category Details");

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $books=Book::all();
        $books=BookResourse::collection(Book::all());
        return $this->ApiResponse($books,'ok',200);
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
        $validator = Validator::make($request->all(), [
            'bookname' => 'required|string|max:255|unique:books,booktitle',
            'bookauthor' => 'required|string|max:255',
            'bookdisc' => 'required|string',
            'sub_category_id'=>'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $book=new Book();
        $book->booktitle=$request->bookname;
        $book->bookauthor=$request->bookauthor;
        $book->bookdiscribtion=$request->bookdisc;
        $book->sub_category_id=(int)$request->sub_category_id;
        $book->save();
    
        if($book)
            return $this->ApiResponse(new BookResourse($book),'stored',201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book=Book::find($id);
        if($book)
            return $this->ApiResponse(new BookResourse($book),'ok',200);
        else
            return $this->ApiResponse(null,'not found',404);


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
        $validator = Validator::make($request->all(), [
            'bookname' => 'required|string|max:255|unique:books,booktitle',
            'bookauthor' => 'required|string|max:255',
            'bookdisc' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $book=Book::find($id);

        if($book)
        {
            $book->booktitle=$request->bookname??$book->booktitle;
            $book->bookauthor=$request->bookauthor??$book->bookauthor;
            $book->bookdiscribtion=$request->bookdisc??$book->bookdiscribtion;
            $book->update();
            return $this->ApiResponse(new BookResourse($book),'updated',200);}
        else
            return $this->ApiResponse(null,'not updated',404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    
        $book=Book::find($id);
        if(!$book)
            return $this->ApiResponse(null,'this book is not found',404);
        $book->delete();
        return $this->ApiResponse(null,'The book deleted',200);
    }
}
