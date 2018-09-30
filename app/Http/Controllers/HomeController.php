<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use App\Team;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teamId = null)
    {

      if($teamId){
        $team = Team::find($teamId);

        if( ! $team->users->contains(Auth::id())){
          return redirect('home');
        }
      }else{
        $team = Auth::user()->teams->first();
      }

      if($team){
        $links = $team->links()->latest('created_at')->get();
      }else{
        $links = null;
      }
      return view('home', compact('team', 'links'));
    }
}
