@extends('light-bootstrap-dashboard::layouts.main')

@section('sidebar-menu')
<ul class="nav">
  <li class="{{ starts_with(url()->current(), route('home')) ? 'active' : '' }}">
    <a href="{{ route('home') }}">
      <i class="pe-7s-home"></i>
      <p>Home</p>
    </a>
  </li>
  <li class="{{ starts_with(url()->current(), route('users.index')) ? 'active' : '' }}">
    <a href="{{ route('users.index') }}">
      <i class="pe-7s-user"></i>
      <p>Users</p>
    </a>
  </li>
</ul>
@endsection
