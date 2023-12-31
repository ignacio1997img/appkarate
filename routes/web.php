<?php

use App\Http\Controllers\TournamentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect('admin/login');
})->name('login');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('tournaments', [TournamentController::class, 'index'])->name('voyager.tournaments.index');
    Route::get('tournaments/ajax/list/{search?}', [TournamentController::class, 'list']);

    Route::get('tournaments/{tournament}/referee', [TournamentController::class, 'indexReferee'])->name('tournaments.referee');
    Route::get('tournaments/referee/ajax/list/{tournament}/{search?}', [TournamentController::class, 'listArbitro']);
    Route::post('tournaments/referee/store', [TournamentController::class, 'storeReferee']);
    Route::delete('tournaments/referee/{referee?}/destroy', [TournamentController::class, 'destroyReferee'])->name('tournaments-referee.destroy'); 


    Route::get('type', [TournamentController::class, 'indexType'])->name('tournaments.type');
    Route::get('type/ajax/list/{search?}', [TournamentController::class, 'listType']);
    Route::post('type/store', [TournamentController::class, 'storeType']);
    Route::delete('type/{type?}/destroy', [TournamentController::class, 'destroyType'])->name('type.destroy'); 

    Route::get('tournaments/{tournament}/type/{type}/competitor', [TournamentController::class, 'indexCompetitor'])->name('tournaments-type.competitor');
    Route::get('tournaments/type/competitor/ajax/list/{type}/{search?}', [TournamentController::class, 'listCompetitor']);
    Route::post('tournaments/type/competitor/store', [TournamentController::class, 'storeCompetitor']);
    Route::post('tournaments/type/competitor/update', [TournamentController::class, 'updateCompetitor']);
    Route::delete('tournaments/type/competitor/{competitor?}/destroy', [TournamentController::class, 'destroyCompetitor'])->name('tournaments-competitor.destroy'); 




});

// Route::get('/admin/clear-cache', function() {
//     Artisan::call('optimize:clear');
//     return redirect('/admin')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
// })->name('clear.cache');
