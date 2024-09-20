<?php

use Database\Seeders\CategoriaSeeder;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

//Route::resource('produtos', ProdutoController::class);
//Route::resource('users', UserController::class);

Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/produto/{slug}', [SiteController::class, 'details'])->name('site.details');
Route::get('/categorias/{id}', [SiteController::class, 'categoria'])->name('site.categoria');

Route::get('/carrinho', [CarrinhoController::class, 'carrinhoLista'])->name('site.carrinho');
Route::post('/carrinho', [CarrinhoController::class, 'adicionaCarrinho'])->name('site.addcarrinho');
Route::post('/remover', [CarrinhoController::class, 'removeCarrinho'])->name('site.removecarrinho');
Route::post('/atualizar', [CarrinhoController::class, 'atualizaCarrinho'])->name('site.atualizacarrinho');
Route::get('/limpar', [CarrinhoController::class, 'limparCarrinho'])->name('site.limparcarrinho');

Route::view('/login', 'login.form')->name('login.form');
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::get('/register', [LoginController::class, 'create'])->name('login.create');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware(['auth','checkemail']);
Route::get('/admin/produtos', [ProdutoController::class,'index'])->name('admin.produtos')->middleware(['auth']);
Route::delete('/admin/produto/delete/{id}', [ProdutoController::class, 'destroy'])->name('admin.produto.delete')->middleware(['auth']);
Route::post('/admin/produto/store', [ProdutoController::class, 'store'])->name('admin.produto.store')->middleware(['auth']);
Route::put('/admin/produto/edit', [ProdutoController::class, 'edit'])->name('admin.produto.edit')->middleware(['auth']);


//Route::get('produtos', [ProdutoController::class, 'index'])->name('user.index');

// use App\Http\Controllers\ProdutoController;

/*
Route::get('/', [ProdutoController::class, 'index'])->name('produto.idex');


Route::get('/produto/{id?}', [ProdutoController::class, 'show'])->name('produto.show');
*/





//Route redireciona
//view rederiza a pagina que chamamos, ficheiro
/*
Route::get('/default',function(){
    return " ";
});
*/

//testes passados
/*
Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix'=> 'admin',
    'as'=>'admin.'
],function(){
    Route::get('dashboard',function(){
        return "dashboard";
    })->name('dashboard');
    
    Route::get('users',function(){
        return "users";
    })->name('users');
    
    Route::get('clients',function(){
        return "clientes";
    })->name('clientes');
});

Route::any('/any', function(){
    return "Permite todo o tipo de acesso http (put, delete, get, post)";
});

Route::match(['put','delete'],'/match',function(){ 
    return "Permite apenas acessos defenidos";
});

Route::get('/produto/{id}/{cat?}',function($id, $cat = ''){
    return " o id do produto é : ".$id."<br>". "A categoria é : ".$cat;
});

Route::redirect('/sobre','/1_Laravel_App_v2/public/empresa');
Route::view('/empresa','site/empresa');

Route::get('/news',function(){
    return view('/news');
})->name('noticias');

Route::get('/novidades',function(){
    return redirect()->route('noticias');
});
*/