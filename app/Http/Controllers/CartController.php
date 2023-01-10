<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Services\CartService;

class CartController extends Controller
{
    private $cartController;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->cartController = new CartService();
    }


    public function addToCart(Request $request)
    {
        try {
            $req = $request->all();

            $validator = Validator::make($req, [
                'quantity' => 'required',
                'total_price' => 'required',
                'product_id'=>'required|exists:products,id',
               
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $this->cartController->addToCart($req,$request);
            return $this->sendResponse('success', 'Add Cart  successfully Add');

           
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function viewCart(Request $request)
    {
        try {
        
           $viewCart= $this->cartController->viewCart();
            return $this->sendResponse('success',   $viewCart);

           
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function removeCart($id)
    {
        try {
        
           $this->cartController->removeCart($id);
            return $this->sendResponse('success', 'Remove Product');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }


}
