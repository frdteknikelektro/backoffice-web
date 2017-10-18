@extends('layouts.app')

@section('content-title', 'Users')

@section('content')
<div class="row">
  <div class="col-sm-8 col-sm-offset-2">
    <form action="{{ route('users.update', [ $user->id ]) }}" method="post">
      {{ csrf_field() }}
      <div class="card">
        <div class="header">
          <h4 class="title">Users Edit</h4>
          <p class="category">Here is a form of editing users</p>
        </div>
        <div class="content">
          @if ($errors->any())
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ $errors->first() }}
          </div>
          @endif
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank if not change">
          </div>
          <div class="form-group">
            <label for="password_confirmation">Retype Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Leave blank if not change">
          </div>
          <div class="pull-right">
            <button type="submit" name="_method" value="PUT" class="btn btn-info btn-fill">Update</button>
          </div>
          <a href="{{ request()->redirect ? urldecode(request()->redirect) : route('users.index') }}" class="btn btn-default btn-fill">Cancel</a>
          <button type="submit" name="_method" value="DELETE" class="btn btn-danger btn-fill" onclick="return confirm('Are you sure you want to delete?');">Delete</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
