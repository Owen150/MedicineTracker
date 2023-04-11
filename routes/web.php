<?php

use App\Http\Controllers\AllocatedBudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\DrawingRightController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FacilityProductController;
use App\Http\Controllers\FinancialYearController;
use App\Http\Controllers\InvoiceProformaController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductManufacturersController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseOrderDetailController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierProductController;
use App\Http\Controllers\UserController;
use App\Models\Facility;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect('/login');
});



Route::post('/two-factor/resend', [UserController::class, 'resend'])->name('two_factor_resend')->middleware('auth');

Route::group(['middleware' => ['auth', 'twofactor']], function () {

    Route::get('drawing-rights-data', [DrawingRightController::class, 'indexData'])->name('rights_data');
    Route::get('drawing-rights-facility-data/{id}', [DrawingRightController::class, 'facilityData'])->name('rights_facility_data');
    Route::get('facility-data', [FacilityController::class, 'indexData'])->name('facility_data');
    Route::get('user-data', [UserController::class, 'indexData'])->name('user_data');
    Route::get('suppler-products-data', [SupplierProductController::class, 'indexData'])->name('suppler_products_data');
    Route::get('allocated-budget-data', [AllocatedBudgetController::class, 'indexData'])->name('allocated_budget_data');
    Route::get('purchase-order-data', [PurchaseOrderController::class, 'indexData'])->name('purchase_order_data');
    Route::get('category-type-data', [CategoryTypeController::class, 'indexData'])->name('category_type_data');


    //route to get product details from supplier product details
    Route::post('suppler-products-details', [PurchaseOrderController::class, 'getProdCodePrice'])->name('suppler_products_details');

    //get purchase order details for received page
    Route::get('purchase-order-receive/{id}', [PurchaseOrderController::class, 'getOrder'])->name('purchase_order_receive');

    //consolidate purchase order
    Route::post('consolidate', [PurchaseOrderController::class, 'consolidate'])->name('consolidate');

    Route::resource('users', UserController::class);
    Route::resource('drawing-rights', DrawingRightController::class);
    Route::resource('facility', FacilityController::class);
    Route::resource('purchase-order', PurchaseOrderController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('financialYear', FinancialYearController::class);
    Route::resource('suppler-products', SupplierProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('allocated-budget', AllocatedBudgetController::class);
    Route::resource('facilityProducts', FacilityProductController::class);
    Route::resource('productManufacturers', ProductManufacturersController::class);
    Route::resource('profomas', InvoiceProformaController::class);
    Route::resource('category-type', CategoryTypeController::class);


    Route::post('/supplier-excel', [SupplierProductController::class, 'excelDownload'])->name('excel_suppliers');
    Route::post('/supplier-excel-upload', [SupplierProductController::class, 'excelUpload'])->name('excel_suppliers_upload');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/verify-two-factor', [UserController::class, 'towFactor'])->name('two_factor')->middleware('auth');
    Route::post('/verify-two-factor/verify', [UserController::class, 'validateRedirectTwoFactor'])->name('two_factor_verify')->middleware('auth');


    Route::resource('purchase-order-detail', PurchaseOrderDetailController::class);
    Route::get('/purchase-order-details/{id}/edit', [PurchaseOrderDetailController::class, 'editPurchase'])->name('editPurchase');
    Route::post('/purchase-order-details/{id}', [PurchaseOrderDetailController::class, 'updatePurchase'])->name('updatePurchase');

    Route::get('/pos', [PosController::class, 'index']);
    Route::post('/search', [PosController::class, 'search']);
    Route::get('/pos-products', [PosController::class, 'posAllProducts']);
});
Auth::routes();
