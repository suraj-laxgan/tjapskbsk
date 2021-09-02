<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminStateController;
use App\Http\Controllers\Admin\AdminMemberController;
use App\Http\Controllers\Admin\AdminMasterEntryController;
use App\Http\Controllers\Admin\AdminFunctionController;
use App\Http\Controllers\Admin\verifyRegisterController;



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

// Route::get('admin/dashboard', function () {
//     return view('admin.adminHome');
// })->middleware(['auth:admin'])->name('admin.dashboard');

// Route::get('admin/dashboard', [AdminFunctionController::class,'adminDashboard'])->name('admin.dashboard');

Route::get('admin/dashboard', [AdminLoginController::class,'adminDashboard'])->middleware(['auth:admin'])->name('admin.dashboard');


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
Route::get('ad-cuser-state',[AdminStateController::class,'adminCreateStateUser'])->name('add.CreuserState');
Route::post('ad-cuser-state',[AdminStateController::class,'addCreateStateUser'])->name('add.Createuser');


// ########### Admin State End ##########

// ########### Admin Membership Start ##########

Route::get('/ad-member-main',[AdminMemberController::class,'adminMemberMain'])->name('ad.adminmembermain');

// Membership Registration Form

Route::get('/ad-member',[AdminMemberController::class,'adminMember'])->name('ad.adminmember');
Route::post('/ad-member-regis',[AdminMemberController::class,'adminMemberRegis'])->name('ad.adminmemberregis');
Route::post('/find_designation_name',[AdminMemberController::class ,'findDesignationName'])->name('admin.designationname');
// Route::post('/find_dis_name',[AdminMemberController::class ,'findDisName']);
Route::post('/find-state-name',[AdminMemberController::class ,'findStateName']);
Route::post('/ajax-find-district-name',[AdminMemberController::class ,'dkName']);
Route::post('/ajax-find-block-name',[AdminMemberController::class ,'blockName']);


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
Route::get('ad-ma-print/{id}',[AdminMemberController::class,'maPrint'])->name('ma.print');
Route::get('ad-ma-reprint/{id}',[AdminMemberController::class,'maRePrint'])->name('ma.rreprint');
Route::get('ad-printletter/{id}',[AdminMemberController::class,'printLetter'])->name('ma.printlt');
Route::get('ad-ma-adress/{id}',[AdminMemberController::class,'printAddress'])->name('ma.printadd');
Route::get('con-let-excel', [AdminMemberController::class, 'conLetExcel'])->name('conLetExcel');




// Joining Letter
Route::get('ad-joining-letter',[AdminMemberController::class,'adminJoinLetter'])->name('ad.adminJoinLt');
Route::get('ad-join-print/{id}',[AdminMemberController::class,'joinPrint'])->name('join.print');
Route::get('ad-join-print-com/{id}',[AdminMemberController::class,'joinPrintCom'])->name('join.printcom');

// Reprint Joining Letter
Route::get('ad-repjoining-letter',[AdminMemberController::class,'adminRePrintJoiningLetter'])->name('ad.adminRepriJoinLt');
Route::get('join-let-excel', [AdminMemberController::class, 'joinLetExcel'])->name('joinLetExcel');

Route::get('ad-join-reprint-com/{id}',[AdminMemberController::class,'joinRePrintCom'])->name('join.reprintcom');

// Declaration Letter
Route::get('ad-decal-letter',[AdminMemberController::class,'declarationLetter'])->name('ad.adminDeclaLt');
Route::get('ad-decal-ltr/{id}',[AdminMemberController::class,'declPrint'])->name('decl.print');
Route::get('ad-decal-ltr-com/{id}',[AdminMemberController::class,'declPrintCom'])->name('dec.reprintCom');

// Reprint Declaration Letter
Route::get('ad-reprindecal-letter',[AdminMemberController::class,'adminRepnDeclarationLetter'])->name('ad.adminRepnDeclaLt');
Route::get('ad-reprindecal-com/{id}',[AdminMemberController::class,'decRePrintCom'])->name('dec.reprintcom');

// Appointment Letter
Route::get('ad-appointment-letter',[AdminMemberController::class,'adminAppointmentLetter'])->name('ad.adminAppointlaLt');
Route::get('ad-app-ltr/{id}',[AdminMemberController::class,'appltrPrint'])->name('app.print');
Route::get('ad-app-ltr-com/{id}',[AdminMemberController::class,'appPrintCom'])->name('app.printCom');

// Reprint Appointment Letter
Route::get('ad-rep-appointment-letter',[AdminMemberController::class,'adminRepnAppointmentLetter'])->name('ad.adminRepAppointlaLt');
Route::get('ad-reappointment-com/{id}',[AdminMemberController::class,'appRePrintCom'])->name('app.reprintcom');


// ########### Admin Membership End ##########

//  *******Admin Master Entry Start *******
// Designation
Route::get('ad-mas',[AdminMasterEntryController::class,'adminMas'])->name('ad.mas');
Route::get('ad-designation',[AdminMasterEntryController::class,'adminDesignation'])->name('ad.designation');
Route::post('ad-desig',[AdminMasterEntryController::class,'adminDesig'])->name('ad.desig');
Route::get('ad-desig-edit/{id}',[AdminMasterEntryController::class,'desigEdit'])->name('desig.edit');
Route::post('/ad-desig-edit-upload',[AdminMasterEntryController::class,'desigEditUp'])->name('admin.desigup');
Route::get('delete-desig/{id}',[AdminMasterEntryController::class,'desigDelete'])->name('desig.del');

//  Add organiser
Route::get('ad-organiser',[AdminMasterEntryController::class,'adminOrganiser'])->name('add.Organiser');
Route::post('/ad-organiser-save',[AdminMasterEntryController::class,'organiserAdd'])->name('save.Organiser');
Route::get('delete-organiser/{id}',[AdminMasterEntryController::class,'organiserDelete'])->name('organiser.del');


// Add District
Route::get('ad-districts',[AdminMasterEntryController::class,'adminAddDistrict'])->name('add.District');
Route::post('/ad-districts-save',[AdminMasterEntryController::class,'districtsAdd'])->name('save.districts');
Route::get('ad-district-edit/{id}',[AdminMasterEntryController::class,'districtEdit'])->name('dis.edit');
Route::post('/ad-district-up',[AdminMasterEntryController::class,'districtsUp'])->name('up.dist');
Route::get('/delete-district/{id}',[AdminMasterEntryController::class,'districtDelete'])->name('district.del');

// Add Block
Route::get('ad-block',[AdminMasterEntryController::class,'adminAddBlock'])->name('add.Block');
Route::post('/ad-block-save',[AdminMasterEntryController::class,'blockAdd'])->name('block.add');
Route::get('ad-block-edit/{id}',[AdminMasterEntryController::class,'blockEdit'])->name('block.edit');
Route::post('/ad-block-up',[AdminMasterEntryController::class,'blockUp'])->name('block.up');
Route::get('/delete-block/{id}',[AdminMasterEntryController::class,'blockDelete'])->name('block.del');
Route::post('/find-district-name',[AdminMasterEntryController::class ,'findDisName']);
Route::post('/search-district-name',[AdminMasterEntryController::class ,'searDisName']);


// Add Staff
Route::get('ad-staff',[AdminMasterEntryController::class,'adminAddStaff'])->name('add.Staff');
Route::get('ad-staff-edit/{id}',[AdminMasterEntryController::class,'staffEdit'])->name('staff.edit');
Route::get('ad-staff-view/{id}',[AdminMasterEntryController::class,'staffView'])->name('staff.view');
Route::post('/ad-staff-up',[AdminMasterEntryController::class,'staffUp'])->name('staff.up');
Route::post('/ad-staff-save',[AdminMasterEntryController::class,'staffSave'])->name('staff.save');

// Create User
Route::get('ad-cuser',[AdminMasterEntryController::class,'adminCreateUser'])->name('add.Creuser');
Route::post('ad-cuser',[AdminMasterEntryController::class,'addCreateUser'])->name('add.Createuse');



// Function
Route::get('ad-function',[AdminFunctionController::class,'adminFunction'])->name('add.function');
Route::get('ad-mem-authentication',[AdminFunctionController::class,'adminMemAuthentication'])->name('add.MemAuthent');

// Grant Revoke Office Staff
// Route::get('ad-gr-office-staff',[AdminFunctionController::class,'adminGrOfficeStaff'])->name('add.GrOfStaff');

// test for admin new project
Route::get('ad-gr-office-staff',[AdminFunctionController::class,'adminGrOfficeStaffMin'])->name('add.GrOfStaff');

Route::post('ad-gan-rvoff-staff',[AdminFunctionController::class,'revokeStaffUp'])->name('add.re.staff');
Route::post('update-permission',[AdminFunctionController::class,'updatePermission']);

// Active/ Inactive Member
Route::get('ad-ac-in-mem',[AdminFunctionController::class,'adminActIntMember'])->name('add.ActIntMem');
Route::get('active-inactive-excel', [AdminFunctionController::class, 'activeInactiveExcel'])->name('activeInactiveExcel');
Route::get('active_inactive-pdf-gen', [AdminFunctionController::class, 'activeInactivePDF'])->name('pdf.activeInactive');


Route::post('ad-revoke-mem-up',[AdminFunctionController::class,'revokeMemberUp'])->name('add.revoke');



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

// Verified Register
Route::get('verify-all-regis',[verifyRegisterController::class,'allRegis'])->name('add.allRegis');
Route::get('verify-register',[verifyRegisterController::class,'verifyRegister'])->name('add.veRegis');
Route::get('/verify-mem-edit/{id}',[verifyRegisterController::class,'verifyMemEdit'])->name('ad.vrmem-edit');
Route::post('/verify-mem-edit-upload',[verifyRegisterController::class,'verifyMemUpload'])->name('ad.verifyupload');
Route::get('verify-search-exis-mem',[verifyRegisterController::class,'exisMember'])->name('add.exMem');
Route::get('ad-verify-regis-member',[verifyRegisterController::class,'addVerifyMember'])->name('ad.verifymember');
Route::post('/ad-verify-member-regis',[verifyRegisterController::class,'addVerifyMemberRegis'])->name('ad.addmemberregis');
Route::post('/verify-designation-name',[verifyRegisterController::class ,'findDesignationName'])->name('admin.designationname');
Route::get('verified-pdf', [verifyRegisterController::class, 'verifiedPDF'])->name('pdf.verified');





