<?php

use Illuminate\Support\Facades\Route;

// Contrôleurs publics
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;   // projets côté public (portfolio)
use App\Http\Controllers\CvController;
use App\Http\Controllers\ConsentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserMessageController;
use App\Http\Controllers\VoyageController;

// Contrôleurs admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactAdminController;

/*
|--------------------------------------------------------------------------
| Routes PUBLIQUES
|--------------------------------------------------------------------------
*/
Route::get('/accueil', [HomeController::class, 'accueil'])->name('accueil');
Route::get('/a-propos', [HomeController::class, 'aPropos'])->name('a-propos');
Route::get('/voyages', [VoyageController::class, 'index'])->name('voyages.index');

// 🔓 Public Footer
Route::redirect('/', '/accueil');
Route::get('/confidentialite', fn () => view('pages.confidentialite'))->name('confidentialite');
Route::get('/plan-du-site', fn () => view('pages.plan-du-site'))->name('plan-du-site');
Route::get('/cgu', fn () => view('pages.cgu'))->name('cgu');

// Projets côté public
Route::get('/projets', [ProjectController::class, 'index'])->name('projets.index');

// Formulaire de contact public
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// --- CV PUBLIC ---
Route::get('/cv-public', [CvController::class, 'show'])->name('cv.public');     // page publique
Route::get('/cv/preview', [CvController::class, 'preview'])->name('cv.preview'); // aperçu PDF public

// Bandeau RGPD (affichage et soumission)
Route::post('/cookie-consent', [ConsentController::class, 'store'])->name('cookie-consent.store');
Route::get('/cookies', fn () => view('pages.cookies'))->name('cookies.manage');

/*
|--------------------------------------------------------------------------
| Routes UTILISATEUR CONNECTÉ
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Messages utilisateur
    |--------------------------------------------------------------------------
    */
    Route::prefix('messages')->group(function () {
        Route::get('/envoyes', [UserMessageController::class, 'sent'])->name('messages.envoyes');
        Route::get('/recus', [UserMessageController::class, 'received'])->name('messages.recus');
        Route::get('/supprimes', [UserMessageController::class, 'deleted'])->name('messages.supprimes');

        Route::get('/{id}', [UserMessageController::class, 'show'])->name('messages.show');
        Route::delete('/{id}', [UserMessageController::class, 'destroy'])->name('messages.destroy');
        Route::patch('/{id}/restore', [UserMessageController::class, 'restore'])->name('messages.restore');
        Route::delete('/{id}/force', [UserMessageController::class, 'forceDelete'])->name('messages.forceDelete');
    });

    // --- CV UTILISATEUR CONNECTÉ ---
    Route::get('/cv', [CvController::class, 'index'])->name('user.cv'); // suivi dans dashboard
    Route::get('/cv/telecharger', [CvController::class, 'download'])
        ->middleware('auth.message')
        ->name('cv.download');
});

/*
|--------------------------------------------------------------------------
| Routes ADMIN (Sylvie uniquement)
|--------------------------------------------------------------------------
|
| ⚠️ Ces routes nécessitent un middleware `is_admin`
| (il vérifie si user->role == 'admin').
|
*/
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Gestion messages reçus
        Route::get('/contacts', [ContactAdminController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{message}', [ContactAdminController::class, 'show'])->name('contacts.show');
        Route::post('/contacts/{message}/reply', [ContactAdminController::class, 'reply'])->name('contacts.reply');
        Route::delete('/contacts/{message}', [ContactAdminController::class, 'destroy'])->name('contacts.destroy');

        // Gestion utilisateurs
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        // Gestion projets (CRUD admin)
        Route::get('/projets', [AdminProjectController::class, 'index'])->name('projets.index');
        Route::get('/projets/create', [AdminProjectController::class, 'create'])->name('projets.create');
        Route::post('/projets', [AdminProjectController::class, 'store'])->name('projets.store');
        Route::get('/projets/{id}', [AdminProjectController::class, 'show'])->name('projets.show');
        Route::get('/projets/{id}/edit', [AdminProjectController::class, 'edit'])->name('projets.edit');
        Route::put('/projets/{id}', [AdminProjectController::class, 'update'])->name('projets.update');
        Route::delete('/projets/{id}', [AdminProjectController::class, 'destroy'])->name('projets.destroy');

        // Statistiques admin
        Route::get('/stats', [AdminController::class, 'stats'])->name('stats');
    });

require __DIR__.'/auth.php';
