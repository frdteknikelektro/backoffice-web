@extends('layouts.app')

@section('content-title', 'Users')

@section('content')
<div class="row">
  <div class="col-sm-8 col-sm-offset-2">
    <form action="{{ route('users.store') }}" method="post">
      {{ csrf_field() }}
      <div class="card">
        <div class="header">
          <h4 class="title">Users Create</h4>
          <p class="category">Here is a form of creating users</p>
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
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="form-group">
            <label for="password_confirmation">Retype Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
          </div>
          <div class="pull-right">
            <button type="submit" class="btn btn-info btn-fill">Store</button>
          </div>
          <a href="{{ request()->redirect ? urldecode(request()->redirect) : route('users.index') }}" class="btn btn-default btn-fill">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
