@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
          <h2>Your teams</h2>
            @foreach(Auth::user()->teams()->with('users')->get() as $team)
            <h4>{{$team->name}} <small>(Code : {{$team->token}})</small></h4>
            <p>
              @php ($members = $team->users()->orderBy('created_at')->get())
              @foreach($members as $member)
                <img class="user-picture" src="{{ Gravatar::src($member->email, 40) }}" title="{{$member->name}}">
              @endforeach
            </p>
            @endforeach

            <p>
              <a class="btn btn-md btn-primary" href="{{ route('team.add') }}" role="button">Create a new Team</a>
              <a class="btn btn-md btn-primary" href="{{ route('team.join') }}" role="button">Join a Team</a><p>
        </div>
    </div>
</div>
@endsection
