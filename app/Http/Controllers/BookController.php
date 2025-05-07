<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $books=Book::all();
       if(!$books->isEmpty()){
           return response()->json([
               'status'=>200,
               'message'=>'Books listed successfully',
               'data'=>$books
           ]);
       }else{
           return response()->json([
               'status'=>404,
               'message'=>'No books found',
           ]);
       }


    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();
        $book=Book::create($validated);
        return response()->json([
            'message'=>'Book created successfully',
            'data'=>$book
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book=Book::find($id);
        if($book){
            return response()->json([
                'message'=>'Book found successfully',
                'data'=>$book
            ],200);
        }else{
            return response()->json([
                'message'=>'Book not found',
            ],404);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $validated = $request->validated();
        $book->update($validated);
        return response()->json([
            'message'=>'Book updated successfully',
            'data'=>$book
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book=Book::find($id);
        if($book){
            $book->delete();
            return response()->json([
                'message'=>'Book deleted successfully',
            ],204);
        }else{
            return response()->json([
                'message'=>'Book not found',
            ],404);
        }
    }
}
