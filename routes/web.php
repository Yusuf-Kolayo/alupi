<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CatchmentController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ReferringController;



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

// Route::get('/', function () {  return view('welcome'); });

Route::get('/', function () { return redirect()->route('login'); });
Route::get('/agent/referrer/{agent_id}', [ReferringController::class, 'show_referring_form'])->name('agent.show_referring_form');
Route::post('/agent/send_referee_mail/', [ReferringController::class, 'send_referee_mail'])->name('agent.send_referee_mail');
Route::get('/agent/check_referee_code/', [ReferringController::class, 'check_referee_code'])->name('agent.check_referee_code');
Route::post('/agent/ref_submit_form/', [ReferringController::class, 'ref_submit_form'])->name('agent.ref_submit_form');

//=========================      PUBLIC ROUTES      ==========================//
Auth::routes();
Route::get('/dashboard', [BaseController::class, 'index'])->name('dashboard');
Route::get('/chat_board/{user_id?}', [BaseController::class, 'chat_board'])->name('chat_board');
Route::post('/post_chat/', [BaseController::class, 'post_chat'])->name('post_chat');
Route::get('/fetch_chat/', [BaseController::class, 'fetch_chat'])->name('fetch_chat');
Route::get('/resolve_notification/{id}', [BaseController::class, 'resolve_notification'])->name('resolve_notification');
Route::get('/all_notifications/', [BaseController::class, 'all_notifications'])->name('all_notifications');
Route::get('/my_profile/', [BaseController::class, 'my_profile'])->name('my_profile');
Route::get('/access_denied', function () { return view('access_denied'); })->name('access_denied');
Route::resource('client', ClientController::class);  


Route::get('/product/show_details_ajax_fetch', [ProductController::class, 'show_details_ajax_fetch'])->name('product.show_details_ajax_fetch');
Route::get('/product/sub/{sub_category_id}', [ProductController::class, 'sub'])->name('product.sub');
Route::resource('product', ProductController::class);

Route::get('/transaction/trans_details_ajax_fetch', [TransactionController::class, 'trans_details_ajax_fetch'])->name('client.trans_details_ajax_fetch');

    
    
//=========================      ADMIN ROUTES      ==========================//
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function() {   

    Route::get('/catchment/ajax_fetch_lga', [CatchmentController::class, 'ajax_fetch_lga'])->name('catchment.ajax_fetch_lga');
    Route::get('/catchment/{catchment}/trash', [CatchmentController::class, 'trash'])->name('catchment.trash');
    Route::resource('catchment', CatchmentController::class); 
    
    Route::get('/my_profile/{admin?}', [AdminController::class, 'my_profile'])->name('admin.my_profile'); 
    Route::post('/assign_catchment', [AgentController::class, 'assign_catchment'])->name('agent.assign_catchment'); 
   
    Route::post('/transaction/delete_product_session', [TransactionController::class, 'delete_product_session'])->name('client.delete_product_session');
    Route::post('/transaction/pause_session', [TransactionController::class, 'pause_session'])->name('client.pause_session');
    Route::post('/transaction/approve_session', [TransactionController::class, 'approve_session'])->name('client.approve_session');
    
    Route::get('/product/refresh_product_ajax_fetch', [ProductController::class, 'refresh_product_ajax_fetch'])->name('product.refresh_product_ajax_fetch');
    Route::get('/product/update_product_ajax_fetch', [ProductController::class, 'update_product_ajax_fetch'])->name('product.update_ajax_fetch');
    
    Route::resource('brand', BrandController::class);
    
    Route::post('/vendor/pick_vendor_price', [VendorController::class, 'pick_vendor_price'])->name('admin.pick_vendor_price');
});



//=========================      AGENT ROUTES      ==========================//
Route::group (['prefix' => 'agent', 'middleware' => ['auth', 'is_agent']], function() {
    Route::get('/agent/catalog', [ClientController::class, 'delete'])->name('agent.catalog'); 
    Route::get('/product/select_client/', [ClientController::class, 'select_client'])->name('client.select_client');
    
    Route::post('/client/new_purchase_session/', [TransactionController::class, 'new_purchase_session'])->name('client.new_purchase_session');
});



//=========================      ADMIN/AGENT ROUTES      ==========================//
Route::group (['prefix' => 'admin_agent', 'middleware' => ['auth', 'is_admin_agent']], function() {
    Route::get('/agent/ajax_fetch', [AgentController::class, 'ajax_fetch'])->name('agent.ajax_fetch');
    Route::resource('agent', AgentController::class);

    
    Route::get('/client/show_profile_ajax_fetch', [ClientController::class, 'show_profile_ajax_fetch'])->name('client.show_profile_ajax_fetch');
    Route::get('/client/{client}/delete', [ClientController::class, 'delete'])->name('client.delete');  
    
    // Route::get('/client/show/{client}/{flash_msg?}', [ClientController::class, 'show'])->name('client.show');  
    
    Route::get('/transaction/delete_trans_ajax_fetch', [TransactionController::class, 'delete_trans_ajax_fetch'])->name('transaction.delete_trans_ajax_fetch');
    Route::get('/transaction/edit_trans_ajax_fetch', [TransactionController::class, 'edit_trans_ajax_fetch'])->name('transaction.edit_trans_ajax_fetch');
    Route::post('/transaction/create_deposit', [TransactionController::class, 'create_deposit'])->name('client.create_deposit');

    Route::get('/transaction/pps_delete_ajax_fetch', [TransactionController::class, 'pps_delete_ajax_fetch'])->name('client.pps_delete_ajax_fetch');
    Route::get('/transaction/pps_details_ajax_fetch', [TransactionController::class, 'pps_details_ajax_fetch'])->name('client.pps_details_ajax_fetch');
  
    Route::resource('transaction', TransactionController::class); 
    
    Route::get('/category/sub_cat_ajax_fetch', [CategoryController::class, 'sub_cat_ajax_fetch'])->name('category.sub_cat_ajax_fetch');
    Route::resource('category', CategoryController::class);
});







//=========================      VENDOR ROUTES      ==========================//
Route::group (['prefix' => 'vendor', 'middleware' => ['auth', 'is_vendor']], function() {
    Route::get('/vendor/my_unpriced_products', [VendorController::class, 'my_unpriced_products'])->name('vendor.my_unpriced_products'); 
    Route::get('/vendor/my_priced_products', [VendorController::class, 'my_priced_products'])->name('vendor.my_priced_products'); 
    Route::post('/vendor/submit_vendor_price', [VendorController::class, 'submit_vendor_price'])->name('vendor.submit_vendor_price'); 
});


//=========================      ADMIN/VENDOR ROUTES      ==========================//
Route::group (['prefix' => 'admin_vendor', 'middleware' => ['auth', 'is_admin_vendor']], function() {
    Route::resource('vendor', VendorController::class);

 });






//=========================      CLIENT ROUTES      ==========================//
Route::group (['prefix' => 'client', 'middleware' => ['auth', 'is_client']], function() {
    Route::get('/client/my_profile', [BaseController::class, 'my_profile'])->name('client.my_profile'); 
    Route::get('/client/my_account_oficer/{agent:agent_id}', [ClientController::class, 'my_account_oficer'])->name('client.my_account_oficer'); 
 });