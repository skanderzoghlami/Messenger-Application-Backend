<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConversationResource;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        We use this to bring the messages ( select * from messages)
        $conversations = Conversation::all();

//         The resouce is used to cover up a list of items in our case a list of all the conversations
//         To create a resource : php artisan make:resource NameResource
       return ConversationResource::collection($conversations) ;

       // we bring all conversations where the currently connected user is the  first or second user
       $conversations = Conversation::where('user_id',auth()->user()->id)->orWhere('second_user_id',auth()->user()->id)->orderBy('updated_at', 'desc')->get();
        $count = count($conversations);

//        // we sort it by the last message sent
        for($i=0 ; $i< $count ;$i++)
        {
            for($j=0 ; $j< $count ;$j++)
            {

                if($conversations[$i]->messages->last()->id < $conversations[$j]->messages->last()->id)
                {
                    $temp = $conversations[$i];
                    $conversations[$i]=$conversations[$j];
                    $conversations[$j]= $temp;
                }
            }
        }
       return ConversationResource::collection($conversations) ;
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
        $request->validate([
            'user_id'=>'required',
            'message'=>'required'
        ]);
        $conversation = Conversation::create([

            'user_id'=>auth()->user()->id ,
            'second_user_id'=>$request['user_id']
        ]);
        $conversation = Conversation::create([
            'user_id'=>auth()->user()->id ,
            'second_user_id'=>$request['user_id']
        ]);
        $message = Message::create([
            'body'=>$request['message'],
            'user_id'=>auth()->user()->id ,
            'conversation_id'=>$request['user_id'],
            'read'=>false
    ]);

        return new ConversationResource($conversation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }

// This function is used to mark a message as read
    public function markAsReaded(Request $request)
    {
        $request->validate([
            'conversation_id'=>'required',
        ]);
    $conversation =  Conversation::findOrFail($request['conversation_id']);
    foreach ($conversation->messages as  $message)
    {
        $message->update(['read'=>true]);
    }
        return response()->json('success',200);
    }









}
