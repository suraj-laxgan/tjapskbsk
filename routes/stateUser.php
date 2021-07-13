<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\stateUser\LoginController;
use App\Http\Controllers\stateUser\MembershipController;




/* 
|--------------------------------------------------------------------------
| stateUser Routes
|--------------------------------------------------------------------------
|
| Here is where you can register stateUser routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/







require __DIR__ . '/auth.php';  

Route::get('state/dashboard', function () {
    return view('stateUser.stateUserHome');
})->middleware(['auth:stateUser'])->name('state.dashboard');

Route::get('/state-login', [LoginController::class, 'create'])
    ->middleware('guest:stateUser')
    ->name('state.login');

Route::post('/state-login', [LoginController::class, 'store'])
    ->middleware('guest:stateUser');

Route::post('/state-logout', [LoginController::class, 'destroy'])
    ->name('state.logout')
    ->middleware('auth:stateUser');

Route::get('/state-mem',[MembershipController::class,'stateMem'])->name('state.mem');
Route::get('/ad-state-member',[MembershipController::class,'stateMember'])->name('state.statemember');
Route::post('/state-member-regis',[MembershipController::class,'stateMemberRegis'])->name('state.adminmemberregis');
Route::post('/find-designation-name',[MembershipController::class ,'findDesignationName'])->name('state.designationname');
Route::post('/find-dis-name',[MembershipController::class ,'findDisName']);

Route::get('state-exismember',[MembershipController::class,'stateExisMember'])->name('state.adminexmember');
Route::get('/state-mem-view/{id}',[MembershipController::class,'statememView'])->name('state.mem-view');
Route::get('/state-mem-edit/{id}',[MembershipController::class,'stateMemEdit'])->name('state.mem-edit');
Route::post('/state-mem-edit-upload',[MembershipController::class,'stateMemUpload'])->name('state.upload');

Route::get('mem-excel-wb', [MembershipController::class, 'memExcel'])->name('memexcel.state');
Route::get('pdf-gen-state', [MembershipController::class, 'generatePDF'])->name('pdf.generatestate');






