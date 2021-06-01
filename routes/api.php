<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Person;
use App\Http\Controllers\PersonController;

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

//Route::get('/people', [PersonController::class, 'index']);
Route::resource('people', PersonController::class);

Route::get('/test', function(){
    return ['message' => 'hello!'];
});

Route::get('/add-person', function(){
    $person = Person::create([
	'firstName' => 'Vasiliy',
	'lastName' => 'Pupkin'
    ]);

    return $person;
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
