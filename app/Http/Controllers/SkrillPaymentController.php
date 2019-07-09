<?php

namespace App\Http\Controllers;

use App\SkrillPayment;
use Illuminate\Http\Request;
use Obydul\LaraSkrill\SkrillClient;
use Obydul\LaraSkrill\SkrillRequest;
use Redirect;

class SkrillPaymentController extends Controller
{
    /**
     * Make Skrill Payment
     */
    public function makePayment()
    {
        // Create object instance of SkrillRequest
        $request = new SkrillRequest();
        $request->transaction_id = 'MNPTTX0001'; // generate transaction id
        $request->amount = '10.26';
        $request->currency = 'USD';
        $request->language = 'EN';
        $request->prepare_only = '1';
        $request->merchant_fields = 'site_name, customer_email';
        $request->site_name = 'Your Website';
        $request->customer_email = 'customer@mynotepaper.com';
        $request->detail1_description = 'Product ID:';
        $request->detail1_text = '101';

        // Create object instance of SkrillClient
        $client = new SkrillClient($request);
        $sid = $client->generateSID(); //return SESSION ID

        // handle error
        $jsonSID = json_decode($sid);
        if ($jsonSID != null && $jsonSID->code == "BAD_REQUEST")
            return $jsonSID->message;

        // do the payment
        $redirectUrl = $client->paymentRedirectUrl($sid); //return redirect url
        return Redirect::to($redirectUrl); // redirect user to Skrill payment page
    }

    /**
     * Do Refund
     */
    public function doRefund()
    {
        // Create object instance of SkrillRequest
        $prepare_refund_request = new SkrillRequest();
        $prepare_refund_request->transaction_id = 'MNPTTX0001';
        $prepare_refund_request->amount = '5.56';
        $prepare_refund_request->refund_note = 'Product no longer in stock';
        $prepare_refund_request->merchant_fields = 'site_name, customer_email';
        $prepare_refund_request->site_name = 'Your Website';
        $prepare_refund_request->customer_email = 'customer@example.com';

        // do prepare refund request
        $client_prepare_refund = new SkrillClient($prepare_refund_request);
        $refund_prepare_response = $client_prepare_refund->prepareRefund(); // return sid or error code

        // refund requests
        $refund_request = new SkrillRequest();
        $refund_request->sid = $refund_prepare_response;

        // do refund
        $client_refund = new SkrillClient($refund_request);
        $do_refund = $client_refund->doRefund();
        var_dump($do_refund); // display response
    }

    /**
     * Instant Payment Notification (IPN) from Skrill
     */
    public function ipn(Request $request)
    {
        // skrill data - get more fields from Skrill Quick Checkout Integration Guide 7.9 (page 23)
        $transaction_id = $request->input('transaction_id');
        $mb_transaction_id = $request->input('mb_transaction_id');
        $invoice_id = $request->input('invoice_id'); // custom field
        $order_from = $request->input('order_from'); // custom field
        $customer_email = $request->input('customer_email'); // custom field
        $biller_email = $request->input('pay_from_email');
        $customer_id = $request->input('customer_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $status = $request->input('status');

        // status message
        if ($status == '-2') {
            $status_message = 'Failed';
        } else if ($status == '2') {
            $status_message = 'Processed';
        } else if ($status == '0') {
            $status_message = 'Pending';
        } else if ($status == '-1') {
            $status_message = 'Cancelled';
        }

        // now store data to database
        $skrill_ipn = new SkrillPayment();
        $skrill_ipn->transaction_id = $transaction_id;
        $skrill_ipn->mb_transaction_id = $mb_transaction_id;
        $skrill_ipn->invoice_id = $invoice_id;
        $skrill_ipn->order_from = $order_from;
        $skrill_ipn->customer_email = $customer_email;
        $skrill_ipn->biller_email = $biller_email;
        $skrill_ipn->customer_id = $customer_id;
        $skrill_ipn->amount = $amount;
        $skrill_ipn->currency = $currency;
        $skrill_ipn->status = $status_message;
        $skrill_ipn->created_at = Date('Y-m-d H:i:s');
        $skrill_ipn->updated_at = Date('Y-m-d H:i:s');
        $skrill_ipn->save();
    }
}
