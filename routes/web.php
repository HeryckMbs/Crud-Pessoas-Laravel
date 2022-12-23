<?php

use App\Models\Pessoa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $pessoasCadastradas = Pessoa::with('telefones')->get();

    return view('welcome', compact('pessoasCadastradas'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'pessoa'], function () {
    Route::get('/{id}', [PessoaController::class, 'getPessoa'])->name('get.pessoa');
    Route::put('/{id}', [PessoaController::class, 'updatePessoa'])->name('get.pessoa');
    Route::post('/salvar', [PessoaController::class, 'storePessoa'])->name('cadastra.pessoa');
    Route::delete('/delete/{id}', [PessoaController::class, 'deletePessoa'])->name('delete.pessoa');
});
