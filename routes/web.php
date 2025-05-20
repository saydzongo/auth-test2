<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\StageController;

/*Route::get('/', function () {
    return view('home.index');
});*/
route::get('/',[HomeController::class, 'home']);

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/
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




