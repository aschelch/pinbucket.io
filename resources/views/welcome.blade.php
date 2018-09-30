@extends('layouts.app')

@section('content')

<div class="container">

  <!-- Main component for a primary marketing message or call to action -->
  <div class="jumbotron">
    <h1>Share tech articles with your teammates</h1>
    <p>With PinBucket.io you can store all your links. Your teammates can then find them easily!</p>
    <p>
      <a class="btn btn-lg btn-primary" href="{{ url('register') }}" role="button">Sign up &raquo;</a>
    </p>
  </div>

  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="browser-mockup">
        <img src="img/screenshot.png" style="width:100%"/>
      </div>
    </div>
  </div>

    <div class="row">
      <div class="col-sm-8 col-sm-offset-2">

      </div>
    </div>

</div>

@endsection
