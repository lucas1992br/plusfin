<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerSupplierController;
use App\Http\Controllers\CostCenterController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PayingSourceController;
use App\Http\Controllers\OriginController;
use App\Http\Controllers\OutputController;
use App\Http\Controllers\ApproveOutputsController;
use App\Http\Controllers\UpdateOutputController;
use App\Http\Controllers\UploadDocumentController;
use App\Http\Controllers\OutgoingPaymentController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadDocumentInputController;
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
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::resource('dashboard', HomeController::class);

    Route::get('clientes', [CustomerSupplierController::class, 'index'])->name('clientes');

    // Route::get('centro-de-custo', [CostCenterController::class, 'index'])->name('cost-center');
    // Route::post('centro-de-custo', [CostCenterController::class, 'store'])->name('cost-center.store');
    // Route::delete('centro-de-custo/{id}', [CostCenterController::class, 'destroy'])->name('cost-center.destroy');
    // Route::get('centro-de-custo/{id}', [CostCenterController::class, 'show'])->name('cost-center.show');
    // Route::post('centro-de-custo-update/{id}', [CostCenterController::class, 'update'])->name('cost-center.update');
    Route::get('centro-de-custo/export', [CostCenterController::class, 'export'])->name('cost-center.export');

    Route::resource('centro-de-custo', CostCenterController::class);

    Route::resource('atividade', ActivityController::class);

    Route::resource('forma-pagamento', PaymentMethodController::class);

    Route::resource('fonte-pagante', PayingSourceController::class);

    Route::resource('origem', OriginController::class);

    Route::resource('saidas', OutputController::class);

    Route::resource('aprovar-saidas', ApproveOutputsController::class);

    Route::resource('atualizar-saidas', UpdateOutputController::class);

    Route::resource('envio-documentos', UploadDocumentController::class);

    Route::resource('pagamento-saidas', OutgoingPaymentController::class);

    Route::resource('entradas', InputController::class);

    Route::resource('entradadocumentos', UploadDocumentInputController::class);
});
