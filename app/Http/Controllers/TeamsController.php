<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\Team;

class TeamsController extends Controller
{
    public function add()
    {
      return view('teams.add');
    }

    public function create(Request $request)
    {
      $team = new Team();
      $team->name = $request->name;
      $team->token = Str::random(32);
      $team->owner_id = Auth::id();
      $team->save();

      $team->members()->attach(Auth::id());

      return redirect('home');
    }
}
