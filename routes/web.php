<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ColecaoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\CupomController;
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

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/loja/{id}', [MainController::class, 'loja'])->name('loja');
Route::get('/colecao/{id}', [MainController::class, 'colecaoShow'])->name('colecao.show');
Route::get('/contato', [MainController::class, 'contato'])->name('contato');
Route::get('/sobre', [MainController::class, 'sobre'])->name('sobre');
Route::get('/encaminhando', [MainController::class, 'contatoWhatsapp'])->name('encaminhando');
Route::get('/produto/{id}', [MainController::class, 'pagProduto'])->name('pag.produto');

//contatos
Route::post('/enviando/contato', [ContatoController::class, 'criandoContato'])->name('criando.contato');
Route::get('/adm/contatos/{id}', [ContatoController::class, 'mostrandoContato'])->name('lista.contatos');

//carrinho
Route::post('/carrinho/addCarrinho', [CarrinhoController::class, 'addToCart'])->name('carrinho.addcarrinho');
Route::get('/carrinho/excluirCarrinho/{id}', [CarrinhoController::class, 'excluirCarrinho'])->name('carrinho.excluircarrinho');
Route::get('/carrinho', [CarrinhoController::class, 'carrinho'])->name('carrinho');
Route::get('/carrinho/encaminhando', [CarrinhoController::class, 'finalizando'])->name('carrinho.final');
Route::post('/carrinho/finalizando', [CarrinhoController::class, 'whatsapp'])->name('carrinho.whatsapp');
Route::get('/carrinho/finalizando/combinar', [CarrinhoController::class, 'whatsappCombinar'])->name('carrinho.whatsapp.combinar');

//cupom
Route::post('/carrinho/addCupom', [CarrinhoController::class, 'addCupom'])->name('add.cupom');
Route::get('/carrinho/removeCupom', [CarrinhoController::class, 'removeCupom'])->name('remove.cupom');
//cupom admin
Route::get('/admin/cupom/cupons', [CupomController::class, 'listaCupom'])->name('lista.cupons');
Route::get('/admin/cupom/createcupom', [CupomController::class, 'formCupom'])->name('formCupom');
Route::get('/admin/cupom/removecupons/{id}', [CupomController::class, 'removeCupom'])->name('admin.removecupom');
Route::get('/admin/cupom/atualizar/{id}', [CupomController::class, 'editarCupom'])->name('atualizar.cupom');
Route::post('/admin/cupom/addcupom', [CupomController::class, 'criarCupom'])->name('createCupom');
Route::put('/admin/cupom/process/{id}', [CupomController::class, 'processEditCupom'])->name('processCupomEdit');


//config.painel
Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.config');
Route::put('/admin/settings/process/{id}', [AdminController::class, 'editandoNumero'])->name('admin.config.process');


//produtos.painel
Route::get('/admin/produtos/inserirproduto', [ProdutoController::class, 'inserir'])->name('inserir.produto');
Route::post('/admin/produtos/capturando', [ProdutoController::class, 'capturando'])->name('capturando');
Route::get('/admin/produtos/editar/{id}', [ProdutoController::class, 'editarProdutos'])->name('admin.edit.produto');
Route::put('/admin/produtos/editar/process/{id}', [ProdutoController::class, 'editandoProduto'])->name('admin.edit.process.produto');
Route::get('/admin/produtos/remove/{id}', [ProdutoController::class, 'removeProduto'])->name('admin.remove.produto');


//coleção.painel
Route::get('/admin/colecoes/remove/{id}', [ColecaoController::class, 'remove'])->name('admin.remove.colecao');
Route::post('/admin/colecoes/capturando', [ColecaoController::class, 'dado'])->name('admin.capturando.colecao');
Route::get('/admin/colecoes/inserircolecao', [ColecaoController::class, 'inserir'])->name('admin.inserir.colecao');
Route::get('/admin/colecoes/editar/{id}', [ColecaoController::class, 'editarColecao'])->name('admin.editar.colecao');
Route::put('/admin/colecoes/process/{id}', [ColecaoController::class, 'editandoColecao'])->name('admin.process.colecao');


//tipo.painel
Route::get('/admin/tipos/inserirTipos', [TipoController::class, 'fomCriar'])->name('admin.tipos.inserir');
Route::post('/admin/tipos/criando', [TipoController::class, 'criandoTipo'])->name('admin.tipos.criando');
Route::get('/admin/tipos/excluindo/{id}', [TipoController::class, 'excluindoTipo'])->name('admin.tipos.excluindo');
Route::get('/admin/tipos/editar/{id}', [TipoController::class, 'editarTipo'])->name('admin.tipos.editar');
Route::put('/admin/tipos/editar/process/{id}', [TipoController::class, 'editandoTipo'])->name('admin.edit.process.tipos');


//adm.login
Route::get('/admin/login', [AdminController::class, 'login'])->name('login.adm');
Route::post('/auth', [AdminController::class, 'auth'])->name('auth');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');


//adm.painel
Route::get('/admin', [AdminController::class, 'painel'])->name('admin');
Route::get('/admin/produtos', [AdminController::class, 'painelProdutos'])->name('admin.produtos');
Route::get('/admin/colecoes', [AdminController::class, 'painelColecao'])->name('admin.colecoes');
Route::get('/admin/tipos', [AdminController::class, 'painelTipos'])->name('admin.tipos');