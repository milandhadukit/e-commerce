<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Services\CartService;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    private $cartController;

    public function __construct()
    {
        // $this->middleware('auth:api');
        $this->middleware('auth');
        $this->cartController = new CartService();
    }

    public function addCartForm()
    {
        return view('addtocart');
    }

    public function addToCart(Request $request)
    {
        try {
            $req = $request->all();

            $validator = Validator::make($req, [
                'quantity' => 'required',
                'product_id' => 'required|exists:products,id',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            $this->cartController->addToCart($req, $request);

            // return $this->sendResponse('success', 'Add Cart  successfully Add');
            return redirect()->route('view-cart');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function viewCart(Request $request)
    {
        try {
            $viewCart = $this->cartController->viewCart();
            // return $this->sendResponse('success',   $viewCart);

            $totalData = DB::table('carts')
                ->where('user_id', auth()->user()->id)
                ->select(
                    DB::raw('count(id) as id'),
                    DB::raw('sum(total_price) as total')
                )
                ->get()
                ->toArray();
            // dd($totalData[0]->id,$totalData[0]->total);
            return view('view_cart', compact('viewCart', 'totalData'));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function removeCart($id)
    {
        try {
            $this->cartController->removeCart($id);
            // return $this->sendResponse('success', 'Remove Product');
            return redirect()
                ->back()
                ->with('success', 'Remove Cart Product');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function editCart($id)
    {
        $edit = Cart::where('product_id', $id)->first();

        // $edit=$editCartProduct['product_id'];
        return view('update_cart', compact('edit'));
    }

    public function updateToCart(Request $request, $id)
    {
        // try {
        $req = $request->all();

        $validator = Validator::make($req, [
            'quantity' => 'required|numeric|gt:0',
            // 'product_id' => 'required|exists:products,id',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $this->cartController->updateToCart($req, $request, $id);

        // return $this->sendResponse('success', '  successfully update');
        return redirect()
            ->route('view-cart')
            ->with('success', 'Update Cart');

        // } catch (\Exception $e) {
        //     return $this->sendError('error', $e->getMessage());
        // }
    }
}
