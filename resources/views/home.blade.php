@extends('layouts.app')

@section('styles')
@parent
<link href="{{ mix('/css/home.css') }}" rel="stylesheet">
@endsection

@section('content-title', 'Home')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="card chat-room">
        <div class="header">
          <h4 class="title">Chats</h4>
          <p class="category">Chat room</p>
        </div>
        <div class="content">
          <div class="messages-container">
            <chat-messages
                :messages="messages"
                :user="user"
            ></chat-messages>
          </div>
          <chat-form
              v-on:messagesent="messagesStore"
              :user="user"
          ></chat-form>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="header">
          <h4 class="title">Maps</h4>
          <p class="category">Maps</p>
        </div>
        <div class="content">
          <div id="map" style="height:390px"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="header">
          <h4 class="title">Email Statistics</h4>
          <p class="category">Last Campaign Performance</p>
        </div>
        <div class="content">
          <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

          <div class="footer">
            <div class="legend">
              <i class="fa fa-circle text-info"></i> Open
              <i class="fa fa-circle text-danger"></i> Bounce
              <i class="fa fa-circle text-warning"></i> Unsubscribe
            </div>
            <hr>
            <div class="stats">
              <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="card">
        <div class="header">
          <h4 class="title">Users Behavior</h4>
          <p class="category">24 Hours performance</p>
        </div>
        <div class="content">
          <div id="chartHours" class="ct-chart"></div>
          <div class="footer">
            <div class="legend">
              <i class="fa fa-circle text-info"></i> Open
              <i class="fa fa-circle text-danger"></i> Click
              <i class="fa fa-circle text-warning"></i> Click Second Time
            </div>
            <hr>
            <div class="stats">
              <i class="fa fa-history"></i> Updated 3 minutes ago
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card ">
        <div class="header">
          <h4 class="title">2014 Sales</h4>
          <p class="category">All products including Taxes</p>
        </div>
        <div class="content">
          <div id="chartActivity" class="ct-chart"></div>

          <div class="footer">
            <div class="legend">
              <i class="fa fa-circle text-info"></i> Tesla Model S
              <i class="fa fa-circle text-danger"></i> BMW 5 Series
            </div>
            <hr>
            <div class="stats">
              <i class="fa fa-check"></i> Data information certified
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('/js/manifest.js') }}" charset="utf-8"></script>
<script src="{{ mix('/js/vendor.js') }}" charset="utf-8"></script>
<script src="{{ mix('/js/home.js') }}" charset="utf-8"></script>
@endsection

@push('body')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
@endpush
