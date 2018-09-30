@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endif

          <h3>Welcome {{Auth::user()->name}}</h3>
          @if (Auth::user()->teams->isEmpty())
            <p>To start sharing articles or blog post, you have to create a team or join one !</p>
            <p><a class="btn btn-hg btn-primary" href="{{ route('team.add') }}" role="button">Create a new Team</a> or <a class="btn btn-md btn-primary" href="{{ route('team.join') }}" role="button">Join a Team</a><p>
          @endif


        </div>
    </div>
</div>
@endsection
