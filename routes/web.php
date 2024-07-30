<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\achteur;
use App\Http\Controllers\command;
use App\Http\Controllers\buy;
use App\Http\Controllers\store;
use App\Http\Controllers\produit;

Route::get('/', [achteur::class, 'index']);
//Auth::routes( ['register' => false ]); rempouve registrer

Auth::routes();

Route::get('/store', function () {
    return view('test.store');
})->middleware('auth');

Route::get('/vendre', function () {
    return view('test.vendre');
});

Route::get('/magasin/{id}', [App\Http\Controllers\store::class, 'index']);

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

Route::post('/ach/{id}', [command::class,'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/buy/{id}', [App\Http\Controllers\buy::class, 'index'])->middleware('auth');

Route::get('/test/{par}', function ($par) {  
    return view('testPar',['id'=>$par]);
});

Route::get('/mescommand', [App\Http\Controllers\buy::class, 'mescommand'])->middleware('auth');;

Route::post('/mescommand/{id}', [App\Http\Controllers\buy::class, 'mescommandpost'])->middleware('auth');

Route::get('/produit/{id}', [App\Http\Controllers\produit::class, 'index'])->middleware('auth');;

Route::get('/valide', function () {
    return view('test.valide');
});

Route::get('/acheter', [achteur::class, 'index']);


Route::get('validechangementdeprix/{id}', [App\Http\Controllers\manipulerproduit::class, 'valide'])->middleware('auth');
Route::post('supp/{id}', [App\Http\Controllers\manipulerproduit::class, 'supprimer'])->middleware('auth');

Route::post('/items', [ItemController::class, 'store']);
