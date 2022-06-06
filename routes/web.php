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
use App\Http\Controllers\InvoiceController;

use App\Http\Controllers\ShopController;



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

// Route::get('/console', function () { return redirect()->route('login'); });
Route::get('/', [ShopController::class, 'home'])->name('homepage');  
// Route::get('/categories', [ShopController::class, 'shop_category'])->name('shop_category');  
// Route::get('/login', function () { return view('homepage'); }); 

Route::get('/{product_id}/{prd_name}/view', [ShopController::class, 'product_view'])->name('product_view');
Route::get('/register_login/{purchase_type?}/{product_id?}/', [ShopController::class, 'register_login'])->name('register_login');
Route::post('/buy/{purchase_type?}/{product_id?}', [ShopController::class, 'buy'])->name('buy');
Route::post('/register_submit', [ShopController::class, 'register_submit'])->name('register_submit');
Route::post('/login_submit', [ShopController::class, 'login_submit'])->name('login_submit');
Route::post('/shop_sign_out', [ShopController::class, 'shop_sign_out'])->name('shop_sign_out');
// Route::get('/shop/checkout_buy_now', [ShopController::class, 'checkout_buy_now'])->name('shop.checkout_buy_now');
// Route::get('/shop/checkout_installment', [ShopController::class, 'checkout_installment'])->name('shop.checkout_installment');
// Route::get('/shop/fetch_catalog_ajax', [ShopController::class, 'fetch_catalog_ajax'])->name('shop.fetch_catalog_ajax');
   Route::get('/shop', [ShopController::class, 'shop_default'])->name('shop.shop_default');
   Route::get('/shop/search', [ShopController::class, 'shop_by_search'])->name('shop.shop_by_search');
   Route::get('/shop/category/{cat_id}/{slug}/{cate}', [ShopController::class, 'shop_by_categories'])->name('shop.shop_by_categories');
// Route::get('/shop/search', [ShopController::class, 'search_products'])->name('shop.search');
// Route::get('/shop/search/{query}', [ShopController::class, 'shop_by_search'])->name('shop.shop_by_search');
   Route::get('/shop/brand/{brand_id}/{slug}', [ShopController::class, 'shop_by_brands'])->name('shop.shop_by_brands');



Route::get('/agent/referrer/{agent_id}', [ReferringController::class, 'show_referring_form'])->name('agent.show_referring_form');
Route::post('/agent/send_referee_mail/', [ReferringController::class, 'send_referee_mail'])->name('agent.send_referee_mail');
Route::get('/agent/check_referee_code/', [ReferringController::class, 'check_referee_code'])->name('agent.check_referee_code');
Route::post('/agent/ref_submit_form/', [ReferringController::class, 'ref_submit_form'])->name('agent.ref_submit_form');

//=========================      PUBLIC ROUTES      ==========================//



Auth::routes();
// Auth::routes(['login'=>false]);
Route::get('/dashboard', [BaseController::class, 'index'])->name('dashboard');
Route::get('/chat_board/{user_id?}', [BaseController::class, 'chat_board'])->name('chat_board');
Route::post('/post_msg/', [BaseController::class, 'post_msg'])->name('post_msg');
Route::post('/post_file/', [BaseController::class, 'post_file'])->name('post_file');
Route::post('/fetch_chat/', [BaseController::class, 'fetch_chat'])->name('fetch_chat');
Route::get('/resolve_notification/{id}', [BaseController::class, 'resolve_notification'])->name('resolve_notification');
Route::get('/all_notifications/', [BaseController::class, 'all_notifications'])->name('all_notifications');
Route::get('/my_profile/', [BaseController::class, 'my_profile'])->name('my_profile');
Route::get('/access_denied', function () { return view('access_denied'); })->name('access_denied');
Route::resource('client', ClientController::class);  


Route::get('/product/show_details_ajax_fetch', [ProductController::class, 'show_details_ajax_fetch'])->name('product.show_details_ajax_fetch');
Route::get('/product/sub/{sub_category_id}', [ProductController::class, 'sub'])->name('product.sub');
Route::get('/fetch_product_by_brand', [ProductController::class, 'fetch_product_by_brand'])->name('fetch_product_by_brand');
Route::get('/resize/{img}/{h?}/{w?}',function($img, $h=717, $w=1098) {  //  $img->resizeCanvas(1280, 720, 'center', false, 'ff00ff');
    return \Image::make(public_path("storage/uploads/products_img/$img"))->resizeCanvas($w, $h, 'center', false, 'ffffff')->response('jpg');
});
Route::resource('product', ProductController::class);

Route::get('/transaction/trans_details_ajax_fetch', [TransactionController::class, 'trans_details_ajax_fetch'])->name('client.trans_details_ajax_fetch');
Route::get('/transaction/pps_details_ajax_fetch', [TransactionController::class, 'pps_details_ajax_fetch'])->name('client.pps_details_ajax_fetch');
    
    
//=========================      ADMIN ROUTES      ==========================//
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function() {   

    Route::get('/catchment/ajax_fetch_lga', [CatchmentController::class, 'ajax_fetch_lga'])->name('catchment.ajax_fetch_lga');
    Route::get('/catchment/{catchment}/trash', [CatchmentController::class, 'trash'])->name('catchment.trash');
    Route::resource('catchment', CatchmentController::class); 
    
    Route::get('/my_profile/{admin?}', [AdminController::class, 'my_profile'])->name('admin.my_profile'); 
    Route::post('/assign_catchment', [AgentController::class, 'assign_catchment'])->name('agent.assign_catchment'); 

    Route::get('/purchase_invoice', [InvoiceController::class, 'purchase_invoice_index'])->name('purchase_invoice.index');
    Route::post('/purchase_invoice/submit', [InvoiceController::class, 'purchase_invoice_submit'])->name('purchase_invoice.submit'); 
    Route::get('/purchase_invoice/fetch_vendor_data_inv', [InvoiceController::class, 'fetch_vendor_data_inv'])->name('purchase_invoice.fetch_vendor_data_inv'); 
    Route::get('/purchase_invoice/profile/{doc_id}', [InvoiceController::class, 'purchase_invoice_profile'])->name('purchase_invoice.profile');
    Route::get('/purchase_invoice/delete/{doc_id}', [InvoiceController::class, 'purchase_invoice_delete'])->name('purchase_invoice.delete');

    Route::get('/sale_invoice', [InvoiceController::class, 'sale_invoice_index'])->name('sale_invoice.index');
    Route::post('/sale_invoice/submit', [InvoiceController::class, 'sale_invoice_submit'])->name('sale_invoice.submit'); 
    Route::get('/sale_invoice/fetch_client_data_inv', [InvoiceController::class, 'fetch_client_data_inv'])->name('sale_invoice.fetch_client_data_inv'); 
    Route::get('/sale_invoice/profile/{doc_id}', [InvoiceController::class, 'sale_invoice_profile'])->name('sale_invoice.profile');

    Route::post('/transaction/delete_product_session', [TransactionController::class, 'delete_product_session'])->name('client.delete_product_session');
    Route::post('/transaction/pause_session', [TransactionController::class, 'pause_session'])->name('client.pause_session');
    Route::post('/transaction/approve_session', [TransactionController::class, 'approve_session'])->name('client.approve_session');
    
    Route::get('/product/refresh_product_ajax_fetch', [ProductController::class, 'refresh_product_ajax_fetch'])->name('product.refresh_product_ajax_fetch');
    Route::get('/product/update_product_ajax_fetch', [ProductController::class, 'update_product_ajax_fetch'])->name('product.update_ajax_fetch');
    
    Route::post('/update_brand_fetch', [BrandController::class, 'update_brand_fetch'])->name('update_brand_fetch');
    Route::post('/delete_brand_fetch', [BrandController::class, 'delete_brand_fetch'])->name('delete_brand_fetch');
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

  
    Route::resource('transaction', TransactionController::class); 
    
    Route::get('/category/sub_cat_ajax_fetch', [CategoryController::class, 'sub_cat_ajax_fetch'])->name('category.sub_cat_ajax_fetch');
    Route::get('/category/child_cat_ajax_fetch', [CategoryController::class, 'child_cat_ajax_fetch'])->name('category.child_cat_ajax_fetch');
    Route::get('/category/edit_category_ajax_fetch', [CategoryController::class, 'edit_category_ajax_fetch'])->name('category.edit_category_ajax_fetch');
    Route::get('/category/delete_category_ajax_fetch', [CategoryController::class, 'delete_category_ajax_fetch'])->name('category.delete_category_ajax_fetch');
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