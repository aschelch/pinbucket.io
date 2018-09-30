@extends('layouts.app')

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


      <div class="row">
          <div class="col-md-12">

          <ul class="list-unstyled link-list">
            @foreach($links as $link)
            <li class="link-row" style="position:relative">
                <p style="margin-left: 65px;">
                  <img src="{{ Gravatar::src($link->user()->first()->email, 50) }}">
                  <a class="link-title" target="_blank" href="{{ $link->url }}">{{ $link->title }} <span class="link-url">({{str_limit($link->url, 50)}})</span></a> <br/>
                  <span class="link-description">{{str_limit($link->description, 300)}}</span><br/>
                  <span class="link-info">Added {{\Carbon\Carbon::parse($link->created_at)->diffForHumans()}} by <strong>{{$link->user()->first()->name}}</strong></span>
                </p>
            </li>
            @endforeach
          </ul>

          {{$links->render()}}

        </div>
    </div>
    @endif
</div>
@endsection
