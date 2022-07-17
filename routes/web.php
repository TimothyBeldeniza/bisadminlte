<?php


use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
// use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\BlottersController;
use App\Http\Controllers\BarangayOfficialsController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\DocumentTypesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UsersImportController;

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
    return view('homepage.index');
    // return view('auth.login');
});

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('home/fetch_data', [HomeController::class, 'fetch_data']);

//PDFs
//Documents
Route::get('documents/view-document-pdf/{compId}/{transId}',[DocumentsController::class, 'pdfViewDocument']);
Route::get('documents/generate-document-pdf/{compId}/{transId}',[DocumentsController::class, 'pdfSaveDocument']);

//Complaints
Route::get('complaints/show/view-complaint-pdf/{compId}/{transId}',[ComplaintsController::class, 'pdfViewComplaint']);
Route::get('complaints/show/generate-complaint-pdf/{compId}/{transId}',[ComplaintsController::class, 'pdfSaveComplaint']);
Route::get('complaints/show/view-settle-pdf/{compId}/{transId}',[ComplaintsController::class, 'pdfViewSettle']);
Route::get('complaints/show/generate-settle-pdf/{compId}/{transId}',[ComplaintsController::class, 'pdfSaveSettle']);
Route::get('complaints/show/view-escalate-pdf/{compId}/{transId}',[ComplaintsController::class, 'pdfViewEscalate']);
Route::get('complaints/show/generate-escalate-pdf/{compId}/{transId}',[ComplaintsController::class, 'pdfSaveEscalate']);
Route::get('autocomplete', [ComplaintsController::class, 'autocomplete'])->name('autocomplete');

//Non-Residential Complainant
Route::get('complaints/outsider',[ComplaintsController::class, 'outsider'])->name('complaints.outsider');
Route::get('complaints/outsider/show/{compId}',[ComplaintsController::class, 'showOutsider'])->name('complaints.showoutsider');
Route::get('complaints/outsider/show/view-o-complaint-pdf/{compId}/{transId}',[ComplaintsController::class, 'pdfViewOutsideComplaint']);
Route::get('complaints/outsider/show/save-o-complaint-pdf/{compId}/{transId}',[ComplaintsController::class, 'pdfSaveOutsideComplaint']);
Route::get('complaints/outsider/show/view-o-escalate-pdf/{compId}/{transId}',[ComplaintsController::class, 'pdfViewOutsideEscalate']);
Route::get('complaints/outsider/show/save-o-escalate-pdf/{compId}/{transId}',[ComplaintsController::class, 'pdfSaveOutsideEscalate']);
Route::get('complaints/outsider/show/view-o-settle-pdf/{compId}/{transId}',[ComplaintsController::class, 'pdfViewOutsideSettle']);
Route::get('complaints/outsider/show/save-o-settle-pdf/{compId}/{transId}',[ComplaintsController::class, 'pdfSaveOutsideSettle']);

//Processing of Complaint
Route::get('complaints/show/settle/{compId}/{transId}', [ComplaintsController::class,'settle']);
Route::get('complaints/show/escalate/{compId}/{transId}', [ComplaintsController::class,'escalate']);
Route::get('complaints/show/dismiss/{compId}/{transId}', [ComplaintsController::class,'dismiss']);

//Processing of Document
Route::get('documents/process/{transId}/{userId}', [DocumentsController::class,'process']);
Route::get('documents/disapprove/{transId}', [DocumentsController::class,'disapproved']);
Route::get('documents/paid/{transId}', [DocumentsController::class,'paid']);
Route::get('documents/release/{transId}', [DocumentsController::class,'release']);

//Walk-In Request Document
Route::get('documents/create/walkin', [DocumentsController::class,'walkin'])->name('documents.walkin');

//Reason for Documents
Route::post('documents/process/{docId}/{transId}/{userId}', [DocumentsController::class,'reason']);
// Route::get('documents/disapprove/{transId}/{userId}', [DocumentsController::class,'disapproved']);
// Route::get('documents/paid/{transId}/{userId}', [DocumentsController::class,'paid']);

//Scan Documents
Route::get('documents/scan', [DocumentsController::class,'scan']);
Route::get('documents/checkDoc', [DocumentsController::class,'checkDoc']);

//Scan Request
Route::get('documents/scanReq', [DocumentsController::class,'scanReq']);
Route::get('documents/checkReq', [DocumentsController::class,'checkReq']);

//Cancelling of Document
Route::delete('documents/cancel/{transId}', [DocumentsController::class,'cancel']);

//Showing of a Complaint
Route::get('complaints/show/{transId}/{userId}', [ComplaintsController::class,'show']);

//Record Hearing
Route::post('complaints/show/hearing/{compId}/{transId}', [ComplaintsController::class,'recordHearing']);

//Processing of Blotters
Route::get('blotters/note/{transId}/{userId}', [BlottersController::class,'noted']);

//Restoring of Document Types 
Route::get('doctypes/restore/{id}', [DocumentTypesController::class,'restore']);

//Import Users
Route::get('/users/import', [UsersImportController::class,'show']);
Route::post('/users/import/store', [UsersImportController::class,'store']);

//Barangay backup
Route::get('/backup', [BarangayController::class, 'backup']);
Route::get('/backup/confirmBackup', [BarangayController::class, 'confirmBackup']);

Route::group(['middleware' => ['auth','verified']], function() {
    Route::resource('users', UserController::class);
    Route::resource('profiles', ProfileController::class);
    Route::resource('documents', DocumentsController::class);
    Route::resource('complaints', ComplaintsController::class);
    Route::resource('blotters', BlottersController::class);
    Route::resource('officials', BarangayOfficialsController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('services', ServicesController::class);
    Route::resource('barangay', BarangayController::class);
    Route::resource('doctypes', DocumentTypesController::class);
    Route::resource('appointments', AppointmentController::class);
    // Route::resource('dashboard', DashboardController::class);
});
