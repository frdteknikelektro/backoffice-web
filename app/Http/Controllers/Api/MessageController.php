<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\MessageSent;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::with('user')->latest()->paginate();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $messages
        ]);
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
        $this->validate($request, [
            'user_id' => 'exists:users,id',
            'message' => 'required|string'
        ], [], [
            'user_id' => 'user'
        ]);

        $user = auth()->user();
        if ($request->exists('user_id')) {
            $user = User::find($request->user_id);
        }

        $message = new Message;
        foreach ([ 'message' ] as $key) {
            if ($request->exists($key)) {
                $message->{$key} = $request->{$key};
            }
        }
        $user->messages()->save($message);

        broadcast(new MessageSent($user, $message))->toOthers();

        return response()->json([
            'code' => 201,
            'status' => 'success',
            'data' => $message
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
