<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartenaireController;

/*Route::get('/', function () {
    return view('home.index');
});*/
route::get('/',[HomeController::class, 'home']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::resource('partenaires', PartenaireController::class);

