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
    public function addToCart($req)
    {
        return  $this->cartService->addToCart($req);
    }
}