<?php

use App\Http\Controllers\ProfileController;
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
Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('delete.user')->middleware('auth');
route::post('/user/ban/{id}', [UserController::class, 'ban'])->name('ban.user')->middleware('auth');
route::post('/user/Unban/{id}', [UserController::class, 'Unban'])->name('Unban.user')->middleware('auth');
// Route::post('/user/edit/{id}', function ($id) {
//     return view('edit',['id' => $id]);
// });
route::post('/user/show_edit/{id}', [UserController::class, 'show_edit'])->name('show_edit.user')->middleware('auth');

route::post('/user/name-edit/{id}', [UserController::class, 'name_edit'])->name('name-edit.user')->middleware('auth');
route::post('/user/pass-edit/{id}', [UserController::class, 'pass_edit'])->name('pass-edit.user')->middleware('auth');
Route::post('/upload/photo', [UserController::class, 'photo'])->name('upload.photo');





// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
