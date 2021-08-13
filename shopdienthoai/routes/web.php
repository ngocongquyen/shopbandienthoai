<?php

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

//Fontend
Route::get('/','App\Http\Controllers\HomeController@index');

Route::get('/Trangchu','App\Http\Controllers\HomeController@index');
Route::get('/product-selling','App\Http\Controllers\HomeController@product_selling');
Route::get('/product-latest','App\Http\Controllers\HomeController@product_latest');

//Danh muc san pham
Route::get('/danh-muc-san-pham/{brand_id}','App\Http\Controllers\BrandProduct@show_brand_home');

//Detail
Route::get('/chi-tiet-san-pham/{product_id}','App\Http\Controllers\ProductController@details_product');
Route::post('/save-rating/{product_id}','App\Http\Controllers\ProductController@save_rating');
Route::post('/product-view','App\Http\Controllers\ProductController@product_view');

//Lien he
Route::get('/lien-he','App\Http\Controllers\ContactController@lien_he');
Route::get('/information','App\Http\Controllers\ContactController@information');
Route::post('/save-infor','App\Http\Controllers\ContactController@save_infor');
Route::post('/update-infor/{info_id}','App\Http\Controllers\ContactController@update_infor');

//Account
Route::get('/my-account','App\Http\Controllers\AccountController@my_account');
Route::post('/change-account/{customer_id}','App\Http\Controllers\AccountController@change_account');
Route::get('/history','App\Http\Controllers\AccountController@history');
Route::get('/view-history-order/{order_id}','App\Http\Controllers\AccountController@view_history_order');
Route::post('/huy-don-hang','App\Http\Controllers\AccountController@huy_don_hang');

//Search
Route::post('/fetch','App\Http\Controllers\HomeController@Autocomplete');
Route::get('/tim-kiem','App\Http\Controllers\HomeController@search');

//Cart
Route::post('/add-cart-ajax','App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/gio-hang','App\Http\Controllers\CartController@gio_hang');
Route::post('/update-cart','App\Http\Controllers\CartController@update_cart');
Route::get('/del-product/{session_id}','App\Http\Controllers\CartController@del_product');
Route::get('/del-all-product','App\Http\Controllers\CartController@del_all_product');
Route::get('/show-cart','App\Http\Controllers\CartController@show_cart');
Route::get('/hover-cart','App\Http\Controllers\CartController@hover_cart');

//Payment
Route::get('/pay-ment','App\Http\Controllers\CartController@pay_ment');

//Checkout
Route::get('/login-checkout','App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/logout-checkout','App\Http\Controllers\CheckoutController@logout_checkout');
Route::post('/add-customer','App\Http\Controllers\CheckoutController@add_customer');
Route::post('/order-place','App\Http\Controllers\CheckoutController@order_place');
Route::post('/login-customer','App\Http\Controllers\CheckoutController@login_customer');
Route::get('/checkout','App\Http\Controllers\CheckoutController@checkout');
Route::get('/payment','App\Http\Controllers\CheckoutController@payment');
Route::post('/save-checkout-customer','App\Http\Controllers\CheckoutController@save_checkout_customer');


//Backend Amin
Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::get('/dashboard','App\Http\Controllers\AdminController@showdashboard');
Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');
Route::get('/logout','App\Http\Controllers\AdminController@logout');

Route::get('/login-facebook','App\Http\Controllers\AdminController@login_facebook');
Route::get('/admin/callback','App\Http\Controllers\AdminController@callback_facebook');

//doanh so
Route::post('/filter-by-date','App\Http\Controllers\AdminController@filter_by_date');
Route::post('/dashboard-filter','App\Http\Controllers\AdminController@dashboard_filter');
Route::post('/days-order','App\Http\Controllers\AdminController@days_order');


//Categoty Product
Route::get('/add-category-product','App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/all-category-product','App\Http\Controllers\CategoryProduct@all_category_product');
Route::get('/edit-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@delete_category_product');

Route::get('/unactive-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@active_category_product');

Route::post('/save-category-product','App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@update_category_product');

//Brand

Route::get('/add-brand-product','App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/all-brand-product','App\Http\Controllers\BrandProduct@all_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@delete_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@active_brand_product');

Route::post('/save-brand-product','App\Http\Controllers\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@update_brand_product');

// Category Post

Route::get('/add-category-post','App\Http\Controllers\CategoryPost@add_category_post');
Route::post('/save-category-post','App\Http\Controllers\CategoryPost@save_category_post');
Route::get('/all-category-post','App\Http\Controllers\CategoryPost@all_category_post');
Route::get('/edit-category-post/{cate_post_id}','App\Http\Controllers\CategoryPost@edit_category_post');
Route::get('/delete-category-post/{cate_post_id}','App\Http\Controllers\CategoryPost@delete_category_post');
Route::post('/update-category-post/{cate_post_id}','App\Http\Controllers\CategoryPost@update_category_post');

//Post
Route::get('/add-post','App\Http\Controllers\PostController@add_post');
Route::get('/all-post','App\Http\Controllers\PostController@all_post');
Route::get('/edit-post/{post_id}','App\Http\Controllers\PostController@edit_post');
Route::get('/delete-post/{post_id}','App\Http\Controllers\PostController@delete_post');
Route::post('/save-post','App\Http\Controllers\PostController@save_post');
Route::post('/update-post/{post_id}','App\Http\Controllers\PostController@update_post');

//Danh muc bai viet
Route::get('/danh-muc-bai-viet/{post_slug}','App\Http\Controllers\PostController@danh_muc_bai_viet');
Route::get('/bai-viet/{post_slug}','App\Http\Controllers\PostController@bai_viet');

//User
Route::get('/add-users','App\Http\Controllers\UserController@add_users')->middleware('auth.roles');
Route::get('/users','App\Http\Controllers\UserController@index')->middleware('auth.roles');
Route::get('/delete-user-roles/{admin_id}','App\Http\Controllers\UserController@delete_user_roles')->middleware('auth.roles');
Route::get('/impersonate/{admin_id}','App\Http\Controllers\UserController@impersonate');
Route::get('/impersonate-destroy','App\Http\Controllers\UserController@impersonate_destroy');

Route::post('store-users','App\Http\Controllers\UserController@store_users');
Route::post('assign-roles','App\Http\Controllers\UserController@assign_roles')->middleware('auth.roles');

Route::group(['middleware' => 'auth.roles'],function(){
    Route::get('/add-product','App\Http\Controllers\ProductController@add_product');   
    Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');
});


//Product
Route::get('/all-product','App\Http\Controllers\ProductController@all_product');
Route::get('/delete-product/{product_id}','App\Http\Controllers\ProductController@delete_product');

Route::get('/unactive-product/{product_id}','App\Http\Controllers\ProductController@unactive_product');
Route::get('/active-product/{product_id}','App\Http\Controllers\ProductController@active_product');

Route::post('/save-product','App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}','App\Http\Controllers\ProductController@update_product');
Route::post('/load-comment','App\Http\Controllers\ProductController@load_comment');
Route::post('/send-comment','App\Http\Controllers\ProductController@send_comment');
Route::get('/comment','App\Http\Controllers\ProductController@list_comment');
Route::post('/reply-comment','App\Http\Controllers\ProductController@reply_comment');
Route::get('/delete-comment/{comment_id}','App\Http\Controllers\ProductController@delete_comment');



//Order
Route::get('/manage-order','App\Http\Controllers\OrderController@manager_order');
Route::get('/view-order/{order_id}','App\Http\Controllers\OrderController@view_order');
Route::post('/update-order-qty','App\Http\Controllers\OrderController@update_order_qty');
Route::post('/update-qty','App\Http\Controllers\OrderController@update_qty');
Route::get('/delete-order/{order_id}','App\Http\Controllers\OrderController@delete_order');
Route::get('/print-order/{checkout_code}','App\Http\Controllers\OrderController@print_order');


// Route::get('/manage-order','App\Http\Controllers\CheckoutController@manager_order');
// Route::get('/view-order/{orderId}','App\Http\Controllers\CheckoutController@view_order');

//Coupon
Route::post('/check-coupon','App\Http\Controllers\CartController@check_coupon');

//Coupon Admin
Route::get('/insert-coupon','App\Http\Controllers\CouponController@insert_coupon');
Route::get('/list-coupon','App\Http\Controllers\CouponController@list_coupon');
Route::get('/delete-coupon/{couponID}','App\Http\Controllers\CouponController@delete_coupon');
Route::get('/edit-coupon/{couponID}','App\Http\Controllers\CouponController@edit_coupon');
Route::post('/insert-coupon-code','App\Http\Controllers\CouponController@insert_coupon_code');
Route::post('/update-coupon-code/{couponID}','App\Http\Controllers\CouponController@update_coupon_code');


//Delivery
Route::get('/delivery','App\Http\Controllers\DeliveryController@delivery');
Route::post('/select-delivery','App\Http\Controllers\DeliveryController@select_delivery');

//Gallery
Route::get('/add-gallery/{product_id}','App\Http\Controllers\GalleryController@add_gallery');
Route::post('/select-gallery','App\Http\Controllers\GalleryController@select_gallery');
Route::post('/insert-gallery/{pro_id}','App\Http\Controllers\GalleryController@insert_gallery');
Route::post('/update-gallery-name','App\Http\Controllers\GalleryController@update_gallery_name');
Route::post('/delete-gallery','App\Http\Controllers\GalleryController@delete_gallery');
Route::post('/update-gallery','App\Http\Controllers\GalleryController@update_gallery');


//Authentication roles
Route::get('/register-auth','App\Http\Controllers\AuthController@register_auth');
Route::get('/login-auth','App\Http\Controllers\AuthController@login_auth');
Route::get('/logout-auth','App\Http\Controllers\AuthController@loout_auth');
Route::post('/register','App\Http\Controllers\AuthController@register');
Route::post('/login','App\Http\Controllers\AuthController@login');

//send mail
Route::get('/send-mail','App\Http\Controllers\HomeController@send_mail');
Route::get('/send-coupon-vip/{coupon_time}/{coupon_condition}/{coupon_number}/{coupon_code}','App\Http\Controllers\MailController@send_coupon_vip');
Route::get('/send-coupon/{coupon_time}/{coupon_condition}/{coupon_number}/{coupon_code}','App\Http\Controllers\MailController@send_coupon');
Route::get('/mail-example','App\Http\Controllers\MailController@mail_example');
Route::get('/forget-password','App\Http\Controllers\MailController@forget_password');
Route::get('/update-new-pass','App\Http\Controllers\MailController@update_new_pass');
Route::post('/recover-pass','App\Http\Controllers\MailController@recover_pass');
Route::post('/reset-new-pass','App\Http\Controllers\MailController@reset_new_pass');


// send mail password admin
Route::get('/forget-password-admin','App\Http\Controllers\MailController@forget_password_admin');
Route::post('/recover-pass-admin','App\Http\Controllers\MailController@recover_pass_admin');
Route::get('/update-new-pass-admin','App\Http\Controllers\MailController@update_new_pass_admin');
Route::post('/reset-new-pass-admin','App\Http\Controllers\MailController@reset_new_pass_admin');



// Promotion
Route::get('/add-promotion','App\Http\Controllers\PromotionController@add_promotion');
Route::post('/save-promotion','App\Http\Controllers\PromotionController@save_promotion');
Route::post('/update-promotion/{promotion_id}','App\Http\Controllers\PromotionController@update_promotion');
Route::get('/all-promotion','App\Http\Controllers\PromotionController@all_promotion');
Route::get('/edit-promotion/{promotion_id}','App\Http\Controllers\PromotionController@edit_promotion');
Route::get('/delete-promotion/{promotion_id}','App\Http\Controllers\PromotionController@delete_promotion');

// Specification
Route::get('/add-specification','App\Http\Controllers\SpecificationController@add_specification');
Route::get('/all-specification','App\Http\Controllers\SpecificationController@all_specification');
Route::get('/edit-specification/{idtssp}','App\Http\Controllers\SpecificationController@edit_specification');
Route::get('/delete-specification/{idtssp}','App\Http\Controllers\SpecificationController@delete_specification');
Route::post('/save-specification','App\Http\Controllers\SpecificationController@save_specification');
Route::post('/update-specification/{idtssp}','App\Http\Controllers\SpecificationController@update_specification');



