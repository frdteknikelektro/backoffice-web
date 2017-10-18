@extends('layouts.app')

@section('content-title', 'Users')

@section('content')
<div class="row">
  <div class="col-sm-8 col-sm-offset-2">
    <div class="card">
      <div class="header">
        <h4 class="title">Users List</h4>
        <p class="category">Here is a list of users</p>
      </div>
      <div class="content table-responsive table-full-width">
        {{ $html->table([ 'id' => 'users', 'class' => 'table table-hover table-striped' ]) }}
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('/js/manifest.js') }}" charset="utf-8"></script>
<script src="{{ mix('/js/vendor.js') }}" charset="utf-8"></script>
<script src="{{ mix('/js/users/index.js') }}" charset="utf-8"></script>
@endsection
