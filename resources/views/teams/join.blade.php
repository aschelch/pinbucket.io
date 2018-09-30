@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

          <h2>Join a team</h2>
          <p>The creator of the team should give you the team code. You just have to put it here : </p>
          <form method="POST" action="/join">
            <div class="form-group" >
              <input class="form-control" type="text" name="token" class="form-control input-lg" placeholder="Your team code" />
            </div>
            <div class="form-group ">
              <button type="submit" class="btn btn-hg btn-primary">Join the team</button>
            </div>
            {{ csrf_field() }}
          </form>

        </div>
    </div>
</div>
@endsection
