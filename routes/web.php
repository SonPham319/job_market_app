<?php

use App\Http\Controllers\MatchingController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JoblistingController;
use App\Http\Controllers\PostJobController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SuggestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CVController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::get('/', [JoblistingController::class, 'index'])->name('homepage');

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/help', 'help')->name('help');
Route::view('/blog', 'blog')->name('blog');

/*
|--------------------------------------------------------------------------
| Job Listing
|--------------------------------------------------------------------------
*/

Route::get('/job/show/{listing:slug}', [JoblistingController::class, 'show'])->name('job.show');
Route::get('/job/search', [JoblistingController::class, 'search'])->name('job.search');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/register', [UserController::class, 'register'])->name('register');

Route::get('/register/employee', [UserController::class, 'createEmployee'])->name('create.employee');
Route::post('/register/employee', [UserController::class, 'storeEmployee'])->name('store.employee');

Route::get('/register/employer', [UserController::class, 'createEmployer'])->name('create.employer');
Route::post('/register/employer', [UserController::class, 'storeEmployer'])->name('store.employer');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'postLogin'])
    ->middleware('throttle:5,1')
    ->name('login.post');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Email Verification
|--------------------------------------------------------------------------
*/

Route::get('/verify', [DashboardController::class, 'verify'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('user/profile');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/resend/verification/email', [DashboardController::class, 'resend'])->name('resend.email');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::prefix('user')->middleware(['auth'])->group(function () {

    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('profile', [UserController::class, 'updateProfile'])->name('user.profile.update');

    Route::post('profile/password', [UserController::class, 'updatePassword'])->name('user.profile.password');

    Route::get('cv', [UserController::class, 'cv'])->name('user.cv');
    Route::post('cv', [UserController::class, 'updateCv'])->name('user.cv.update');

    Route::get('cv/view', [UserController::class, 'viewCv'])->name('user.cv.view');
    Route::get('cv/download', [UserController::class, 'downloadCv'])->name('user.cv.download');
    Route::delete('cv/delete', [UserController::class, 'deleteCv'])->name('user.cv.delete');

    Route::get('cv/create', [UserController::class, 'createCv'])->name('create.cv');
    Route::get('cv/preview', [UserController::class, 'previewPDF'])->name('preview.pdf');
});

/*
|--------------------------------------------------------------------------
| Job Management (Employer)
|--------------------------------------------------------------------------
*/

Route::prefix('job')->middleware(['auth'])->group(function () {

    Route::get('/', [PostJobController::class, 'index'])->name('job.index');
    Route::get('/create', [PostJobController::class, 'create'])->name('job.create');
    Route::post('/store', [PostJobController::class, 'store'])->name('job.store');
    Route::get('/{listing}/edit', [PostJobController::class, 'edit'])->name('job.edit');
    Route::put('/{listing}/update', [PostJobController::class, 'update'])->name('job.update');
    Route::delete('/{listing}', [PostJobController::class, 'destroy'])->name('job.destroy');
});

/*
|--------------------------------------------------------------------------
| Job Application
|--------------------------------------------------------------------------
*/

Route::post('/application/{listingId}/submit', [ApplicantController::class, 'apply'])
    ->middleware('auth')
    ->name('application.submit');

/*
|--------------------------------------------------------------------------
| Applicants (Employer)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/applicants', [ApplicantController::class, 'index'])->name('applicants.index');
    Route::get('/applicants/{listing:slug}', [ApplicantController::class, 'view'])->name('applicants.view');

    Route::post('/shortlist/{listingId}/{userId}', [ApplicantController::class, 'shortlist'])->name('applicant.shortlist');

    Route::get('/applicant/{userId}/cv/view', [ApplicantController::class, 'viewApplicantCv'])->name('applicant.cv.view');
    Route::get('/applicant/{userId}/cv/download', [ApplicantController::class, 'downloadApplicantCv'])->name('applicant.cv.download');
});

/*
|--------------------------------------------------------------------------
| Subscription / Payment
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::post('/pay/monthly', [SubscriptionController::class, 'pay'])->name('pay.monthly');
    Route::post('/pay/yearly', [SubscriptionController::class, 'pay'])->name('pay.yearly');
    Route::get('/payment/success', [SubscriptionController::class, 'paymentSuccess'])->name('payment.success');
});

/*
|--------------------------------------------------------------------------
| AI Job Suggestion
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/suggest', [SuggestController::class, 'index'])->name('suggest.index');
    Route::post('/suggest', [SuggestController::class, 'suggest'])->name('suggest');
});

/*
|--------------------------------------------------------------------------
| Mail Notification
|--------------------------------------------------------------------------
*/

Route::post('/user/mail', [DashboardController::class, 'mail'])
    ->middleware('auth')
    ->name('user.mail');

/*
|--------------------------------------------------------------------------
| Extra Route
|--------------------------------------------------------------------------
*/

Route::get('/createjob', function () {
    return view('layouts.dashboard.createjob');
})->name('createjob');

/*
|--------------------------------------------------------------------------
| Matching Algorithm
|--------------------------------------------------------------------------
*/

Route::get('/matching/{id}', [MatchingController::class, 'showMatchedCandidates'])
    ->name('matching.candidates');

/*
|--------------------------------------------------------------------------
| CV Upload
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/upload-cv', [CVController::class, 'uploadForm'])->name('cv.upload.form');
    Route::post('/upload-cv', [CVController::class, 'upload'])->name('cv.upload');
});

Route::get('/suggest', [SuggestController::class, 'index'])->name('suggest.index');
Route::post('/suggest', [SuggestController::class, 'suggest'])->name('suggest');