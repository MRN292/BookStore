<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagsandCategory;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('shop');
});


Route::get('/users', [UserController::class, 'show'])->name('show.user')->middleware('auth');

// ban and unban and remove users
Route::delete('/users/delete', [UserController::class, 'delete'])->name('delete.user')->middleware('auth');
route::post('/users/ban', [UserController::class, 'ban'])->name('ban.user')->middleware('auth');
route::post('/users/Unban', [UserController::class, 'Unban'])->name('Unban.user')->middleware('auth');


//edit password and user
route::get('/users/show_edit', [UserController::class, 'show_edit'])->name('show_edit.user')->middleware('auth');
route::post('/users/name-edit', [UserController::class, 'name_edit'])->name('name-edit.user')->middleware('auth');
route::post('/users/pass-edit', [UserController::class, 'pass_edit'])->name('pass-edit.user')->middleware('auth');

Route::post('/upload/photo', [UserController::class, 'photo'])->name('upload.photo');

//change the role
Route::post('/users/change-role', [UserController::class, 'change_role'])->name('change.role');

// sort and seach users
Route::get('/users/search_sort', [UserController::class, 'search_sort'])->name('search.sort');

// tag and category
Route::get('/TagsAndGenre',[TagsandCategory::class, 'show'])->name('tags_and_genres');
Route::post('/TagsAndGenre/AddTag',[TagController::class, 'add'])->name('add_tag');
Route::post('/TagsAndGenre/AddGenre',[CategoryController::class, 'add'])->name('add_genre');


//add book
Route::get('/addBoook',[TagsandCategory::class, 'add_book'])->name('add_boook');







// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
