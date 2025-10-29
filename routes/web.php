<?php

// カスタマイズコントローラ
use App\Http\Controllers\Customizes\ClassificationController;
use App\Http\Controllers\Customizes\NumberRangeController;
use App\Http\Controllers\Customizes\TaxRateController;
use App\Http\Controllers\Customizes\JapaneseCalendarController;
use App\Http\Controllers\Customizes\CountryController;
use App\Http\Controllers\Customizes\UnitController;
use App\Http\Controllers\Customizes\ResponseRateController;
use App\Http\Controllers\Customizes\PrefectureController;
use App\Http\Controllers\Customizes\ColorController;
use App\Http\Controllers\Customizes\MarginController;
use App\Http\Controllers\Customizes\RemoteCostController;
use App\Http\Controllers\Customizes\TypeController;
use App\Http\Controllers\Customizes\TypeValueController;

// マスタコントローラ
use App\Http\Controllers\Masters\UserController;
use App\Http\Controllers\Masters\MaterialController;
use App\Http\Controllers\Masters\CustomerController;
use App\Http\Controllers\Masters\LisencePlateCostController;
use App\Http\Controllers\Masters\CaliController;
use App\Http\Controllers\Masters\SalesExpenseController;
use App\Http\Controllers\Masters\SuzukiDataController;

// トランザクションコントローラ
use App\Http\Controllers\Transactions\QuotationController;
use App\Http\Controllers\Transactions\SalesOrderController;
use App\Http\Controllers\Transactions\InvoiceController;
use App\Http\Controllers\Transactions\InventoryController;
use App\Http\Controllers\Transactions\PhysicalInventoryController;

// APIコントローラ
use App\Http\Controllers\APIs\ZipcodeController;

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
Route::resource('salesexpense', SalesExpenseController::class);             // (マスタ)新車販売諸経費(乗りだし)
Route::resource('suzukidata', SuzukiDataController::class);                 // (マスタ)車両標準データ
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
