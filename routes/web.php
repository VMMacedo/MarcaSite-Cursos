<?php

use App\Http\Controllers\{
    CheckoutController,
    CursoController,
    dashboardController,
    GatewayController,
    InscricaoController,
    ListUsers,
    perfil
};

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

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

/**ROTA DASHBOARD */
Route::get('/dashboard/index', [dashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

/**ROTA GATEWAY */
Route::post('/gateway/edit/{id}', [GatewayController::class, 'put'])->name('gateway.put')->middleware(['auth', 'perfiladm']);
Route::delete('gateway/{id}', [GatewayController::class, 'destroy'])->name('gateway.destroy')->middleware(['auth', 'perfiladm']);
Route::get('/gateway/{id}', [GatewayController::class, 'show'])->name('gateway.show')->middleware(['auth', 'perfiladm']);
Route::post('/gateway/create', [GatewayController::class, 'create'])->name('gateway.create')->middleware(['auth', 'perfiladm']);
Route::get('/gateway', [GatewayController::class, 'index'])->name('gateway.index')->middleware(['auth', 'perfiladm']);

/**ROTA INSCRIÇÃO */
Route::post('/inscricao/linkpagamento/{id}', [InscricaoController::class, 'linkPagamento'])->name('inscricao.linkPagamento')->middleware('auth');
Route::post('/inscricao/editStatus/{id}', [InscricaoController::class, 'putStatus'])->name('inscricao.pustatus')->middleware('auth');
Route::post('/inscricao/edit/{id}', [InscricaoController::class, 'put'])->name('inscricao.put')->middleware('auth');
Route::delete('inscricao/{id}', [InscricaoController::class, 'destroy'])->name('inscricao.destroy')->middleware('auth');
Route::get('/inscricao/{id}', [InscricaoController::class, 'show'])->name('inscricao.show')->middleware('auth');
Route::post('/inscricao/create', [InscricaoController::class, 'create'])->name('inscricao.create')->middleware('auth');
Route::get('/inscricao', [InscricaoController::class, 'index'])->name('inscricao.index')->middleware('auth');

/**ROTA CURSOS */
Route::get('/cursos/get', [CursoController::class, 'getcursos'])->name('cursos.get')->middleware('auth');
Route::post('/cursos/edit/{id}', [CursoController::class, 'put'])->name('cursos.put')->middleware('auth');
Route::delete('cursos/{id}', [CursoController::class, 'destroy'])->name('cursos.destroy')->middleware('auth');
Route::get('/cursos/{id}', [CursoController::class, 'show'])->name('cursos.show')->middleware('auth');
Route::get('/cursos/download/{id}', [CursoController::class, 'download'])->name('cursos.download.material')->middleware('auth');
Route::post('/cursos/create', [CursoController::class, 'create'])->name('cursos.create')->middleware('auth');
Route::get('/cursos', [CursoController::class, 'index'])->name('cursos.index')->middleware('auth');


/**ROTA USUARIOS - PERMITIDO APENAS PARA ADM */
Route::put('/users/{id}', [ListUsers::class, 'put'])->name('users.put')->middleware(['auth', 'perfiladm']);
Route::delete('users/{id}', [ListUsers::class, 'destroy'])->name('users.destroy')->middleware(['auth', 'perfiladm']);
Route::get('/users/{id}', [ListUsers::class, 'show'])->name('users.show')->middleware(['auth', 'perfiladm']);
Route::post('/users/create', [ListUsers::class, 'create'])->name('users.create')->middleware(['auth', 'perfiladm']);
Route::get('/users', [ListUsers::class, 'index'])->name('users.index')->middleware(['auth', 'perfiladm']);

/**ROTA PERFIL */
Route::get('/perfil', [perfil::class, 'index'])->name('perfil.index')->middleware('auth');

/**ROTA CHECKOUT TRANSPARENTE */
Route::prefix('checkout')->group(function () {
    Route::get('/{id}', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/gerarBoleto/{id}/{hash}', [CheckoutController::class, 'gerarBoleto'])->name('checkout.gerarBoleto');
    Route::post('/creditCard/gerar/{id}/{token}/{hash}', [CheckoutController::class, 'gerarCartaoCredito'])->name('checkout.gerarCartaoCredito');
});
/**ROTA PARA O WEBHOOK */
Route::post('/webhook', [CheckoutController::class, 'tratarWebhook'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])->name('checkout.tratarWebhook');


/**ROTA DASHBOARD */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

/**ROTAL LOGIN */
Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('dashboard');
