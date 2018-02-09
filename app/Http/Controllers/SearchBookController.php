<?php

namespace App\Http\Controllers;

use App\PostedBook;
use Illuminate\Http\Request;
use App\Http\Traits\AuthenticatedUser;

class SearchBookController extends Controller
{
    use AuthenticatedUser;
    public function get_search(Request $r)
    {
      
      //$data = PostedBook::with(['postedBy','postedCategory','getCategory'])->search($r->search)->get();
      $this->get_levensthein_algo($r->search, PostedBook::all());
      
      $new = $data->map(function($item, $key){
         return [
           'id' => $item->id,
           'fullname' => $item->postedBy->firstname,
           'item' => ['title' => $item->title, 'description' => $item->description, 'author' => $item->author,'ibsn' => $item->IBSN,'availability' => $item->availability,'image' => $item->image]
           ];
      });
      return response()->json(['data' => $data ]);
    }

    public function get_levensthein_algo($word, $collection)
    {
      return response()->json($word);
      
      foreach ($words as $word) {
        
            $lev = levenshtein($input, $word);
        
            if ($lev == 0) {
                $closest = $word;
                $shortest = 0;  
                break;
            }
        
            if ($lev <= $shortest || $shortest < 0) {
                $closest  = $word;
                $shortest = $lev;
            }
        }
    }
}
