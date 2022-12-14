<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserProfilePicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::all();
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
    public function store(Request $request)
    {
        //
        $request->validate([
            'username' => ['required', 'string', 'max:255','unique:users,username'],
            'email' => ['required', 'string', 'max:255','unique:users,email','email'],
            'password' =>  ['required', 'confirmed', Rules\Password::defaults()],
            'image' => 'required|image'
        ]);

        $data = new User([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password'=> Hash::make($request->get('password')),
        ]);

        $data->save();

        $image_path =  $request->file('image')->store('userProfilePicture','public');

        $profilePicture = new UserProfilePicture([
            'user_id' => $data->id,
            'url'=> $image_path
        ]);
        
        $profilePicture->save();

        return new UserResource($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user =  User::find($id);
        if(is_null($user)){
            return response()->json("user not found",404);
        }
        return $user;
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
        //

        $request->validate([
            'username' => ['string', 'max:255'],
            'email' => ['string', 'max:255','email'],
            'password' =>  ['confirmed', Rules\Password::defaults()],
        ]);

        $user = User::find($id);

        if(is_null($user)){
            return response()->json("user not found",404);
        }
        else{
            $user->update([
                'username' => ($request->get('username') == null) ? $user->username : $request->get('username'),
                'email' => ($request->get('email') == null)? $user->email : $request->get('email'),
                'password' => ($request->get('password') == null)? $user->password :Hash::make($request->get('password')),
            ]);
            
            return $user;
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
        //

    }
}
