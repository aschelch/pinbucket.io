@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

          <h2>Create a team</h2>
          <form method="POST" action="/team">
            <div class="form-group" >
              <input class="form-control" type="text" name="name" class="form-control input-lg" placeholder="My awesome team" />
            </div>
            <div class="form-group ">
              <button type="submit" class="btn btn-hg btn-primary">Let's go</button>
            </div>
            {{ csrf_field() }}
          </form>

        </div>
    </div>
</div>
@endsection
