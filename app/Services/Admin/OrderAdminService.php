<?php

namespace App\Services\Admin;
use App\Services\BaseService;
use App\Repositories\Admin\OrderAdminRepository;

class OrderAdminService extends BaseService
{
    private $orderService;
    public function __construct()
    {
        $this->orderService = new OrderAdminRepository();
    }

    public function orderList()
    {
        return $this->orderService->orderList();
    }
    public function orderCancelList()
    {
        return $this->orderService->orderCancelList();
    }
    public function serchOrder($request)
    {
        return $this->orderService->serchOrder($request);
    }
}
