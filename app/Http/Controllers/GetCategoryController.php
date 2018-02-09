<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class GetCategoryController extends Controller
{
   public function __invoke()
   {
       return response()->json(['data' => Category::all() ]);
   }
}
