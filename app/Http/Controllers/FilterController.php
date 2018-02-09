<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filterItemsLow(Request $r)
    {
        $items = collect( $r->toArray() );

        $items = $items->sortByDesc('price');

        return response()->json( ['posts' => $items->values()->all() , 'total'=> $items->count() ]);
    }

    public function filterItemsHigh(Request $r)
    {
        $items = collect( $r->toArray() );

        $items = $items->sortBy('price');

        return response()->json( ['posts' => $items->values()->all() , 'total'=> $items->count()]);
        
    }
}
