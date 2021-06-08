<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Models\Person;
//use App\Http\Controllers\PersonController;
//use App\Models\Human;
//use App\Http\Controllers\HumanController;
use App\Models\Statement;
use App\Http\Controllers\StatementController;

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
//Route::resource('people', PersonController::class);
//Route::resource('humans', HumanController::class);
//Route::put('/humans', [HumanController::class, 'update']);

Route::get('/statements/all', [StatementController::class, 'index'])->middleware('auth');  //not in task list
Route::post('/statements/add', [StatementController::class, 'store'])->middleware('auth');
Route::post('/statements/edit', [StatementController::class, 'update'])->middleware('auth');
Route::post('/statements/show', [StatementController::class, 'show'])->middleware('auth');
Route::post('/statements/delete', [StatementController::class, 'destroy'])->middleware('auth');


/*
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
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
