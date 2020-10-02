@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
          <h2>Your teams</h2>

            <p>
              <a class="btn btn-md btn-primary" href="{{ route('team.add') }}" role="button">Create a new Team</a>
              <a class="btn btn-md btn-primary" href="{{ route('team.join') }}" role="button">Join a Team</a>
            <p>

            @foreach(Auth::user()->teams()->with('users')->get() as $team)
            <h4>{{$team->name}} <small>(Code : {{$team->token}} <span class="fui-exit copy" data-token="{{$team->token}}" onclick="copyToClipboard(this)" title="Copy team code"></span>)</small></h4>
            <p>
              @php ($members = $team->users()->orderBy('created_at')->get())
              @foreach($members as $member)
                <img class="user-picture" src="{{ Gravatar::src($member->email, 40) }}" title="{{$member->name}}">
              @endforeach
            </p>
            <p><a class="btn btn-xs btn-default" href="{{ route('team.quit', $team->id) }}" role="button" onclick="return confirm('Are you sure you want to quit this team?');">Quit the team</a><p>
            @endforeach
        </div>
    </div>
</div>

<script type="text/javascript">

function copyToClipboard(span){
  var el = document.createElement('textarea');  
  el.value = span.dataset.token;
  el.setAttribute('readonly', '');
  el.style.position = 'absolute';
  el.style.left = '-9999px';
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
  alert('Team code copied')
};

</script>

@endsection
