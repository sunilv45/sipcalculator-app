<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SipCalculatorController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [SipCalculatorController::class, 'index'])->name('sip-calculator.index');
Route::get('/retirement-calculator', [SipCalculatorController::class, 'retirementcalculator'])->name('retirementcalculator.show');
Route::get('/swp-calculator', [SipCalculatorController::class, 'swpcalculator'])->name('swpcalculator.show');
Route::get('/step-up-sip-calculator', [SipCalculatorController::class, 'setupsipcalculator'])->name('setupsipcalculator.show');
Route::get('/sip-value-calculator', [SipCalculatorController::class, 'sipvaluecalculator'])->name('sipvaluecalculator.show');
//Route::post('/sip-calculator', [SipCalculatorController::class, 'calculate']);