<?php

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
    return view('welcome');
});

Route::get('/payments','PaymentController@formPage');   //Form Page
Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay'); //Payment Informations
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback'); //Redirect back to the shop

//Test
Route::get('/test','PaymentController@inlineTest');

Route::get('/webhoooker', 'PaymentController@charge');
Route::post('/charge/storage','PaymentController@storeCharge');
Route::get('/paystack/verify','PaymentController@verifyingTransaction');

//Verify Transaction

Route::get('transaction/verify','PaymentController@verifyingTransactionView');
Route::get('/transaction/verify/reference','PaymentController@verifyingTransaction');

//Payments
Route::get('transaction/pay','PaymentController@makeTransaction');
Route::post('/transaction/pay','PaymentController@storeTransaction');

//Change Charges
Route::get('/transaction/change','PaymentController@changingCharges');
Route::post('/transaction/change','PaymentController@chargingReturningCustomers');

//Register Card
Route::get('/transaction/addcard','PaymentController@registerCard');
Route::post('/transaction/addcard','PaymentController@storeRegisterCard');

//Charge Card
Route::get('/transaction/chargecard','PaymentController@chargeCard');
Route::post('/transaction/chargecard','PaymentController@storeChargeCard');

//Add Pin
Route::post('/transaction/pin','PaymentController@addPin');

//Add OTP
Route::post('/transaction/otp','PaymentController@addOTP');