<?php

namespace App\Http\Controllers;


use App\User;
use App\PostedBook;
use App\Report;
Use App\UserReport;
use Illuminate\Http\Request;
use App\Http\Traits\AuthenticatedUser;
use Illuminate\Support\Facades\Auth;

class TrialController extends Controller
{
	use AuthenticatedUser;

    public function trial(){
    	return response()->json(['data'=> User::all() ]);	
	}
	public function getreports()
	{
		return response()->json(['data'=> Report::all()]);
	}

	public function addreport(Request $request)
	{
		$report = ['reported_by' => $this->user()->id,'reported_to' => $request->reported_to, 'book_id' => $request->book_id];
		UserReport::create($report);
		
		// return response()->json(UserReport::create(array('report_id'=>$request->maoningoption, 'user_id'=>Auth::id())));
		return response()->json(['success' => true]);	
	}

    public function postBook(Request $request)
    {
		$this->validate($request,[
		'title' => 'required',
		'description' => 'required',
		'author' => 'required',
		'isbn' => 'required',
		'year' => 'required',
		'price' => 'required'
		]);

		$post = $request->all();
        $post['price'] = $request->price;
        $post['seller_id'] = $this->user()->id;
        $post['availability'] = 0;
            
        $ret = PostedBook::create($post);
    	
    	return response()->json($request->all());
    }
}
