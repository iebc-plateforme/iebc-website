<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('welcome');
})->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

// Frontend Public Routes
Route::get('/services', [App\Http\Controllers\FrontendController::class, 'services'])->name('services');
Route::get('/blog', [App\Http\Controllers\FrontendController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [App\Http\Controllers\FrontendController::class, 'blogShow'])->name('blog.show');
Route::get('/equipe', [App\Http\Controllers\FrontendController::class, 'team'])->name('team');
Route::get('/galerie', [App\Http\Controllers\FrontendController::class, 'gallery'])->name('gallery');
Route::get('/partenaires', [App\Http\Controllers\FrontendController::class, 'partners'])->name('partners');
Route::get('/contact', [App\Http\Controllers\FrontendController::class, 'contactForm'])->name('contact');
Route::post('/contact', [App\Http\Controllers\FrontendController::class, 'submitContact'])->name('contact.submit');
Route::get('/a-propos', [App\Http\Controllers\FrontendController::class, 'about'])->name('about');

// Admin Routes - Accessible via /back-end-iebc
Route::prefix('back-end-iebc')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('partners', App\Http\Controllers\Admin\PartnerController::class);
    Route::resource('teams', App\Http\Controllers\Admin\TeamController::class);
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class);
    Route::resource('galleries', App\Http\Controllers\Admin\GalleryController::class);

    Route::get('contacts', [App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [App\Http\Controllers\Admin\ContactController::class, 'show'])->name('contacts.show');
    Route::delete('contacts/{contact}', [App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('contacts.destroy');

    // Paramètres du site
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // Gestion des utilisateurs (réservé au Super Admin)
    Route::middleware(['superadmin'])->group(function () {
        Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except(['show']);
    });
});
