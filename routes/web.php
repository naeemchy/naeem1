<?php



Route::get('/', function () {return view('pages.index');});
//auth & user
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');

//admin=======

Route::get('admin/home', 'AdminController@index');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
        // Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update'); 
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

//admin=======category route here
Route::get('Admin_categories', 'Admin\Category\CategoryController@Category')->name('categories');
Route::post('/Admin/Store/Category', 'Admin\Category\CategoryController@StoreCategory')->name('store.category');
Route::get('delete/category/{id}', 'Admin\Category\CategoryController@DeleteCategory');
Route::get('edit/category/{id}', 'Admin\Category\CategoryController@EditCategory');
Route::post('update/category/{id}', 'Admin\Category\CategoryController@UpdateCategory');
//admin=======brands route here
Route::get('Admin_brands', 'Admin\Category\CategoryController@brand')->name('brands');
Route::post('/Admin/Store/Brand', 'Admin\Category\CategoryController@StoreBrand')->name('store.brand');
Route::get('delete/brand/{id}', 'Admin\Category\CategoryController@DeleteBrand');
Route::get('edit/brand/{id}', 'Admin\Category\CategoryController@EditBrand');
Route::post('update/brand/{id}', 'Admin\Category\CategoryController@UpdateBrand');
//admin=======Subcategries route here
Route::get('Admin_subcategories', 'Admin\Category\CategoryController@Subcategories')->name('sub.categories');
Route::post('/Admin/Store/subcategories', 'Admin\Category\CategoryController@subcategory')->name('store.subcategory');
Route::get('delete/subcategory/{id}', 'Admin\Category\CategoryController@Deletesubcategory');
Route::get('edit/subcategory/{id}', 'Admin\Category\CategoryController@Editsubcategory');
Route::post('update/subcategory/{id}', 'Admin\Category\CategoryController@Updatesubcategory');
//admin=======Coupon route here
Route::get('Admin_Coupon', 'Admin\CouponController@coupon')->name('admin.coupon');
Route::post('/Admin/Store/coupon', 'Admin\CouponController@storecoupon')->name('store.coupon');
Route::get('delete/coupon/{id}', 'Admin\CouponController@Deletecoupon');
Route::get('edit/coupon/{id}', 'Admin\CouponController@Editcoupon');
Route::post('update/coupon/{id}', 'Admin\CouponController@Updatecoupon');
//admin=======newslater route here
Route::get('Admin_newslater', 'Admin\CouponController@newslater')->name('admin.newslater');
Route::get('delete/sub/{id}', 'Admin\CouponController@Deletesub');
//admin=======product route here
Route::get('Admin_allproducts', 'Admin\ProductController@index')->name('all_product');
Route::get('Admin_addproducts', 'Admin\ProductController@create')->name('add_product');
Route::post('Admin_store_product', 'Admin\ProductController@store')->name('store_product');
Route::get('inactive/product/{id}', 'Admin\ProductController@Inactive');
Route::get('active/product/{id}', 'Admin\ProductController@Active');
Route::get('delete/product/{id}', 'Admin\ProductController@delete');
Route::get('view/product/{id}', 'Admin\ProductController@Viewproduct');
Route::get('edit/product/{id}', 'Admin\ProductController@EditProduct');
Route::post('update/product/withoutphoto/{id}', 'Admin\ProductController@UpdateProductWithoutPhoto');
Route::post('update/product/photo/{id}', 'Admin\ProductController@UpdateProductPhoto');

//Blogs======= route here
Route::get('Admin_add_post', 'Admin\PostController@create')->name('add.blog.post');
Route::post('Admin_store_post', 'Admin\PostController@store')->name('store.post');
Route::get('Admin_all_post', 'Admin\PostController@index')->name('all.blog.post');
Route::get('delete/post/{id}', 'Admin\PostController@destroy');
Route::get('edit/post/{id}', 'Admin\PostController@edit');
Route::post('update/post/{id}', 'Admin\PostController@update');



//subcategory======= route here
Route::get('get/subcategory/{category_id}', 'Admin\ProductController@getSubcat');

//wishlists
Route::get('add/wishlist/{id}', 'WishlistController@Addwishlist');

//cart
Route::get('add/cart/{id}', 'CartController@Addcart');
Route::get('check', 'CartController@check');
Route::get('product/cart', 'CartController@show_cart')->name('show.cart');
Route::get('remove/cart/{rowId}', 'CartController@removecart');
Route::post('upate/cart/item', 'CartController@update_cart')->name('update.cartitem');
Route::get('cart/product/view/{id}', 'CartController@viewproduct');
Route::post('insert/into/cart', 'CartController@insert_cart')->name('insert.into.cart');
Route::get('user/checkout/', 'CartController@checkout')->name('user.checkout');
Route::get('user/wishlist/', 'CartController@wishlist')->name('user.wishlist');
Route::post('user/apply/coupon/', 'CartController@apply_coupon')->name('apply.coupon');
Route::get('coupon/remove/', 'CartController@CouponRemove')->name('coupon.remove');

//payment method
Route::post('user/payment/process/', 'PaymentController@payment')->name('payment.process');

Route::get('payment/page/', 'CartController@paymentpage')->name('payment.step');

//blog route
Route::get('blog/post', 'BlogController@blog')->name('blog.post');

Route::get('language/bangla', 'BlogController@Bangla')->name('language.bangla');
Route::get('language/english', 'BlogController@English')->name('language.english');


//fontend======= route here
Route::post('store_newslater', 'FrontController@store_newslater')->name('store.newslater');


Route::get('product/details/{id}/{product_name}', 'ProductController@Prouctview');
Route::post('/cart/product/add/{id}', 'ProductController@Addcart');

Route::get('/products/{id}', 'ProductController@Productsview');
//customer profile related route
