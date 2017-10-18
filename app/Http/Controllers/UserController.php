<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

/**
 * User Controller
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Yajra\DataTables\Html\Builder $builder
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of(User::query())->toJson();
        }

        $html = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email']
        ])->addAction([
            'defaultContent' => '',
            'data'           => 'action',
            'name'           => 'action',
            'title'          => 'Action',
            'render'         => null,
            'orderable'      => false,
            'searchable'     => false,
            'exportable'     => false,
            'printable'      => true,
            'footer'         => '',
        ]);

        return response()->view('users.index', compact([ 'html' ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->exists('redirect') && starts_with(urldecode(request()->redirect), request()->root())) {
            session()->put('url.intended', urldecode(request()->redirect));
        } else {
            session()->pull('url.intended');
        }

        return response()->view('users.create');
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
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|string|min:6'
        ]);

        $user = new User;
        foreach ([ 'name', 'email' ] as $key) {
            if ($request->exists($key)) {
                $user->{$key} = $request->{$key};
            }
        }
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->redirectToIntended(route('users.show', [ $user->id ]))
               ->with([ 'user_id' => $user->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->view('users.show', compact([ 'user' ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (request()->exists('redirect') && starts_with(urldecode(request()->redirect), request()->root())) {
            session()->put('url.intended', urldecode(request()->redirect));
        } else {
            session()->pull('url.intended');
        }

        return response()->view('users.edit', compact('user'));
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
            'email' => 'email|unique:users,email,'.$user->id,
            'password' => 'confirmed|string|min:6|nullable'
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

        return response()->redirectToIntended(route('users.show', [ $user->id ]))
               ->with([ 'user_id' => $user->id ]);
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

        if (request()->ajax()) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'data' => $user
            ]);
        }
        return response()->redirectToIntended(route('users.index'));
    }
}
