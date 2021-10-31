<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function bookspage(){
        return "The books";
    }
    public function saveBook(){
        Book::create($this->validateRequest());
    }

    public function updateBook(Book $book){
        $book->update($this->validateRequest());
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => ''
        ]);
    }
}
