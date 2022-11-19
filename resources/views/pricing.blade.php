
@extends('layouts.app')

@section('content')

<div class="container pricing">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1>Ready to go further ?</h1>
      <p>Unlock all PinBucket features by subscribing to one a below plans</p>
    </div>
  </div>
  <div class="row plans">
    <div class="col-md-4 text-center">
      <div class="alert plan">
        <h4>Free plan</h4>
        <h2>0€</h2>
        <h5 class="text-muted">forever</h5>
        <ul class="list-group">
          <li class="list-group-item"><b>1</b> team</li>
          <li class="list-group-item"><b>3</b> members</li>
          <li class="list-group-item"><b>90 days</b> data retention</li>
        </ul>
        @if (Auth::user() && Auth::user()->plan == 'free')
          <a href="#" class="btn btn-hg btn-block btn-default">Your plan</a>
        @else
          <a href="#" class="btn btn-hg btn-block">Default plan</a>
        @endif
      </div>
    </div>
    <div class="col-md-4 text-center">
      <div class="alert plan">
        <h4>Monthly plan</h4>
        <h2>5€</h2>
        <h5 class="text-muted">per month</h5>
        <ul class="list-group">
          <li class="list-group-item"><b>unlimited</b> team</li>
          <li class="list-group-item"><b>unlimited</b> members</li>
          <li class="list-group-item"><b>unlimited</b> data retention</li>
        </ul>
        @if (Auth::user() && Auth::user()->plan == 'monthly')
        <a href="mailto:unsubscribe@pinbucket.io" class="btn btn-hg btn-block btn-primary">Unsubscribe</a>
        @else
        <a href="https://buy.stripe.com/test_14k6p79aE7dsgy48ww" class="btn btn-hg btn-block btn-primary">Subscribe</a>
        @endif
      </div>
    </div>
    <div class="col-md-4 text-center">
      <div class="alert plan">
        <h4>Yearly plan</h4>
        <h2>50€</h2>
        <h5 class="text-muted">per year</h5>
        <ul class="list-group">
          <li class="list-group-item"><b>unlimited</b> team</li>
          <li class="list-group-item"><b>unlimited</b> members</li>
          <li class="list-group-item"><b>unlimited</b> data retention</li>
        </ul>
        @if (Auth::user() && Auth::user()->plan == 'monthly')
        <a href="mailto:unsubscribe@pinbucket.io" class="btn btn-hg btn-block btn-primary">Unsubscribe</a>
        @else
        <a href="https://buy.stripe.com/test_bIY14Nfz2eFU4Pm001" class="btn btn-hg btn-block btn-primary">Subscribe</a>
        @endif
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 text-center">
      <p>To unsubscribe, just send us a mail at <a href="mailto:unsubscribe@pinbucket.io">unsubscribe@pinbucket.io</a>.</p>
    </div>
  </div>
</div>
@endsection
