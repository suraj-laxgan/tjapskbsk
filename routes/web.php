<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\galleryController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/about-us', function () {
    return view('aboutUs');
});
Route::get('/message', function () {
    return view('message');
});
Route::get('/ourprogram', function () {
    return view('ourprogram');
});
Route::get('/gal',[galleryController::class,'gallShow'])->name('m.gall');
Route::get('/twenty-point', function () {
    return view('twentyPoint');
});
Route::get('/safe-drive', function () {
    return view('safeDriveSaveLife');
});
Route::get('/kanyashree', function () {
    return view('kanyashree');
});
Route::get('/beti-bachao-beti-padhao', function () {
    return view('betiBachao');
});
Route::get('/more-video', function () {
    return view('videoGallery');
});
Route::get('/contact-us',[galleryController::class,'contactUs'])->name('contact.us');
Route::post('/contact-us-msg',[galleryController::class,'contactUsMsg'])->name('contact.msg');
Route::get('/search',[galleryController::class,'searchMem'])->name('search.mem');
