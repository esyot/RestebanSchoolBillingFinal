<?php
    
namespace App\Http\Controllers;
     
use Illuminate\Http\Request;
use App\Jobs\SendPaymentSentEmail;
use Session;
use Stripe;
use App\Models\Payment;
     
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request, $id)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => "php",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
      
        Session::flash('success', 'Payment successful!');

        $payment = Payment::create([

            'account_id' => $id,
            'date'=> now(),
            'amount_paid' => $request->amount,
           
        ]);

        $data = [
          'email'=>$request->email,
          'name'=>$request->name,
          'amount'=>$request->amount,

        ];
        
        SendPaymentSentEmail::dispatch($data);

        return back();
    }
}