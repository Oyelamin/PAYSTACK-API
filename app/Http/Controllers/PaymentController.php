<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;
use App\Data;
use App\Info;
use App\Http\Requests\InformationsRequest;
use App\Card;
use App\Code;
use App\AttemptedCharge;
use App\Pin;
class PaymentController extends Controller
{

/**======================
 * PAYSTACK PAYMENT FROM BACKEND
 * ===============
 */
  
    public function registerCard(){
      return view('Card.index');
    }
    public function storeRegisterCard(){

      /***=============1st Point=====================
       * First register a card
       * ---------------------------
       */
      $client = new \GuzzleHttp\Client();
      $email = request('email');
      $name = request('name');
      $card_number = request('card_number');
      $cvv = request('cvv');
      $exp_month = request('exp_month');
      $exp_year = request('exp_year');
      $account_number = request('account_number');
      $amount = 50; //Charges in Naira
      //Card INFO
      $data = [
          'email' => $email,
          'card' => ['number' => $card_number, 'cvv' => $cvv, 'expiry_month' => $exp_month, 'expiry_year' => $exp_year]
      ];
      $key = "sk_test_c3081168b45a52053b04c40b4f55bd0da88dcc58";  //Secret Key

      $response = $client->post("https://api.paystack.co/charge/tokenize", [
          'json' => $data,
          'headers' => [
              'Authorization' => 'Bearer ' . $key,
              'Content-Type' => 'application/json'
          ]
      ]);

      $payload = json_decode($response->getBody()->getContents(), true);
      /**==============2nd Point===================
       * If the request fails
       * ------------------------
       */
      if($payload['status'] == false){

        //Display message
        dd($payload['message']);

      }else{  
        /**=========================
         * If no Error is found
         * --------------------
         */
        $data = $payload["data"];
        $authorization_code = $data['authorization_code'];
        $bin = $data['bin'];
        $last4 = $data['last4'];
        $exp_month = $data['exp_month'];
        $exp_year = $data['exp_month'];
        $channel = $data['channel'];
        $card_type = $data['card_type'];
        $bank = $data['bank'];
        $country_code = $data['country_code'];
        $brand = $data['brand'];
        $reusable = $data['reusable'];
        $signature = $data['signature'];
        $customer = json_encode($data['customer']);
        /**======================*
         * Store card details    |
         * ----------------------*
         */
        Card::create([
          'authorization_code' => $authorization_code,
          'bin' => $bin,
          'last4' => $last4,
          'exp_month' => $exp_month,
          'exp_year' => $exp_year,
          'channel' => $channel,
          'card_type' => $card_type,
          'bank' => $bank,
          'country_code' => $country_code,
          'brand' => $brand,
          'reusable' => $reusable,
          'signature' => $signature,
          'customer' => $customer,
          'card_number' => $card_number,
          'cvv' => $cvv,
          'email' => $email
        ]);
          /**====================================*0
           * Verify the Card                     ||
           * @ Requirements                      ||
           *    >>>>>>>>>>>                      ||
           *    + bank.code                      ||
           *    + authorization_code             ||
           *    + email                          ||
           *    + Amount                         ||
           *    + card_number                    ||
           *    + cvv                            ||
           *    + card.expiry_month              ||
           *    + card.expiry_year               ||
           *    + Account_number                 ||
           * ------------------------------------*0
           */
          //If on Test
          $codes = Code::all(); //Get all bank codes

            foreach($codes as $code){
              /**
               * If the bank that is verified is not same as the one from the database...Give it a bank code to continue verifications
               */
              if($code->name == $bank){
                $bank_code = $code->bank_code;
              }else{
                $bank_code = "No Bank Name";
              }
            }
            /**==================Validation==========================
             * Validate if the bank is valid or Not
             * =====================================
             */
          if(isset($bank_code) && !empty($bank_code)){
            //Not on test Mode
            $postdata =  array('authorization_code' => $authorization_code, 'email' => $email,'amount' => $amount, 'card_number' => $card_number,"cvv" => $cvv,'expiry_month' => $exp_month,'expiry_year' => $exp_year,'code' => $bank_code,'account_number'=> $account_number,'amount' => $amount);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://api.paystack.co/charge");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));  //Post Fields
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $key = "sk_test_c3081168b45a52053b04c40b4f55bd0da88dcc58";  //Secret Key
            $card_headers = [
              'Authorization: Bearer '.$key,
              'Content-Type: application/json',
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $card_headers);
            $request = curl_exec ($ch);
            curl_close ($ch);
            if ($request) {
              $result = json_decode($request, true);
              /**====================Last Point==========================
               * Check if the transaction doesn't fail
               * ----------------------------------------
               */

              if($result['status'] == false){
                dd($result['message']);
              }else{
                $att_data = $result['data'];
                $reference = $att_data['reference'];
                $status = $att_data['status'];
                AttemptedCharge::create([
                  'status' => $status,
                  'reference' => $reference
                ]);
                return view('Card.pin')->with('reference',$reference)->with('amount',$amount);
                
              }
            }
          }else{
            /**
             * Test Mode
             */
            $bank_code = 325;
            $postdata =  array('authorization_code' => $authorization_code, 'email' => $email,'amount' => $amount, 'card_number' => $card_number,"cvv" => $cvv,'expiry_month' => $exp_month,'expiry_year' => $exp_year,'code' => $bank_code,'account_number'=> $account_number,'amount' => $amount);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://api.paystack.co/charge");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));  //Post Fields
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $key = "sk_test_c3081168b45a52053b04c40b4f55bd0da88dcc58";  //Secret Key
            $card_headers = [
              'Authorization: Bearer '.$key,
              'Content-Type: application/json',
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $card_headers);
            $request = curl_exec ($ch);
            curl_close ($ch);
            if ($request) {
              $result = json_decode($request, true);
              
              /**=====================Last Point=============================
               * Check if transaction was successful
               * ------------------------------------------
               */
              /**============================Error Validation---------------------
                * Check if their's any Error
              */
              if($result['status'] == false){
                dd($result['message']);
              }else{
                $att_data = $result['data'];
                $reference = $att_data['reference'];
                $status = $att_data['status'];
                AttemptedCharge::create([
                  'status' => $status,
                  'reference' => $reference
                ]);
                return view('Card.pin')->with('reference',$reference)->with('amount',$amount);
                
              }
            }
          }
      }

    }

    // public function chargeCard(){
    //   $codes = Code::all();
    //   $card = Card::latest()->first()->toArray();
    //   return view('Card.charge')->with('card',$card)->with('codes',$codes);
    // }
    public function addpin(){
      /**
       * First Point
       */
      $reference = request('reference');
      $pin = request('pin');
      $otp = request('otp');
       // Pass the customer's authorisation code, email and amount
       $postdata =  array('reference' => $reference,'pin' => $pin); //
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL,"https://api.paystack.co/charge/submit_pin");
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));  //Post Fields
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $key = "sk_test_c3081168b45a52053b04c40b4f55bd0da88dcc58";
       $headers = [
         'Authorization: Bearer '.$key,
         'Content-Type: application/json',
       ];
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       $request = curl_exec ($ch);
       curl_close ($ch);
       if ($request) {
         $result = json_decode($request, true);
         
         /**============================Second Point---------------------
          * Check if their's any Error
          */
        if($result['status'] == false){
          dd($result['message']);
        }else{
          /**
           * Proceed if no Error is found
           */
          $data = $result['data'];
          $pin_reference = $data['reference'];
          $status = $data['status'];
          $display_text = $data['display_text'];
          //Store Pin Message
          Pin::create([
            'reference' => $pin_reference,
            'status' => $status,
            'display_text' => $display_text
          ]);
          /**
           * Process the otp and the transaction
           */
          $otp =  array('reference' => $pin_reference,'otp' => $otp);
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL,"https://api.paystack.co/charge/submit_otp");
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($otp));  //Post Fields
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $key = "sk_test_c3081168b45a52053b04c40b4f55bd0da88dcc58";
          $headers = [
            'Authorization: Bearer '.$key,
            'Content-Type: application/json',
          ];
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          $request = curl_exec ($ch);
          curl_close ($ch);
          if ($request) {
            $result = json_decode($request, true);
            dd($result);
          }
          // return view('Card.otp')->with('reference',$reference);
        }
       }
       
    }
}
