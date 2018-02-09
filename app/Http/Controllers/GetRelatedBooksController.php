<?php

namespace App\Http\Controllers;

use Goutte;
use App\PostedBook;
use Illuminate\Http\Request;
use App\Http\Traits\similarityContext;
use Scriptotek\GoogleBooks\GoogleBooks;

class GetRelatedBooksController extends Controller
{

    use similarityContext;

    public function getRelated(Request $r)
    {
        
        // $posted_books = PostedBook::where('id','!=', $r->id)->where(function($q) use($r){
            
        //     $words = collect(explode(' ', $r->q)) ;
           
        //     $words->each(function($w) use($q) {
        //        return  $q->where('title','like','%' .$w. '%')->orWhere('description','like','%'. $w .'%');
        //     });
           
        // })->get();
        
        // return response()->json($posted_books);

        $posted_books = PostedBook::where('id','!=', $r->id )->get();
        
        $input=explode(' ', $r->q);

        
        $words = $posted_books->mapWithKeys(function($w) use ($input){
            $fulltext = collect(explode(' ', $w->title.' '.$w->description));
            $tmp = $fulltext;
            $related = collect([]);
           foreach($input AS $q){
               $temp = clone $fulltext;
               $result = $temp->filter(function ($word) use ($q)
               {
                     return stripos($word,$q) !== false;
               })->values()->toArray();
               if(!empty($result)){
                $related->push($result);
               }

                // $result = $temp->map(function ($word) use ($q)
                // {
                //     $word = strtolower($word);
                //     $q = strtolower($q);
                //     return stripos($word,$q) !== false ? levenshtein($word, $q) : 0;
                // })->sum();
                // $related->push($result);
                
           }
            return [
                $w->id =>    $related->flatten()->unique()->flatten(),
                // 'orig-'.$w->id => $tmp
            ] ;
        });

        $words = $words->map(function($w){
                if(collect($w)->isNotEmpty()) {
                    return $w;
                }
        });

        return [
            'summary' => $words->filter()->toArray(),
            'books' => $posted_books->whereIn('id', $words->filter()->keys())->flatten() 
        ];

     

        // return $input->toArray();
        
        return response()->json(['data' => $res]);


           // foreach($input AS $q) {

        // }

        // $res = $input->map(function($i) use ($words) {
        //     return $words->each(f)
        //       return $words->filter(function($w) use ($i) {
        //                 return stripos($w,$i) !==false;
        //         });
        // });
        

        $filtered = array_filter($words->toArray(), function($v)use($input){
            return stripos($v,$input[0]) !==false;
        });
        
        
        usort($filtered, function($a,$b) use ($input) {
            return levenshtein($input,$a) > levenshtein($input,$b)?1:-1;
        });
        
        return response()->json($filtered);

       
        
        // $posted_books = PostedBook::all();
        // $search = collect(explode(' ', 'Lost Boy'));
        // $res = collect();

        // return $posted_books->mapWithKeys(function($q) use ($res, $search) {
               
        //      $num = $search->sum(function($s) use ($q){
        //             return collect($q)->sum(function ($val) use ($s) {
        //                 return levenshtein($val,$s );
        //             });
        //         });
        //         return  [implode('', $q)=> $num];
        //  })->toJson();

        // $search->map(function($p) use ($posted_books, $res) {
        //     return $posted_books->sum(function($q) use ($p, $res) {
        //         return levenshtein($p, $q)
        //     });
        // });


    }
    public function google(Request $r)
    {
        return file_get_contents("https://www.googleapis.com/books/v1/volumes?q=".urlencode($r->q));
    }
}
