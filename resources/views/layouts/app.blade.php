<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @stack('head')
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flat-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-29420054-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-29420054-2');
</script>


</head>
<body>
    <div id="app">

          <!-- Static navbar -->
          <div class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                </button>
                <a class="navbar-brand" href="{{ Auth::check() ? url('home') : url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
              </div>
              <div class="navbar-collapse navbar-inverse collapse">
                <ul class="nav navbar-nav">
                  @auth
                  @foreach(Auth::user()->teams as $userTeam)
                  <li class="nav-item {{ (isset($team) && $userTeam->id == $team->id) ? 'active':'' }}">
                      <a class="nav-link" href="{{ route('home', $userTeam->id) }}" data-team-id="{{ $userTeam->id }}">{{ $userTeam->name }}</a>
                  </li>
                  @endforeach
                  @endauth
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <!-- Authentication Links -->
                  @guest
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                      </li>
                      <li class="nav-item">
                          @if (Route::has('register'))
                              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                          @endif
                      </li>
                  @else
                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              <img style="vertical-align:middle" class="user-picture" src="{{ Gravatar::src(Auth::user()->email, 20) }}"> {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('team.index') }}">{{ __('Teams') }}</a>
                            </li>
                            <li>

                              <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                              </li>
                          </ul>
                      </li>
                  @endguest
                </ul>
              </div><!--/.nav-collapse -->
            </div>
          </div>

        <main class="py-4">


          @if (session('status'))
          <div class="container">
              <div class="row">
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
            </div>
          <div>
          @endif
            @yield('content')
        </main>

        <footer>
          <div class="container" style="padding:10px 0;">
            <div class="row">
              <div class="col-sm-7">
                &copy; <?= date('Y');?> PinBucket.io.<br/> It's Open source <a href="https://github.com/aschelch/pinbucket.io" target="_blank"><span class="fui-github"></span></a> 

              </div> <!-- /col-7 -->
              <div class="col-sm-5 text-right">
                Made with <span class="fui-heart" style="color:red"></span> by <a href="http://aschelch.fr" target="_blank">aschelch</a><br>
                <a href="https://twitter.com/aschelch" target="_blank"><span class="fui-twitter"></span></a> 
                <a href="https://github.com/aschelch" target="_blank"><span class="fui-github"></span></a>
                <a href="https://www.linkedin.com/in/aur%C3%A9lien-schelcher-3247172b"><span class="fui-linkedin"></span></a>
            </div> 
            </div>
          </div>
        </footer>

    </div>
</body>
</html>
