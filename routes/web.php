<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ALbumController;

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

Route::get('/artist', [ArtistController::class, 'index']);
Route::get('/artist/create', [ArtistController::class, 'create']);
Route::post('/artist/store', [ArtistController::class, 'store']);
Route::get('/artist/{id}/edit', [ArtistController::class, 'edit']);
Route::post('/artist/{id}/update', [ArtistController::class, 'update']);
Route::get('/artist/{id}/delete', [ArtistController::class, 'delete']);

Route::prefix('album')->group(function () {
    Route::get('/', [AlbumController::class, 'index']);
    Route::get('/create', [AlbumController::class, 'create']);
    Route::post('/store', [AlbumController::class, 'store']);
    Route::get('/{id}/edit', [AlbumController::class, 'edit']);
    Route::post('/{id}/update', [ArtistController::class, 'update']);
    Route::get('/{id}/delete', [ArtistController::class, 'delete']);
});




Route::get('/db', function () {
    // Schema::create('artists', function ($table) {
    //     $table->increments('id');
    //     $table->text('name');
    //     $table->string('username', 32);
    //     $table->string('email', 320);
    //     $table->string('password', 60);
    //     $table->timestamps();
    // });
    Schema::create('example', function ($table) {
        $table->string('name')->default('John Doe');
    });
});
   
// Route::get('/', function () {
//     return 'Hello world2!';
//     });

// Route::get('/books', function () {
//     return 'Books index.';
//     });

// Route::get('/books/{genre}', function ($genre) {
//     return "Books in the {$genre} category.";
//     });

// Route::get('/books/{genre?}', function ($genre = 'Crime') {
//     if ($genre == null) {
//     return 'Books index.';
//     }
//     return "Books in the {$genre} category.";
//    });
// Route::get('/books/{genre?}', function ($genre = 'Crime') {
//     return "Books in the {$genre} category.";
//     });

// Route::get('/views', function () {
//     return View::make('simple');
//    });

// Route::get('/{squirrel}', function ($squirrel) {
//     $data['something'] = 'Giant Panda';
//     $data['manyThings'] = array('one', 'two', 3);

//     return View::make('simple', $data);
// });
