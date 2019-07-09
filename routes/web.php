<?php

Route::get('/', function () {
    return view('home');
});

Route::get('make-payment', 'SkrillPaymentController@makePayment');
Route::get('do-refund', 'SkrillPaymentController@doRefund');
Route::post('ipn', 'SkrillPaymentController@ipn');

Route::get('payment-completed', function () {
    return view('payment-completed');
});
Route::get('payment-cancelled', function () {
    return view('payment-cancelled');
});
