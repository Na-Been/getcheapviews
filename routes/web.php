<?php

use Illuminate\Support\Facades\Auth;
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

//for welcome page
Route::get('/', 'HomeController@index');
//for views
Route::get('/category/{category}/{subcategory}', 'HomeController@viewSlug')->name('subcategory.page');
//for F&Q
Route::get('question', 'HomeController@question')->name('home.question');
//for buy now
Route::get('buy/{slug}', 'HomeController@buyNow')->name('buy.now');
Route::post('buy/{slug}', 'HomeController@purchase')->name('buy.now.purchase');
//for contact
Route::get('contact', 'HomeController@contact')->name('contact.index');
Route::post('contact', 'HomeController@store')->name('contact.create');


//for changing mode
Route::get('change/mode', 'SettingController@changeMode')->name('update.dark.mode');

//for user login and registration
Route::view('/user/register', 'users.auth.register')->name('user.register');

//for admin login
Route::get('/admin/login','AdminLoginController@index')->name('admin.login');
Route::post('/admin/login','AdminLoginController@login')->name('admin.login');

Auth::routes(['verify'=>true]);

//for changing password
Route::post('change/password', 'ProfileController@changePassword')->name('change.password')->middleware('auth');
//for admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    //for setting
    Route::get('setting/create', 'SettingController@create')->name('setting.create');
    Route::post('setting/store', 'SettingController@store')->name('setting.store');
    //for admin dashboard and profile
    Route::get('dashboard', 'AdminController@index')->name('admin.index');
    //for slider
    Route::resource('slider', 'SliderController');
    //for blog
    Route::resource('blog', 'BlogController');
    //for category
    Route::resource('category', 'CategoryController');
    //for Subcategory
    Route::resource('subcategory', 'SubCategoryController');
    //for product
    Route::get('find/subcategory/{id}', 'ProductController@subCategory')->name('find.subcategory');
    Route::resource('product', 'ProductController');
    //for profile
    Route::resource('profile', 'ProfileController');
    //for FAQ
    Route::resource('question','FAQController');
    //for terms
    Route::resource('condition','TermsController');
    //for ticket
    Route::get('users/tickets','AdminController@showAllTickets')->name('all.users.tickets');
    Route::delete('delete/user/ticket','AdminController@destroyTicket')->name('destroy.user.ticket');
    //for mark as read
    Route::get('order/mark/read/{id}','AdminController@markAsRead')->name('mark.as.read');
    //for deleting registered user
    Route::delete('user/destroy','AdminController@deleteUser')->name('destroy.register.user');
    //for displaying users
    Route::get('users/display','AdminController@displayUsers')->name('display.users');
    Route::get('users/orders/{id}','AdminController@displayAllOrderStatus')->name('view.user.orders.status');
    Route::get('user/order/{id}','AdminController@displayUserOrder')->name('view.user.order');
    Route::get('user/change/status/{id}/{status}','AdminController@changeUserStatus')->name('change.user.status');
    //for deleting user order
    Route::delete('user/orders/destroy','AdminController@deleteUserOrders')->name('destroy.user.order');
    //for displaying all orders items
    Route::get('all/order/items','AdminController@allOrderItmes')->name('all.orders');
    //for changing status of a single product
    Route::get('display/order/status/{id}','AdminController@displaySingleOrder')->name('view.single.order.status');
    //for email marketing
    Route::get('email/view/sendmail','EmailController@index')->name('sendmail.index');
    Route::get('email/view/sendBulkMail','EmailController@bulkMailPage')->name('bulkmail.index');
    Route::get('email/view/emailLogs','EmailController@emailLogsPage')->name('emaillogs.index');
    Route::get('email/view/template','EmailController@emailTemplate')->name('template.index');
    //for adding email template
    Route::get('create/add/template','EmailController@createEmailTemplate')->name('create.email.template');
    Route::post('email/add/template','EmailController@storeEmailTemplate')->name('add.email.template');
    Route::get('email/edit/template/{id}','EmailController@editEmailTemplate')->name('template.edit');
    Route::get('find/template/{id}','EmailController@findEmailTemplate')->name('template.find');
    Route::patch('email/update/template/{id}','EmailController@updateEmailTemplate')->name('update.email.template');
    Route::delete('email/delete/template','EmailController@deleteEmailTemplate')->name('template.destroy');

    //for viewing user
    Route::get('view/user/{id}','EmailController@viewSingleUserDetails')->name('view.user.details');
    //for sending email
    Route::post('send/email','EmailController@sendMail')->name('send.single.email');
    Route::get('view/send/email/{id}','EmailController@viewSingleSendMail')->name('view.send.email');
    //for sending bulk emails
    Route::post('send/bulk/email','EmailController@sendBulkEmail')->name('send.bulk.email');
    //for deleting mail
    Route::delete('delete/single/mail','EmailController@deleteSingleMail')->name('destroy.single.mail');

});

//for users dashboard
Route::group(['prefix' => 'users', 'middleware' => ['auth','verified','users']], function () {
    //for users dashboard all pages views.
    Route::get('dashboard', 'Users\UserController@newOrder')->name('user.neworder');
    Route::get('massorder', 'Users\UserController@massOrder')->name('user.massorder');
    Route::get('services', 'Users\UserController@services')->name('user.services');
    Route::get('funds', 'Users\UserController@funds')->name('user.funds');
    Route::get('faq', 'Users\UserController@faq')->name('user.faq');
    Route::get('tickets', 'Users\UserController@tickets')->name('user.tickets');
    Route::get('terms', 'Users\UserController@terms')->name('user.terms');
    Route::get('news', 'Users\UserController@news')->name('user.news');
    //for orders view //for all orders
    Route::get('orders', 'Users\UserController@orders')->name('user.orders');
    //for pending orders
    Route::get('/status/order/{id}', 'Users\UserController@orderStatus')->name('user.pending.orders');

    //for `account` edit and view
    Route::get('account', 'Users\UserController@account')->name('user.account');
    Route::post('account', 'Users\UserController@update')->name('user.update');

    //for getting data from ajax after category is changed
    Route::get('/find/category/{id}','Users\UserController@getServices')->name('services');

    //for user new orders
    Route::post('dashboard','Users\UserController@storeNewOrder')->name('user.store.neworder');
    //for users mass order
    Route::post('massorder','Users\UserController@storeMassOrder')->name('user.store.massorder');
    //for adding funds
    Route::post('funds','Users\UserController@storeFunds')->name('user.store.funds');
    //for ticket
    Route::post('ticket','Users\UserController@storeTicket')->name('user.store.ticket');
    //for payment of paypal
    Route::get('handle/payment', 'Users\PayPalController@handlePayment')->name('make.payment');
    Route::get('cancel/payment', 'Users\PayPalController@paymentCancel')->name('cancel.payment');
    Route::get('payment/success', 'Users\PayPalController@paymentSuccess')->name('success.payment');
});
