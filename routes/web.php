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
    Route::get('/documents/consent-letter', [StudentPortalController::class, 'viewConsentLetter'])->name('consent-letter');
    Route::get('/documents/certificate', [StudentPortalController::class, 'viewCertificate'])->name('certificate');
    Route::get('/documents/lor', [StudentPortalController::class, 'viewLor'])->name('lor');
    Route::get('/documents/marksheet', [StudentPortalController::class, 'viewMarksheet'])->name('marksheet');
});

// Admin Portal (Protected for Admin & Super Admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [AdminPortalController::class, 'dashboard'])->name('dashboard');
    Route::patch('/applications/{id}/status', [AdminPortalController::class, 'updateStatus'])->name('application.status');
    Route::post('/applications/{id}/issue-offer-letter', [AdminPortalController::class, 'issueOfferLetter'])->name('application.offer-letter');
    Route::post('/applications/{id}/issue-consent-letter', [AdminPortalController::class, 'issueConsentLetter'])->name('application.consent-letter');
    Route::post('/applications/{id}/issue-certificate', [AdminPortalController::class, 'issueCertificate'])->name('application.certificate');
    Route::post('/applications/{id}/issue-lor', [AdminPortalController::class, 'issueLor'])->name('application.lor');
    Route::post('/applications/{id}/issue-marksheet', [AdminPortalController::class, 'issueMarksheet'])->name('application.marksheet');
    Route::post('/applications/{id}/update-details', [AdminPortalController::class, 'updateDetails'])->name('application.update-details');
    Route::post('/applications/{id}/update-full', [AdminPortalController::class, 'updateFullApplicant'])->name('application.update-full');
    Route::post('/applications/store', [AdminPortalController::class, 'storeApplicant'])->name('application.store');
    Route::get('/applications/export', [AdminPortalController::class, 'exportApplications'])->name('applications.export');
    Route::post('/applications/{id}/revoke-certificate', [AdminPortalController::class, 'revokeCertificate'])->name('application.revoke-certificate');
    Route::delete('/applications/{id}', [AdminPortalController::class, 'deleteApplication'])->name('application.delete');

    // Inquiries Desk
    Route::get('/inquiries', [AdminPortalController::class, 'inquiries'])->name('inquiries');
    Route::patch('/inquiries/{id}/status', [AdminPortalController::class, 'updateInquiryStatus'])->name('inquiry.status');

    // Document Direct Print/Views for Admin
    Route::get('/applications/{id}/offer-letter', [AdminPortalController::class, 'viewStudentOfferLetter'])->name('application.view-offer-letter');
    Route::get('/applications/{id}/consent-letter', [AdminPortalController::class, 'viewStudentConsentLetter'])->name('application.view-consent-letter');
    Route::get('/applications/{id}/certificate', [AdminPortalController::class, 'viewStudentCertificate'])->name('application.view-certificate');
    Route::get('/applications/{id}/lor', [AdminPortalController::class, 'viewStudentLor'])->name('application.view-lor');
    Route::get('/applications/{id}/marksheet', [AdminPortalController::class, 'viewStudentMarksheet'])->name('application.view-marksheet');

    // Manual Certificate Generation
    Route::get('/certificate-generator', [AdminPortalController::class, 'certificateGenerator'])->name('certificate-generator');
    Route::post('/certificate-generator', [AdminPortalController::class, 'generateManualCertificate'])->name('certificate-generator.generate');

    // Unified Academic Setup Hub
    Route::get('/academic-setup', [AdminPortalController::class, 'academicSetup'])->name('academic-setup');

    // Manage Degrees (Dedicated Page)
    Route::get('/degrees', [AdminPortalController::class, 'degrees'])->name('degrees');
    Route::post('/degrees', [AdminPortalController::class, 'storeDegree'])->name('degrees.store');
    Route::patch('/degrees/{id}', [AdminPortalController::class, 'updateDegree'])->name('degrees.update');
    Route::post('/degrees/{id}/toggle', [AdminPortalController::class, 'toggleDegreeStatus'])->name('degrees.toggle');
    Route::delete('/degrees/{id}', [AdminPortalController::class, 'deleteDegree'])->name('degrees.delete');

    // Manage Schools / Colleges (Dedicated Page)
    Route::get('/schools', [AdminPortalController::class, 'schools'])->name('schools');
    Route::post('/schools', [AdminPortalController::class, 'storeSchool'])->name('schools.store');
    Route::patch('/schools/{id}', [AdminPortalController::class, 'updateSchool'])->name('schools.update');
    Route::post('/schools/{id}/toggle', [AdminPortalController::class, 'toggleSchoolStatus'])->name('schools.toggle');
    Route::delete('/schools/{id}', [AdminPortalController::class, 'deleteSchool'])->name('schools.delete');

    // Manage Internship Streams / Domains (Dedicated Page)
    Route::get('/streams', [AdminPortalController::class, 'streams'])->name('streams');
    Route::get('/domains', [AdminPortalController::class, 'streams'])->name('domains');
    Route::post('/streams', [AdminPortalController::class, 'storeStream'])->name('streams.store');
    Route::patch('/streams/{id}', [AdminPortalController::class, 'updateStream'])->name('streams.update');
    Route::post('/streams/{id}/toggle', [AdminPortalController::class, 'toggleStreamStatus'])->name('streams.toggle');
    Route::delete('/streams/{id}', [AdminPortalController::class, 'deleteStream'])->name('streams.delete');

    // Track Application
    Route::get('/track/{appNumber?}', [AdminPortalController::class, 'trackApplication'])->name('track');

    // Offer Letter Settings & Template Customizer
    Route::get('/offer-letter-settings', [AdminPortalController::class, 'offerLetterSettings'])->name('offer-letter.settings');
    Route::post('/offer-letter-settings', [AdminPortalController::class, 'updateOfferLetterSettings'])->name('offer-letter.settings.update');
    Route::post('/offer-letter-settings/remove-image', [AdminPortalController::class, 'removeOfferLetterImage'])->name('offer-letter.settings.remove-image');
    Route::post('/offer-letter-settings/reset', [AdminPortalController::class, 'resetOfferLetterSettings'])->name('offer-letter.settings.reset');

    // Consent Letter Settings & Template Customizer
    Route::get('/consent-letter-settings', [AdminPortalController::class, 'consentLetterSettings'])->name('consent-letter.settings');
    Route::post('/consent-letter-settings', [AdminPortalController::class, 'updateConsentLetterSettings'])->name('consent-letter.settings.update');
    Route::post('/consent-letter-settings/remove-image', [AdminPortalController::class, 'removeConsentLetterImage'])->name('consent-letter.settings.remove-image');
    Route::post('/consent-letter-settings/reset', [AdminPortalController::class, 'resetConsentLetterSettings'])->name('consent-letter.settings.reset');
});

// Redirect /super-admin to Admin Dashboard
Route::get('/super-admin/{any?}', fn () => redirect()->route('admin.dashboard'))->where('any', '.*');
