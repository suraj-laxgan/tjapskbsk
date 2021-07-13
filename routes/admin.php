<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminStateController;
use App\Http\Controllers\Admin\AdminMemberController;
use App\Http\Controllers\Admin\AdminMasterEntryController;
use App\Http\Controllers\Admin\AdminFunctionController;


use App\Http\Controllers\Admin\AdminMailController;


/* 
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('admin-lo', function () {
//     return view('admin.adminLogin');
// });



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';  

Route::get('admin/dashboard', function () {
    return view('admin.adminHome');
})->middleware(['auth:admin'])->name('admin.dashboard');

Route::get('/suadmin-login', [AdminLoginController::class, 'create'])
    ->middleware('guest:admin')
    ->name('admin.login');

Route::post('/suadmin-login', [AdminLoginController::class, 'store'])
    ->middleware('guest:admin');

Route::post('/admin-logout', [AdminLoginController::class, 'destroy'])
    ->name('admin.logout')
    ->middleware('auth:admin');
// ########### Admin State Start ##########

Route::get('/admin-state-main',[AdminStateController::class,'adminStateMain'])->name('admin.statemain');
Route::get('/admin-state',[AdminStateController::class,'adminState'])->name('admin.state');
Route::post('/admin-add-state',[AdminStateController::class,'addState'])->name('admin.addstate');
Route::get('/admin-state-view',[AdminStateController::class,'adminStateView'])->name('admin.state-view');
Route::get('/admin-state-edit/{id}',[AdminStateController::class,'StateEdit'])->name('admin.state_edit');
Route::post('/admin-state-edit-upload',[AdminStateController::class,'adminStateEditUp'])->name('admin.stateup');
// ########### Admin State End ##########

// ########### Admin Membership Start ##########

Route::get('/ad-member-main',[AdminMemberController::class,'adminMemberMain'])->name('ad.adminmembermain');

// Membership Registration Form

Route::get('/ad-member',[AdminMemberController::class,'adminMember'])->name('ad.adminmember');
Route::post('/ad-member-regis',[AdminMemberController::class,'adminMemberRegis'])->name('ad.adminmemberregis');
Route::post('/find_designation_name',[AdminMemberController::class ,'findDesignationName'])->name('admin.designationname');
Route::post('/find_dis_name',[AdminMemberController::class ,'findDisName']);
Route::post('/find-state-name',[AdminMemberController::class ,'findStateName']);

// Search Existing Member

Route::get('ad-exismember',[AdminMemberController::class,'adminExisMember'])->name('ad.adminexmember');
Route::get('/admin-mem-view/{id}',[AdminMemberController::class,'memView'])->name('admin.mem-view');
// Route::get('/admin-mem-view',[AdminMemberController::class,'memView'])->name('admin.mem-view');
Route::get('/admin-mem-edit/{id}',[AdminMemberController::class,'memEdit'])->name('admin.mem-edit');
Route::post('/admin-mem-edit-upload',[AdminMemberController::class,'adminMemUpload'])->name('admin.upload');
Route::get('mem-excel', [AdminMemberController::class, 'memExcel'])->name('memexcel');
Route::get('pdf-gen', [AdminMemberController::class, 'generatePDF'])->name('pdf.generatemem');

// Search Member Query

Route::get('ad-member-query',[AdminMemberController::class,'adminMemberQuery'])->name('ad.adminMeMQue');
Route::get('mem-query-excel', [AdminMemberController::class, 'memQueryExcel'])->name('memqueryexcel');
Route::get('/admin-mem-query-view/{id}',[AdminMemberController::class,'memQueryView'])->name('admin.memQuery-view');
Route::get('/admin-mem-query-edit/{id}',[AdminMemberController::class,'memQueryEdit'])->name('admin.memQuery-edit');
Route::post('/admin-mem-query-upload',[AdminMemberController::class,'adminMemQueryUpload'])->name('admin.memQueryUpload');


// Export Member

Route::get('/ad-expo-member',[AdminMemberController::class,'adminExpoMember'])->name('ad.adminExpoMeM');
Route::get('/ad-mem-export/{id}',[AdminMemberController::class,'memExport'])->name('admin.Export');

// Confirmation Letter

Route::get('ad-confi-letter',[AdminMemberController::class,'adminConfiLetter'])->name('ad.adminConfiLt');
Route::get('/ad-ma-print/{id}',[AdminMemberController::class,'maPrint'])->name('ma.print');

// Joining Letter
Route::get('ad-joining-letter',[AdminMemberController::class,'adminJoinLetter'])->name('ad.adminJoinLt');

Route::get('ad-repjoining-letter',[AdminMemberController::class,'adminRePrintJoiningLetter'])->name('ad.adminRepriJoinLt');

Route::get('ad-decal-letter',[AdminMemberController::class,'adminDeclarationLetter'])->name('ad.adminDeclaLt');

Route::get('ad-reprindecal-letter',[AdminMemberController::class,'adminRepnDeclarationLetter'])->name('ad.adminRepnDeclaLt');

Route::get('ad-appointment-letter',[AdminMemberController::class,'adminAppointmentLetter'])->name('ad.adminAppointlaLt');

Route::get('ad-rep-appointment-letter',[AdminMemberController::class,'adminRepnAppointmentLetter'])->name('ad.adminRepAppointlaLt');

// ########### Admin Membership End ##########

//  Master Entry
Route::get('ad-mas',[AdminMasterEntryController::class,'adminMas'])->name('ad.mas');

Route::get('ad-designation',[AdminMasterEntryController::class,'adminDesignation'])->name('ad.designation');

Route::get('ad-organiser',[AdminMasterEntryController::class,'adminOrganiser'])->name('add.Organiser');

Route::get('ad-districts',[AdminMasterEntryController::class,'adminAddDistrict'])->name('add.District');

Route::get('ad-block',[AdminMasterEntryController::class,'adminAddBlock'])->name('add.Block');

Route::get('ad-staff',[AdminMasterEntryController::class,'adminAddStaff'])->name('add.Staff');

Route::get('ad-cuser',[AdminMasterEntryController::class,'adminCreateUser'])->name('add.Creuser');
Route::post('ad-cuser',[AdminMasterEntryController::class,'addCreateUser'])->name('add.Createuse');



// Function
Route::get('ad-function',[AdminFunctionController::class,'adminFunction'])->name('add.function');
Route::get('ad-mem-authentication',[AdminFunctionController::class,'adminMemAuthentication'])->name('add.MemAuthent');
Route::get('ad-gr-office-staff',[AdminFunctionController::class,'adminGrOfficeStaff'])->name('add.GrOfStaff');
Route::get('ad-ac-in-mem',[AdminFunctionController::class,'adminActIntMember'])->name('add.ActIntMem');



//  Mail
Route::get('ad-all-mail',[AdminMailController::class,'allmail'])->name('add.allmail');

Route::get('ad-se-vie-wb',[AdminMailController::class,'mailwb'])->name('add.mailWb');
Route::get('send-mail-wb/{id}', [AdminMailController::class,'mailSendWb'])->name('home.mailsendWb');
Route::get('pdf-wb/{id}', [AdminMailController::class, 'previewPrintWb'])->name('pdf.previewWb');
Route::get('pdf-gen-mail-wb', [AdminMailController::class, 'generateWbPDF'])->name('pdf.generatewb');
Route::get('excel-wb', [AdminMailController::class, 'wbExcel'])->name('excel.wb');

Route::get('ad-se-vie-br',[AdminMailController::class,'mailBihar'])->name('add.mail');
Route::get('send-mail/{id}', [AdminMailController::class,'mailSend'])->name('home.mailsend');
Route::get('pdf-br/{id}', [AdminMailController::class, 'previewPrintBr'])->name('pdf.previewBr');
Route::get('pdf-gen-mail-br', [AdminMailController::class, 'generateBrPDF'])->name('pdf.generatebr');
Route::get('excel-br', [AdminMailController::class, 'brExcel'])->name('excel.br');

Route::get('ad-se-vie-jh',[AdminMailController::class,'mailJh'])->name('add.mailJh');
Route::get('send-mail-jh/{id}', [AdminMailController::class,'mailSendJh'])->name('home.mailsendJh');
Route::get('pdf/{id}', [AdminMailController::class, 'previewPrintJk'])->name('pdf.preview');
Route::get('pdf-generate', [AdminMailController::class, 'generateJkPDF'])->name('pdf.generate');
Route::get('excel-jk', [AdminMailController::class, 'jkExcel'])->name('excel.jk');





