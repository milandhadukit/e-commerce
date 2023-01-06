<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Product;
use App\Models\Cart;

class CartRepository extends BaseRepository
{
    public function addToCart($req)
    {
        $cartDetails = [
            'quantity' => $req['quantity'],
            'total_price' => $req['total_price'],
            'user_id' => auth()->user()->id,
            'product_id' => $req['product_id'],

        ];
        
        $cartAdd = Cart::create($cartDetails);
        return $cartAdd;
    }
}
