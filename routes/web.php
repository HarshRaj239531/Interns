<?php

use App\Http\Controllers\AdminPortalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StudentPortalController;
use Illuminate\Support\Facades\Route;

// Public Static & Dynamic Pages
Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/programs', [SiteController::class, 'programs'])->name('programs');
Route::get('/journey', [SiteController::class, 'journey'])->name('journey');
Route::get('/how-it-works', [SiteController::class, 'journey']);
Route::get('/certification', [SiteController::class, 'certification'])->name('certification');
Route::get('/documents', [SiteController::class, 'certification']);
Route::get('/subjects', [SiteController::class, 'subjects'])->name('subjects');
Route::get('/domains', [SiteController::class, 'subjects']);
Route::get('/faculty', [SiteController::class, 'subjects']);
Route::get('/mentors', [SiteController::class, 'mentors'])->name('mentors');
Route::get('/colleges', [SiteController::class, 'colleges'])->name('colleges');
Route::get('/stories', [SiteController::class, 'stories'])->name('stories');
Route::get('/faq', [SiteController::class, 'faq'])->name('faq');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');

// Public Verifier & Forms
Route::get('/verify/{code?}', [SiteController::class, 'verifyCertificate'])->name('verify');
Route::post('/inquiry/contact', [SiteController::class, 'storeContactInquiry'])->name('inquiry.contact');
Route::post('/inquiry/college', [SiteController::class, 'storeCollegeInquiry'])->name('inquiry.college');
Route::post('/apply', [SiteController::class, 'storeApplication'])->name('apply');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Student Portal (Protected for logged in students & users)
Route::middleware('auth')->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentPortalController::class, 'dashboard'])->name('dashboard');
    Route::post('/project', [StudentPortalController::class, 'updateProject'])->name('project.update');
    Route::get('/documents/offer-letter', [StudentPortalController::class, 'viewOfferLetter'])->name('offer-letter');
    Route::get('/documents/certificate', [StudentPortalController::class, 'viewCertificate'])->name('certificate');
    Route::get('/documents/marksheet', [StudentPortalController::class, 'viewMarksheet'])->name('marksheet');
});

// Admin Portal (Protected for Admin & Super Admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [AdminPortalController::class, 'dashboard'])->name('dashboard');
    Route::patch('/applications/{id}/status', [AdminPortalController::class, 'updateStatus'])->name('application.status');
    Route::post('/applications/{id}/issue-offer-letter', [AdminPortalController::class, 'issueOfferLetter'])->name('application.offer-letter');
    Route::post('/applications/{id}/issue-certificate', [AdminPortalController::class, 'issueCertificate'])->name('application.certificate');
    Route::post('/applications/{id}/issue-marksheet', [AdminPortalController::class, 'issueMarksheet'])->name('application.marksheet');
    Route::post('/applications/{id}/update-details', [AdminPortalController::class, 'updateDetails'])->name('application.update-details');
    Route::delete('/applications/{id}', [AdminPortalController::class, 'deleteApplication'])->name('application.delete');

    Route::get('/inquiries', [AdminPortalController::class, 'inquiries'])->name('inquiries');
    Route::patch('/inquiries/{id}/status', [AdminPortalController::class, 'updateInquiryStatus'])->name('inquiry.status');

    Route::get('/applications/{id}/offer-letter', [AdminPortalController::class, 'viewStudentOfferLetter'])->name('application.view-offer-letter');
    Route::get('/applications/{id}/certificate', [AdminPortalController::class, 'viewStudentCertificate'])->name('application.view-certificate');
    Route::get('/applications/{id}/marksheet', [AdminPortalController::class, 'viewStudentMarksheet'])->name('application.view-marksheet');
});

// Redirect /super-admin to Admin Dashboard
Route::get('/super-admin/{any?}', fn () => redirect()->route('admin.dashboard'))->where('any', '.*');
