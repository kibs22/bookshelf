<?php

namespace App\Http\Controllers;

use App\Category;
use App\PostedCategory;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function __invoke()
    {
        $category = Category::all()->pluck('name');


        $items = Category::with('getdetails')->get();

        $items = $items->map(function($i){
            return ['data' => collect($i->getDetails)->count() , 'label' => $i->name ];
        });

        $chart = [$category, $items];
        return response()->json(['label' => $category, 'items' => $items]);
    }
}
