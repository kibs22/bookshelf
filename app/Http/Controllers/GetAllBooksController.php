<?php

namespace App\Http\Controllers;

use App\PostedBook;
use Illuminate\Http\Request;



class GetAllBooksController extends Controller
{
    
    public function __invoke(Request $r)
    {
        //return response()->json($this->get_levensthein_algo($r->q, PostedBook::all()));
        
        if($r->q){
            $data = PostedBook::whereAvailability(0)->with(['postedBy','postedCategory' ])->orderBy('id', 'desc')->search($r->q)->get();
            $new = $data->map(function($item, $key){
               return [
                 'id' => $item->id,
                 'fullname' => $item->postedBy->firstname,
                 'item' => ['title' => $item->title, 'description' => $item->description, 'author' => $item->author,'ibsn' => $item->IBSN,'availability' => $item->availability,'image' => $item->image]
                 ];
            });
            return response()->json(['posts' => $data , 'total'=> $data->count()]);
        }
        
        if($r->cat){
            
            $data = PostedBook::getSearchedCategory($r->cat);
            return response()->json(['posts' => $data, 'total'=> $data->count() ]);
        }

        if(!$r->cat && !$r->q){
            $data = PostedBook::whereAvailability(0)->with(['postedCategory','getCategory','postedBy'])->orderBy('id', 'desc')->get();
            return response()->json(['posts' => $data, 'total'=> $data->count()]);
        }    	
    }

    public function get_levensthein_algo($word, $post_collections)
    {
      
      $shortest = -1;
      $array_post = [];
      
      foreach ($post_collections as $post) {
        
            $lev = levenshtein($word, $post->title);
        
            if ($lev == 0) {
                $closest = $post->title;
                $shortest = 0;  
                return $closest;
            }
        
            if ($lev <= $shortest || $shortest < 0) {
                $array_post[]  = $post;
                $array_post[] = ['shortest' => $shortest];
            }
        }
      return $array_post;
    
    }
}
