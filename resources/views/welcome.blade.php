@extends('layouts.app')

@section('content')

<div class="container">

  <!-- Main component for a primary marketing message or call to action -->
  <div class="jumbotron">
    <h1>Share tech articles with your colleagues</h1>
    <p>Sometimes you want to share some interesting link with your colleagues, so you send it on Slack or by email. Great! Unfortunalty after a few hours, your link is lost under hundred of other message...</p>
    <p>With PinBucket.io you can store all your links and add tags to them. Your colleagues can then find them easily!</p>
    <p>
      <a class="btn btn-lg btn-primary" href="{{ url('register') }}" role="button">Sign up &raquo;</a>
    </p>
  </div>
</div>

@endsection
