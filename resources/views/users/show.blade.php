@extends('layouts.app')

@section('content-title', 'Users')

@section('content')
<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="card">
      <div class="header">
        <h4 class="title">Users Detail</h4>
        <p class="category">Here is a detail of users</p>
      </div>
      <div class="content">
        <table class="table table-fixed" width="100%">
          <tbody>
            <colgroup>
              <col class="col-xs-4">
              <col class="col-xs-8">
            </colgroup>
            @foreach ([ 'name', 'email' ] as $key)
            <tr>
              <th class="text-truncate">{{ title_case(str_replace('_', ' ', $key)) }}</th>
              <td class="text-truncate">{{ $user->{$key} }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="pull-right">
          <a href="{{ route('users.edit', [ $user->id ]) }}" class="btn btn-info btn-fill">Edit</a>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-default btn-fill">List</a>
      </div>
    </div>
  </div>
</div>
@endsection
