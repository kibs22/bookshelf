<?php

namespace App\Http\Controllers;

Use App\PostedBook;
use App\Category;
use Illuminate\Http\Request;


class getBookController extends Controller
{
    public function __invoke()
    {
        $books = PostedBook::latest()->take(7)->get();

        $getRanAuthor = PostedBook::inRandomOrder()->take(7)->get();

        $author = $getRanAuthor->map(function($q){
            return $q->author;
        });

        return response()->json(['books' => $books, 'author'=>$author]);
    }
}
