<?php

namespace App\Services;
use App\Services\BaseService;
use App\Repositories\OrderRepository;

class OrderService extends BaseService
{
    private $orderService;
    public function __construct()
    {
         $this->orderService=new OrderRepository();
    } 

    public function addOrder($req)
    {
        return  $this->orderService->addOrder($req);
    }
    public function cancelOrder($id)
    {
        return  $this->orderService->cancelOrder($id);
    }
    public function myOrder()
    {
        return  $this->orderService->myOrder();
    }
}