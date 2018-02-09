<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Category;
use App\PostedBook;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Traits\AuthenticatedUser;

class SuggestionsController extends Controller
{
    use AuthenticatedUser;

    public function getSuggestion()
    {
        if($this->user()){
            $cat = DB::table('transactions')
            ->join('posted_books','posted_books.id','=','transactions.posted_book_id','left')
            ->join('posted_categories','posted_categories.posted_id','=','posted_books.id','left')
            ->where('transactions.sold_to','=', $this->user()->id)
            ->select('transactions.*','posted_books.*','posted_categories.*')
            ->get();

            $count = collect($cat)->count();
            $cat = $cat->pluck('category_id');
          
            
            if($count > 0){
                foreach($cat as $c)
                {
                    $res = PostedBook::with(['postedCategory' => function($q) use ($c) {
                            $q->whereCategoryId($c);
                    }])->with('postedBy')->where([
                            ['seller_id','!=', $this->user()->id],
                            ['availability', '=', 0]
                    ])->limit(3)->get();
        
                }    
            }else{
                $cat = Category::inRandomOrder()->take(3)->pluck('id');
                
                foreach($cat as $c){
                    $res = PostedBook::with(['postedCategory' => function($q) use ($c) {
                                 $q->whereCategoryId($c);
                        }])->with('postedBy')->where([
                                ['seller_id','!=', $this->user()->id],
                                ['availability', '=', 0]
                        ])->limit(3)->get();
                }
             
            }
            
            return response()->json( ['suggestions' => $res] ); 
        }

    }
}
