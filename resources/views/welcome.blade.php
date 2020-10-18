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
    <div class="col-sm-8">
      <div class="browser-mockup">
        <img src="img/screenshot.png" style="width:100%"/>
      </div>
    </div>
    <div class="col-sm-4">

      <div class="tile">
          <img src="/img/icons/svg/ribbon.svg" alt="ribbon" class="tile-hot-ribbon">
          <img src="/img/icons/svg/google-chrome.svg" alt="Chrome extension" class="tile-image">
          <h3 class="tile-title">Chrome extension</h3>
          <p>Share link quickly and easily using the PinBucket chrome extension</p>
          <a class="btn btn-primary btn-large btn-block" target="_blank" href="https://chrome.google.com/webstore/detail/pinbucketio/mpplanibjojjmpgljmaionncaadmpamf?hl=fr">Install Chrome extension</a>
        </div>
    </div>
  </div>

    <div class="row">
      <div class="col-sm-8 col-sm-offset-2">

      </div>
    </div>

</div>

@endsection
