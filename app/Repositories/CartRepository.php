<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Discount;

class CartRepository extends BaseRepository
{
    public function addToCart($req, $request)
    {
        $check = Cart::select('product_id', 'quantity', 'total_price')
            ->where('user_id', auth()->user()->id)
            ->where('product_id', $request->product_id)
            ->first();

        // return $check;
        // dd($check);

        $productPrice = Product::select('price')
            ->where('id', $request->product_id)
            ->first();

        # check discount price
        $discountPrice = Discount::select('discount_price')
            ->where('product_id', $request->product_id)
            ->where('active', 1)
            ->first();
        $qty = $request->quantity;
        $qtryTotal = $productPrice['price'] * $qty;

        if (!empty($discountPrice)) {
            $qtryTotal = $discountPrice['discount_price'] * $qty;
        }

        // dd($checkQty);

        if (empty($check)) {
            $cartDetails = [
                'quantity' => $req['quantity'],
                'total_price' => $qtryTotal,
                'user_id' => auth()->user()->id,
                'product_id' => $req['product_id'],
            ];

            $cartAdd = Cart::create($cartDetails);
            return $cartAdd;
        } else {
            $getQty = $check['quantity'];
            $totalPrice = $check['total_price'];
            $qtyIncrement = $getQty + 1;
            $totalPriceIncrement = $totalPrice * $qtyIncrement;

            $qtyincrement = [
                'quantity' => $qtyIncrement,
                'total_price' => $totalPriceIncrement,
            ];

            $checkQty = Cart::where('user_id', auth()->user()->id)
                ->where('product_id', $request->product_id)
                ->update($qtyincrement);

            return $checkQty;
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
            'carts.total_price'
        )
            ->where('user_id', auth()->user()->id)
            ->join('products', 'products.id', 'carts.product_id')
            ->get();

        return $viewCartDetails;
    }

    public function removeCart($id)
    {
        $removeProduct = Cart::where('product_id', $id)->delete();
        return $removeProduct;

        // if (empty($removeProduct)) {
        //     return null;
        // }
    }
    public function updateToCart($req, $request, $id)
    {
        $productPrice = Product::select('price')
            ->where('id', $id)
            ->first();

        $qty = $request->quantity;
        $qtryTotal = $productPrice['price'] * $qty;

        $cartDetails = [
            'quantity' => $req['quantity'],
            'total_price' => $qtryTotal,
        ];
        $updateProduct = Cart::where('user_id', auth()->user()->id)
            ->where('product_id', $id)
            ->update($cartDetails);
        return $updateProduct;
    }
}
