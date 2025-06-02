<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\StageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\AdminController;



route::get('/',[HomeController::class, 'home']);

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Rediriger vers la page de connexion après logout
})->name('logout');

require __DIR__.'/auth.php';

Route::get('admin/dashboard',[HomeController::class,'index']);
Route::resource('partenaires', PartenaireController::class);

Route::get('/admin/partenaires/create', [PartenaireController::class, 'create'])->name('partenaires.create');

Route::get('/admin/partenaires/{id}/edit');
Route::get('/admin/partenaires/{id}/edit', [PartenaireController::class, 'edit'])->name('partenaires.edit');

Route::get('/postuler', [StageController::class, 'index'])->middleware(['auth'])->name('postuler');


Route::get('/postuler', [StageController::class, 'index'])->middleware(['auth'])->name('postuler');
Route::get('/stage/create/{id}', [StageController::class, 'create'])->middleware(['auth'])->name('stage.create');
Route::post('/stage/store', [StageController::class, 'store'])->middleware(['auth'])->name('stage.store');
Route::get('/mes-stages', [StageController::class, 'mesStages'])->middleware(['auth'])->name('mes-stages');

Route::get('/stage/edit/{id}', [StageController::class, 'edit'])->middleware(['auth'])->name('stage.edit');
Route::post('/stage/update/{id}', [StageController::class, 'update'])->middleware(['auth'])->name('stage.update');
Route::delete('/stage/destroy/{id}', [StageController::class, 'destroy'])->middleware(['auth'])->name('stage.destroy');



Route::put('/admin/stage/valider/{id}', [StageController::class, 'valider'])
    ->middleware(['auth'])
    ->name('stage.valider');

Route::get('/admin/tous-les-stages', [StageController::class, 'tousLesStages'])
    ->middleware(['auth'])
    ->name('admin.tous-stages');

    Route::get('/admin/stages-valides', [StageController::class, 'demandesValidees'])->middleware(['auth'])->name('admin.stages-valides');
    Route::get('/admin/stages-valides', [StageController::class, 'afficherStagesValides'])->middleware(['auth'])->name('admin.stages-valides');

  
    Route::get('/admin/stages/remettre-en-attente/{id}', [StageController::class, 'remettreEnAttente'])->middleware(['auth'])->name('admin.stages-remettre-en-attente');

    Route::get('/stages/export', [StageController::class, 'exportExcel'])->name('stages.export');
    Route::get('/admin', [HomeController::class, 'index'])->name('admin.index');

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
   

// ✅ Rediriger tous les utilisateurs vers le dashboard unique
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('auth');

// ✅ Routes pour les admins uniquement
Route::middleware(['auth', 'can:voir tous les stages'])->group(function () {
    Route::get('/admin/tous-les-stages', [StageController::class, 'tousLesStages'])->name('admin.tous-stages');
    Route::get('/admin/stages-valides', [StageController::class, 'demandesValidees'])->name('admin.stages-valides')->middleware('can:voir stages validés');
});



// ✅ Routes accessibles aux étudiants uniquement

Route::middleware(['auth', 'role:etudiant'])->prefix('etudiant')->group(function () {
    Route::get('/mes-stages', [StageController::class, 'mesStages'])->name('etudiant.mes-stages');
    Route::get('/postuler', [StageController::class, 'index'])->name('etudiant.postuler');
});




/*Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/gestion-users', [AdminController::class, 'index'])->name('admin.gestion-users');
}); */

Route::get('/admin/gestion-users', [AdminController::class, 'index'])->name('admin.gestion-users');

Route::put('/stage/{id}/rejeter', [StageController::class, 'rejeter'])->name('stage.rejeter');

Route::get('/admin/tous-stages-filtre', [StageController::class, 'filtrer'])->name('admin.tous-stages-filtre');

/*Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard'); */

Route::get('/admin', [HomeController::class, 'index'])->name('admin.index');

Route::delete('/partenaires/{id}', [PartenaireController::class, 'destroy'])->name('partenaires.destroy'); 
Route::get('/admin/partenaires/create', [PartenaireController::class, 'create'])->name('admin.partenaires.create');

