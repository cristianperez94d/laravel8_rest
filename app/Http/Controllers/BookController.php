<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends ApiController
{
    private $listISBN=['0120121123', '0760054487', '0760034400', '0619101857', '0760057591', '1305656288', '0760070873', '0619057009', '0760071071', '9781285077307'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return $this->showAll($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function createBook($id, Request $request)
    {
        $endpoint = 'https://openlibrary.org/api/books?bibkeys=ISBN:'.$id.'&amp;jscmd=data&amp;format=json&#39';
        $data = json_decode( file_get_contents($endpoint), true );

        if(!$data){
            return $this->errorResponse("El ISBN no existe", 404);
        }
        
        $argument = "ISBN:".$id;
        $request['id'] = $id;
        $request['title'] = $data[$argument]['title'];
        $request['cover'] = isset($data[$argument]['cover']) ? $data[$argument]['cover']['large'] : 'No aplica';
    
        //create book
        $book = Book::create($request->all());
        $book = Book::find($id);
            
        // create authors
        $authors = isset($data[$argument]['authors']) ? $data[$argument]['authors']['authors'] : [];
        foreach ($authors as $key => $value) {
            $author = Author::create(['name'=> $value['name'], 'book_id' => $book->id]);
        }

        return $this->showOne($book, 201, 'Registro almacenado correctamente..');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return $this->showOne($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return $this->showOne($book,200, "Registro eliminado correctamente");
    }
}
