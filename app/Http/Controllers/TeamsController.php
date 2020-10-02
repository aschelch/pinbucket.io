<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\Team;

class TeamsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    return view('teams.index');
  }

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

    $team->users()->attach(Auth::id());

    return redirect('home');
  }

  public function join(Request $request)
  {
      return view('teams.join');
  }

  public function joining(Request $request){
      $team = Team::where('token', $request->token)->first();

      if(!empty($team)){
        $team->users()->attach(Auth::id());
        return redirect('home');
      }
      return view('teams.join');
  }

  public function quit($teamId){
    $team = Team::find($teamId);
    if(empty($team)){
      return redirect('home');
    }

    $team->users()->detach(Auth::id());
    return redirect('home');
  }

}
