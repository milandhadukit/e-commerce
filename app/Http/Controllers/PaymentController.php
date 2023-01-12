<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Session;
use Stripe;
use App\Models\Payment;
use Carbon\Carbon;
use App\Models\UserDetail;
use App\Models\DiscountPercentage;
use App\Models\Product;

class PaymentController extends Controller
{
    private $stripe;
    public function __construct()
    {
        // $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));
        $this->middleware('auth:api');
        $this->stripe = new StripeClient(
            'sk_test_51MObnySHLo1SypL9kQvmnrRaFYVvrgmzh5SzzQp0nfe8la1kwqBplAjAkvwVUYivRSlTwG1JLCpLzUcDQOC1hKlq00pL9akIqT'
        );
    }

    public function index()
    {
        return view('payment');
    }

    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'cardNumber' => 'required|integer|min:12',
            'month' => 'required|max:2',
            'year' => 'required|min:4',
            'cvv' => 'required|max:3',
            'price' => 'required|integer',
            'product_id' => 'required|exists:products,id',
        ]);
        $mytime = Carbon::now();
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $token = $this->createToken($request);

        if (!empty($token['error'])) {
            return $this->wrongPass('danger', $token['error']);
        }
        if (empty($token['id'])) {
            return $this->wrongPass('danger', 'Payment failed.');
        }

        $charge = $this->createCharge($token['id'], $request->price);

        $paymentToken = $token->toArray();

        $checkDetails = UserDetail::where(
            'user_id',
            auth()->user()->id
        )->first();
        if (empty($checkDetails)) {
            return $this->wrongPass('sorry', 'plz fullfill Order Details ');
        }

        $couponCode = DiscountPercentage::select(
            'coupon',
            'discount_percentage'
        )
            ->where('coupon', $request->coupon)
            ->where('active_percentage',1)
            ->first();
        $productPrice = Product::select('price')
            ->where('id', $request->product_id)
            ->first();
        $prices = $request->price;
        if (isset($couponCode['coupon'])) {
            $price =
                ($couponCode['discount_percentage'] * $productPrice['price']) /
                100;

            $prices = $productPrice['price'] - $price;
        }

        Payment::create([
            'user_id' => auth()->user()->id,
            'card_number' => $request['cardNumber'],
            'token_id' => $paymentToken['id'],
            'price' => $prices,
            'product_id' => $request->product_id,
            'date' => $mytime->format('Y-m-d H:i:s'),
        ]);

        return $this->sendResponse('success', 'Payment completed ');
    }

    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv'],
                ],
            ]);
        } catch (\CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount)
    {
        $charge = null;
        try {
            $charge = $this->stripe->charges->create([
                'amount' => $amount,
                'currency' => 'amd',
                'source' => $tokenId,
                'description' => 'order payment',
            ]);

            //inr
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }

    // -------------------------------------------------------------------------------------

    // public function stripe()
    // {
    //     return view('stripe');
    // }

    // public function stripePost(Request $request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //         Charge::create ([
    //             "amount" => 100 * 100,
    //             "currency" => "usd",
    //             "source" => $request->stripeToken,
    //             "description" => "Test payment "
    //     ]);

    //     Session::flash('success', 'Payment successful!');

    //     return back();
    // }
}
