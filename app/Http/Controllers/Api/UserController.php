<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Api User Controller
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $users
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
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = new User;
        foreach ([ 'name', 'email' ] as $key) {
            if ($request->exists($key)) {
                $user->{$key} = $request->{$key};
            }
        }
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'code' => 201,
            'status' => 'success',
            'data' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $user
        ]);
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
        $this->validate($request, [
            'name' => 'string',
            'email' => 'email',
            'password' => 'string|min:6|confirmed|nullable'
        ]);

        foreach ([ 'name', 'email' ] as $key) {
            if ($request->exists($key)) {
                $user->{$key} = $request->{$key};
            }
        }
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $user
        ]);
    }
}
