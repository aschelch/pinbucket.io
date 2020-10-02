@extends('layouts.app')

@push('head')

@if (!empty($team))
<script>var teamId=<?php echo $team->id?>;</script>
@endif

@endpush

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

          @if (Auth::user()->teams->isEmpty())
            <p>To start sharing articles or blog post, you have to create a team or join one !</p>
            <p><a class="btn btn-hg btn-primary" href="{{ route('team.add') }}" role="button">Create a new Team</a> or <a class="btn btn-md btn-primary" href="{{ route('team.join') }}" role="button">Join a Team</a><p>
          @endif

        </div>
      </div>

      @if (!Auth::user()->teams->isEmpty())



      <div class="row">
        <form method="POST" action="/link">
          <div class="col-lg-12">
            <div class="form-group">
              <div class="input-group">
                <input type="url" name="url" class="form-control" placeholder="Share a link with the team https://..." />
                <input type="hidden" name="team_id" value="{{$team->id}}" />
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-default">Share the link</button>
                </span>
              </div><!-- /input-group -->
            </div><!-- /.form-group -->
          </div>
          {{ csrf_field() }}
        </form>
      </div>


        @foreach($links as $link)

        <div class="row link-row">
          <div class="col-sm-3 col-md-2 text-center hidden-xs">
            <a class="link-title" target="_blank" href="{{ $link->url }}"><img class="img-rounded img-responsive" id="preview-link-{{ $link->id }}" src="{{ $link->preview }}"/></a>
          </div>
          <div class="col-sm-9 col-md-10 col-xs-12">
              <a class="link-title" target="_blank" href="{{ $link->url }}">{{ $link->title }} <span class="link-url">({{str_limit($link->url, 50)}})</span></a> <br/>
              <span class="link-description">{{str_limit($link->description, 300)}}</span><br/>
              <span class="link-info">
                Added {{\Carbon\Carbon::parse($link->created_at)->diffForHumans()}} by <img class="user-picture" src="{{ Gravatar::src($link->user()->first()->email, 25) }}"/> <strong>{{$link->user()->first()->name}}</strong>

                @if (Auth::id() == $link->user_id)

                  {{ Form::open(['method' => 'DELETE', 'route' => 'link.destroy', 'class' => 'link-destroy' ]) }}
                  {{ Form::hidden('id', $link->id) }}
                  {{ Form::submit('Delete', ['class' => 'btn btn-link btn-sm', 'onclick' => "return confirm('Are you sure you want to delete this link?');"]) }}
                  {{ Form::close() }}

                @endif
              </span>
          </div>
        </div>
        @endforeach

        {{$links->render()}}

    @endif
</div>
@endsection
