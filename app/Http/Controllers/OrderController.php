<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use Validator;
use App\Models\UserDetail;
use App\Models\Order;

use Razorpay\Api\Api;
use Session;
use Exception;
use App\Models\Payment;
use Carbon\Carbon;

class OrderController extends Controller
{
    private $orderController;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->orderController = new OrderService();
    }

    public function addOrder(Request $request)
    {
        try {
            $req = $request->all();

            $validator = Validator::make($req, [
                
                'product_id'=>'required|exists:products,id',
               
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            $checkDetails= UserDetail::where('user_id',auth()->user()->id)->first();
            if(empty($checkDetails))
            {
                return $this->wrongPass('sorry', 'plz fullfill Details');
     
            }
         
            $this->orderController->addOrder($req,$request);
            return $this->sendResponse('success', 'Order Successfully ');

           
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }
   

    public function cancelOrder(Request $request,$id)
    {
        try {
            $req = $request->all();

            $validator = Validator::make($req, [
                
                // 'product_id'=>'required|exists:products,id',
               
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            $checkorder = Order::where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->where('status', 1)
            ->first();


            if (empty($checkorder)) {
                return $this->wrongPass('sorry', 'No data found');
            }
        
            $this->orderController->cancelOrder($id);
            return $this->sendResponse('success', 'Order Successfully Cancel ');

           
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function myOrder()
    {
        try{
           $order= $this->orderController->myOrder();
           
           return $this->sendResponse('success', $order);

        }
        catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
        
    }

   

     # web run 
    public function index()
    {        
        return view('razorpayView');
    }

    # web run rezorpay
    // public function orderPayment(Request $request) 
    // {

    //     $input = $request->all();
    
    //     $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    //     //  $api = new Api('pay_L24IFZlskMWlW2','UrsdFYtpwiNyQ1u5xzia4H9o');
        
    //     $payment = $api->payment->fetch($input['razorpay_payment_id']);
    //     if(count($input)  && !empty($input['razorpay_payment_id'])) {
    //         try {
    //             $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
  
    //         } catch (Exception $e) {
    //             return  $e->getMessage();
    //             // Session::put('error',$e->getMessage());
    //             // return redirect()->back();
    //         }
    //     }
    //     Session::put('success', 'Payment successful');
    //     // return redirect()->back();
    // }


    # stripe payment 
    //  public function orderPaymentApi(Request $request)
    // {
    //     try{
         
 
    //      }
    //      catch (\Exception $e) {
    //          return $this->sendError('error', $e->getMessage());
    //      }

    // }


}
