<?php

namespace App\Http\Controllers;

use App\User;
use App\Review;
use App\PostedBook;
use App\PostedCategory;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Traits\AuthenticatedUser;
use Illuminate\Support\Facades\Storage;


class PostedBooksController extends Controller
{
    use AuthenticatedUser;
    
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        if($this->user()){
            return response()->json(['posts' => PostedBook::where([
                [ 'seller_id', '=' , $this->user()->id ],
                [ 'availability', '=' , 0]
            ])->with(['postedCategory','getCategory','hasManyUsersInterested.InterestedUsersDetails','isTransacted'])->orderBy('id', 'desc')->get()]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        

        $post = $request->all();
        $post['price'] = $request->price;
        $post['seller_id'] = $this->user()->id;
        $post['availability'] = 0;
            
        $ret = PostedBook::create($post);
    
        if($ret->id){
            if($request->hasFile('image')){
                    $displayPhotoPath = $request->file('image')->store("displayphoto", 'public');
                    $ret->image = "storage/{$displayPhotoPath}";
                    $ret->save();
            }
            $category = ['posted_id' => $ret->id, 'category_id' => $request->category];
            PostedCategory::create($category);

            return response()->json(['success' => true ,'message' => 'successfully posted book!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
      $data = PostedBook::with(['postedBy.myReviews','postedCategory','getCategory'])->Details($request->id)->get();

       $data = $data->map(function($item, $key){
         return [
           'seller' => $item->postedBy,
           'item' => $item,
           'category' => $item->getCategory,
           'position' => ['lat' => $item->postedBy->latitude, 'lng' => $item->postedBy->longitude]
           ];
      });
      return response()->json(['data' => $data]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    //  return response()->json($request->all());
        
        $this->validate($request,  [
            'title' => 'required',
            'description'  => 'required',
            'price'   => 'required',
            'isbn'    => 'required',
            'author'  => 'required',
            'year'     => 'required',
            'categories' => 'required'
        ]);
        // return response()->json($this->user());
        if($this->user()){

            $book = PostedBook::find($id);
            $book->title = $request->title;
            $book->price = $request->price;
            $book->author = $request->author;
            $book->description = $request->description;
            $book->year = $request->year;
            $book->postedCategory()->update(['category_id' => $request->categories]);
            
            if($book->save()){
                return response()->json(['success' => true ]);
            }else{
                return response()->json(['success' => false]);
            }
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PostedBook::whereId($id)->delete();
        return response()->json(['success'=> true]);
        // $posted = PostedBook::where('id','=',$id)->get();
        // $posted->delete();
        //PostedBook::whereId($id)->delete();
        // $postedbook = posted_books::where('id', '=', $id)->first();
        // $postedbook -> delete();
    }

    public function Mobileupdate(PostRequest $request, $id)
    {
        $book = PostedBook::find($id);
        $book->title = $request->title;
        $book->price = $request->price;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->year = $request->year;
        $book->isbn = $request->isbn;
            
        if($book->save()){
            return response()->json(['success' => true ]);
        }
    }

    public function getTitleAndId()
    {
        $res = PostedBook::whereSellerId($this->user()->id)->get();

        $res = $res->map(function($q){
            return [
                'id' => $q->id,
                'name' => $q->title
            ];
        });

        return response()->json(['data' => $res ]);
    }
}
