<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Link;
use diversen\meta;

class LinksController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function create(Request $request)
  {

    $team = Team::find($request->team_id);
    if( ! $team->users->contains(Auth::id())){
      return redirect()->back();
    }

    if (filter_var($request->url, FILTER_VALIDATE_URL) === FALSE) {
      return redirect()->back();
    }

    $metaExtractor = new meta();
    $meta = $metaExtractor->getMeta($request->url);

    $link = new Link();
    $link->url = $request->url;

    $link->title = $request->url;
    if(isset($meta['title'])){
      $link->title = $meta['title'];
    }
    $link->description = '';
    if(isset($meta['description'])){
      $link->description = $meta['description'];
    }

    $link->user_id = Auth::id();
    $link->team_id = $request->team_id;
    $link->save();

    return redirect()->back();
  }
}
