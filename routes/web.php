<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController; // ← public (statique)
use App\Http\Controllers\CvController;
use App\Http\Controllers\ConsentController;
use App\Http\Controllers\DashboardController;

// Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactAdminController;

// 🔓 Public  Footer
Route::redirect('/', '/accueil');
Route::get('/confidentialite', function () {
    return view('pages.confidentialite');
})->name('confidentialite');

Route::get('/plan-du-site', function () {
    return view('pages.plan-du-site');
})->name('plan-du-site');

Route::get('/cgu', function () {
    return view('pages.cgu');
})->name('cgu');


Route::get('/accueil', [HomeController::class, 'accueil'])->name('accueil');
Route::get('/a-propos', [HomeController::class, 'aPropos'])->name('a-propos');

// ✅ UNE SEULE route publique /projets avec UN SEUL nom
Route::get('/projets', [ProjectController::class, 'index'])->name('projets.index');

// Contact (UNE seule paire de routes)
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


// CV
Route::get('/cv', [CvController::class, 'show'])->name('cv'); // public
Route::get('/cv/preview', [CvController::class, 'preview'])->name('cv.preview');
Route::get('/cv/telecharger', [CvController::class, 'download'])
    ->middleware('auth.message')->name('cv.download');

// Cookie consent
Route::post('/cookie-consent', [ConsentController::class, 'store'])
    ->name('cookie-consent.store');

// 👤 UTILISATEUR CONNECTÉ
Route::middleware(['auth'])->group(function () {
    // une seule définition de /dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');   // lecture seule
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // édition
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// 🧑‍💼 ADMIN (Option B : page admin basée sur la liste statique)
Route::middleware(['auth','isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Page admin qui REUTILISE la liste statique
    Route::get('/projets', [AdminProjectController::class, 'index'])->name('projets.index');

    Route::resource('/users', UserController::class);

    // Messages de contact
    Route::get('/contacts', [ContactAdminController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{message}', [ContactAdminController::class, 'show'])->name('contacts.show');
    Route::put('/contacts/{message}/mark', [ContactAdminController::class, 'mark'])->name('contacts.mark');
    Route::delete('/contacts/{message}', [ContactAdminController::class, 'destroy'])->name('contacts.destroy');
});

// 🔐 Auth (Breeze)
require __DIR__.'/auth.php';
