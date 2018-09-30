@extends('layouts.app')

@section('content')

<div class="container">

  <!-- Main component for a primary marketing message or call to action -->
  <div class="jumbotron">
    <h1>Share articles and blog posts with your colleagues</h1>
    <p>This example is a quick exercise to illustrate how the default, static and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
    <p>To see the difference between static and fixed top navbars, just scroll.</p>
    <p>
      <a class="btn btn-lg btn-primary" href="{{ url('register') }}" role="button">Sign up &raquo;</a>
    </p>
  </div>
</div>

@endsection
