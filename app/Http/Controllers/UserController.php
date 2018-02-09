<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\Message;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Http\Traits\AuthenticatedUser;


class UserController extends Controller
{
    use AuthenticatedUser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            User::where('role_type', 'normal')
            ->where('key',null)
            ->get()
            ->random()
    );
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
    public function store(StoreUser $request)
    {
        // dd($request);
        // \Mail::to($request->email)->send(new Message);
        // echo('email sent');
        // dd($request->all());
        $user = $request->all();
        $user['password'] = bcrypt($request->password);
        $user['confirm_key'] = $this->generateRandomString();
        
        $created_user = User::create($user);

        if($created_user->id){

            if($request->hasFile('image')){
                    $displayPhotoPath = $request->file('image')->store("displayphoto", 'public');
                    $created_user->image = "storage/{$displayPhotoPath}";
                    $created_user->save();
            }
            return response()->json(['success' => true]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(['data' => $this->user() ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user_detail = User::find($request->id);

        $user_detail->firstname = $request->firstname;
        $user_detail->MI = $request->MI;
        $user_detail->lastname = $request->lastname;
        $user_detail->email = $request->email;
        $user_detail->mobile = $request->mobile;

        $user_detail->save();

        return response()->json(['success' => true ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
      //
    }

    public function generateRandomString($length = 10) {
      
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
