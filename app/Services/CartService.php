<?php

namespace App\Services;
use App\Services\BaseService;
use App\Repositories\CartRepository;

class CartService extends BaseService
{
    private $cartService;
    public function __construct()
    {
         $this->cartService=new CartRepository();
    }   
    public function addToCart($req,$request)
    {
        return  $this->cartService->addToCart($req,$request);
    }
    public function viewCart()
    {
        return  $this->cartService->viewCart();
    }
    public function removeCart($id)
    {
        return $this->cartService->removeCart($id);
    }
    public function updateToCart($req,$request,$id)
    {
        return  $this->cartService->updateToCart($req,$request,$id);
    }
}