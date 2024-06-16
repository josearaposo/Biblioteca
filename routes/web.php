<?php

use App\Http\Controllers\LibroController;
use App\Http\Controllers\ProfileController;
use App\Models\Cliente;
use App\Models\Ejemplar;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('libros', LibroController::class);


Route::get('/ejemplares', function () {
    return view('ejemplares.index', [
        'ejemplares' => Ejemplar::all(),
    ]);
})->name('ejemplares.index');


Route::get('/ejemplares/{ejemplar}', function (Ejemplar $ejemplar) {
    $prestamo = $ejemplar->prestamosVigentes()->first();
    if ($prestamo != null) {
        $fecha_hora = Carbon::parse($prestamo->fecha_hora);
        $diferencia = $fecha_hora->diffInDays(now());
    } else {
        $diferencia = 0;
    }
    return view('ejemplares.show', [
        'ejemplar' => $ejemplar,
        'prestado' => $prestamo != null,
        'diferencia' => $diferencia,
    ]);
})->name('ejemplares.show');

Route::get('/prestamos/devolver/{prestamo}', function (Prestamo $prestamo) {
    $prestamo->devolucion = now();
    $prestamo->save();
    return redirect()->route('ejemplares.index');
})->name('prestamos.devolver');

Route::get('/prestamos/create/{ejemplar}', function (Ejemplar $ejemplar) {
    return view('prestamos.create', [
        'ejemplar' => $ejemplar,
        'clientes' => Cliente::all(),
    ]);
})->name('prestamos.create');

Route::post('/prestamos/store/{ejemplar}', function (Ejemplar $ejemplar, Request $request) {
    $prestamo = new Prestamo();
    $prestamo->ejemplar_id = $ejemplar->id;
    $prestamo->cliente_id = $request->cliente_id;
    $prestamo->fecha_hora = now();
    $prestamo->save();
    return view('ejemplares.index', [
        'ejemplares' => Ejemplar::all(),
    ]);
 })->name('prestamos.store');

require __DIR__.'/auth.php';
