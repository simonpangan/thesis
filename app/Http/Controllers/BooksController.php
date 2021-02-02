<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
class BooksController extends Controller
{
    public function store() {
        
        // $data = request()->validate([
        //     'title' => 'required',  //first in the test then add the author
        //     'author' => 'required',
        // ]);
        // Book::create($data);
        Book::create($this->validateRequest());
    }

    public function update(Book $book) { //route model binding 
        
        // $data = request()->validate([
        //     'title' => 'required',  //first in the test then add the author
        //     'author' => 'required',
        // ]);
        // $book->update($data);
        $book->update($this->validateRequest());
    }
    protected function validateRequest() {
       return  $data = request()->validate([
            'title' => 'required', 
            'author' => 'required',
        ]);
    }
}
