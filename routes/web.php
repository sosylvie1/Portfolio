<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

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
// use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\ContactMessageController;

/*
|--------------------------------------------------------------------------
| Routes mot de passe oublié
|--------------------------------------------------------------------------
*/

// Mot de passe oublié : affichage du formulaire
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

// Envoi du mail avec le lien
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

// Réinitialisation : affichage du formulaire avec token
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

// Réinitialisation : soumission du nouveau mot de passe
Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');

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
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
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

    



Route::middleware('auth')->prefix('messages')->name('messages.')->group(function () {
    // ✉️ Nouveau message
    Route::get('/nouveau', [UserMessageController::class, 'create'])->name('create');
    Route::post('/nouveau', [UserMessageController::class, 'store'])->name('store');
    Route::get('/', [UserMessageController::class, 'index'])->name('index'); 
    // 📤 Messages envoyés
    Route::get('/envoyes', [UserMessageController::class, 'sent'])->name('envoyes');

    // 📥 Messages reçus
    Route::get('/recus', [UserMessageController::class, 'received'])->name('recus');

    // 🗑️ Messages supprimés
    Route::get('/supprimes', [UserMessageController::class, 'deleted'])->name('supprimes');

    // 👁️ Voir un message
    Route::get('/{id}', [UserMessageController::class, 'show'])->name('show');

    // ❌ Supprimer (soft delete)
    Route::delete('/{id}', [UserMessageController::class, 'destroy'])->name('destroy');

    // 🔄 Restaurer
    Route::patch('/{id}/restore', [UserMessageController::class, 'restore'])->name('restore');

    // ❌ Supprimer définitivement
    Route::delete('/{id}/force', [UserMessageController::class, 'forceDelete'])->name('forceDelete');

    // 📌 Marquer comme lu
    Route::patch('/{id}/mark', [UserMessageController::class, 'mark'])->name('mark');

    // 📧 Répondre
    Route::post('/{id}/reply', [UserMessageController::class, 'reply'])->name('reply');
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

    
    // Route::get('/contacts', [ContactAdminController::class, 'index'])->name('contacts.index');
    // Route::get('/contacts/{message}', [ContactAdminController::class, 'show'])->name('contacts.show');
    // Route::delete('/contacts/{message}', [ContactAdminController::class, 'destroy'])->name('contacts.destroy');

    // // ✅ Route pour marquer comme lu / non lu
    // Route::patch('/contacts/{message}/mark', [ContactAdminController::class, 'mark'])->name('contacts.mark');

    // // ✅ Route pour répondre
    // Route::post('/contacts/{message}/reply', [ContactAdminController::class, 'reply'])->name('contacts.reply');
    
    //     // Gestion utilisateurs
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        
        // gestion messages
    
        Route::get('/contacts', [ContactMessageController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{message}', [ContactMessageController::class, 'show'])->name('contacts.show');
        Route::delete('/contacts/{message}', [ContactMessageController::class, 'destroy'])->name('contacts.destroy');
       Route::patch('/contacts/{message}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('contacts.markAsRead');
Route::patch('/contacts/{message}/mark-as-unread', [ContactMessageController::class, 'markAsUnread'])->name('contacts.markAsUnread');

        Route::post('/contacts/{message}/reply', [ContactMessageController::class, 'reply'])->name('contacts.reply');
    

        // Gestion projets (CRUD admin)
Route::get('/projets', [AdminProjectController::class, 'index'])->name('projets.index');
Route::get('/projets/create', [AdminProjectController::class, 'create'])->name('projets.create');
Route::post('/projets', [AdminProjectController::class, 'store'])->name('projets.store');
Route::get('/projets/{project}', [AdminProjectController::class, 'show'])->name('projets.show');
Route::get('/projets/{project}/edit', [AdminProjectController::class, 'edit'])->name('projets.edit');
Route::put('/projets/{project}', [AdminProjectController::class, 'update'])->name('projets.update');
Route::delete('/projets/{project}', [AdminProjectController::class, 'destroy'])->name('projets.destroy');
        
// Statistiques admin
        Route::get('/stats', [AdminController::class, 'stats'])->name('stats');
    });

require __DIR__.'/auth.php';
