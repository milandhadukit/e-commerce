<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Product;
use App\Models\Cart;

class CartRepository extends BaseRepository
{
    public function addToCart($req, $request)
    {
        $check = Cart::select('product_id')
            ->where('user_id', auth()->user()->id)
            ->where('product_id', $request->product_id)
            ->first();
        // return $check;
        // dd($check);

        $productPrice = Product::select('price')
            ->where('id', $request->product_id)
            ->first();

        $qty = $request->quantity;
        $qtryTotal = $productPrice['price'] * $qty;

        //   dd($qtryTotal);

        if (empty($check)) {
            $cartDetails = [
                'quantity' => $req['quantity'],
                'total_price' => $qtryTotal,
                'user_id' => auth()->user()->id,
                'product_id' => $req['product_id'],
            ];
           
            $cartAdd = Cart::create($cartDetails);
            return $cartAdd;
        }
    }

    public function viewCart()
    {
        $viewCartDetails = Cart::select(
            'carts.product_id',
            'products.name',
            'products.description',
            'products.image',
            'carts.quantity',
            'carts.total_price',
        )
            ->where('user_id', auth()->user()->id)
            ->join('products', 'products.id', 'carts.product_id')
            ->get();

        return $viewCartDetails;
    }

    public function removeCart($id)
    {
        $removeProduct = Cart::where('user_id', auth()->user()->id)->find($id);

        if (empty($removeProduct)) {
            return null;  
        }
        $removeProduct->delete();
        return $removeProduct;
    }
}
