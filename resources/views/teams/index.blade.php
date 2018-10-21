@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-8">
          <h2>Your teams</h2>
            @foreach(Auth::user()->teams()->with('users')->get() as $team)
            <h4>{{$team->name}}</h4>
            <p>
              Team code : <strong>{{$team->token}}</strong><br/>
              @php ($members = $team->users()->orderBy('name')->get())
              Members ({{$members->count()}}) : {{$members->pluck('name')->implode(', ')}}
            </p>
            @endforeach

            <p>
              <a class="btn btn-md btn-primary" href="{{ route('team.add') }}" role="button">Create a new Team</a>
              <a class="btn btn-md btn-primary" href="{{ route('team.join') }}" role="button">Join a Team</a><p>
        </div>
    </div>
</div>
@endsection
