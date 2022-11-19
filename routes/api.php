<?php

use Illuminate\Http\Request;
use App\Team;
use App\User;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\UnauthorizedException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->post('/login', function (Request $request) {
    $credentials = request(['email', 'password']);
    if(Auth::attempt($credentials)){
        return Auth::user();
    }
    throw new UnauthorizedException();
});

Route::middleware(['api', 'auth:api'])->get('/teams', function (Request $request) {
    $teams = Auth::user()->teams;
    $teams->each(function($team) {
        $team->load(['links' => function($q){$q->latest('created_at')->limit(20);}, 'links.user:id,name']);
    });
    return $teams;
});

Route::middleware('auth:api')->get('/links/{teamId}', function (Request $request, $teamId) {
    $team = Team::find($teamId);
    if(empty($team) || ! $team->users->contains($request->user()->id)){
        throw new NotFoundResourceException(sprintf('No team found with id %s', $teamId));
    }
    $links = $team->links()->latest('created_at')->paginate(50);
    return $links;
});

Route::middleware('api')->post('/webhook', function (Request $request) {
    $event = $request->input('type');
    switch($event){
        case 'payment_intent.succeeded':
            $email = $request->input("data.object.charges.data.0.billing_details.email");

            break;
        default:
            Log::warning('Unhandled event type '.$event);
            break; 
    }
    return ['received'=>true];
});
