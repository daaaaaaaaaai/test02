<?php

// カスタマイズコントローラ
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\NumberRangeController;
use App\Http\Controllers\TaxRateController;
use App\Http\Controllers\JapaneseCalendarController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ResponseRateController;
use App\Http\Controllers\PrefectureController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\MarginController;
use App\Http\Controllers\RemoteCostController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\TypeValueController;

// マスタコントローラ
use App\Http\Controllers\UserController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LisencePlateCostController;
use App\Http\Controllers\CaliController;

// トランザクションコントローラ
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PhysicalInventoryController;

// APIコントローラ
use App\Http\Controllers\ZipcodeController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Resourceful Routes
Route::resource('classification',ClassificationController::class);          // (カスタマイズ)分類
Route::resource('numberrange',NumberRangeController::class);                // (カスタマイズ)番号範囲
Route::resource('taxrate',TaxRateController::class);                        // (カスタマイズ)税率
Route::resource('japanesecalendar',JapaneseCalendarController::class);      // (カスタマイズ)カレンダー
Route::resource('country',CountryController::class);                        // (カスタマイズ)国
Route::resource('unit',UnitController::class);                              // (カスタマイズ)数量単位
Route::resource('responserate',ResponseRateController::class);              // (カスタマイズ)レス率
Route::resource('prefecture',PrefectureController::class);                  // (カスタマイズ)都道府県
Route::resource('color',ColorController::class);                            // (カスタマイズ)色コード表
Route::resource('margin',MarginController::class);                          // (カスタマイズ)スズキ店格マージン
Route::resource('remotecost',RemoteCostController::class);                  // (カスタマイズ)遠方登録費用
Route::resource('type',TypeController::class);                              // (カスタマイズ)種別
Route::resource('typevalue',TypeValueController::class);                    // (カスタマイズ)種別値
Route::resource('user', UserController::class);                             // (マスタ)ユーザ
Route::resource('material', MaterialController::class);                     // (マスタ)商品
Route::resource('customer', CustomerController::class);                     // (マスタ)顧客
Route::resource('lisenceplatecost', LisencePlateCostController::class);     // (マスタ)ナンバープレート費用
Route::resource('cali', CaliController::class);                             // (マスタ)自賠責保険
Route::resource('quotation', QuotationController::class);                   // (トランザクション)見積
Route::resource('salesorder', SalesOrderController::class);                 // (トランザクション)受注
Route::resource('invoice', InvoiceController::class);                       // (トランザクション)請求
Route::resource('inventory', InventoryController::class);                   // (トランザクション)在庫
Route::resource('physicalinventory', PhysicalInventoryController::class);   // (トランザクション)実地棚卸

// ZIP検索用
Route::get('/zipcode/{zipcode}', [ZipcodeController::class, 'search']);

// restore,forcedelete用のルート設定
Route::patch('user/{user}/restore',[UserController::class,'restore'])->name('user.restore');
Route::delete('user/{user}/force',[UserController::class,'forceDelete'])->name('user.forceDelete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
