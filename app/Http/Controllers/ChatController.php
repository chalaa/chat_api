<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use COM;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $chat = Chat::all();
        return $chat;

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
            'user_1' => 'required|integer|exists:users,id',
            'user_2' => 'required|integer|exists:users,id'
        ]);

        $chat1 = Chat::where('user_1','=',$request->user_1)->where('user_2','=',$request->user_2)->get();
        $chat2 = Chat::where('user_1','=',$request->user_2)->where('user_2','=',$request->user_1)->get();

        if($chat1->isEmpty() && $chat2->isEmpty()){
            $data = Chat::create([
                'user_1' => $request->user_1,
                'user_2' => $request->user_2,
            ]);
    
            return $data;
           
        }

        return response()->json('Chat already exit');
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
        $chat = Chat::where('user_1','=',$id)->orWhere('user_2','=',$id)->get();

        if($chat->isEmpty()){
            return response()->json("user not found",404);
        }
        return $chat;
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$id2)
    {
        //
        $chat = Chat::where('user_1','=',$id)->where('user_2','=',$id2)->get();
        $chat1 = Chat::where('user_1','=',$id2)->where('user_2','=',$id)->get();
        if($chat->isEmpty() && $chat1->isEmpty()){
            return response()->json("user not found",404);
        }
        $chat->each->delete();
        $chat1->each->delete();
        return response()->json("chat deleted",200);
    }
}
