<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController as PublicProjectController;   // ✅ public
use App\Http\Controllers\Admin\ProjectController as AdminProjectController; // ✅ admin
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\CvController;



// 🔓 ROUTES PUBLIQUES (accessibles à tous)
Route::redirect('/', '/accueil'); // Redirige / vers /accueil

Route::get('/accueil', [HomeController::class, 'accueil'])->name('accueil');
Route::get('/a-propos', [HomeController::class, 'aPropos'])->name('a-propos');
Route::get('/projets', [PublicProjectController::class, 'index'])->name('projets.index'); // ✅



Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

//ROUTES CV
Route::get('/cv', [CvController::class, 'show'])->name('cv'); // Page publique
Route::get('/cv/preview', [CvController::class, 'preview'])->name('cv.preview'); // Aperçu public
//ROUTE DOWNLOAD CV
Route::get('/cv/telecharger', [CvController::class, 'download'])
    ->middleware('auth.message')->name('cv.download'); // Téléchargement protégé





// 👤 UTILISATEUR CONNECTÉ (role = 0)
Route::middleware(['auth'])->group(function () {
    // Accès au dashboard utilisateur
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    // Gestion du profil utilisateur (généré par Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


// 🧑‍💼 ADMIN (role = 1) avec CRUD
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    // Accès au dashboard admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // CRUD Admin
    Route::resource('/projets', ProjectController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/messages', MessageController::class)->only(['index', 'show', 'destroy']);
    

    Route::get('/contacts', [ContactAdminController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{message}', [ContactAdminController::class, 'show'])->name('contacts.show');
    Route::put('/contacts/{message}/mark', [ContactAdminController::class, 'mark'])->name('contacts.mark');
    Route::delete('/contacts/{message}', [ContactAdminController::class, 'destroy'])->name('contacts.destroy');


});

// CONTACT MESSAGE
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


// 🔐 ROUTES AUTH (gérées par Breeze : login, register, logout, etc.)
require __DIR__.'/auth.php';
