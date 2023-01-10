<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\OrderAdminService;

class OrderAdminController extends Controller
{
    private $orderController;
    public $checkrole;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->orderController = new OrderAdminService();
        return $this->checkrole = auth()->user();
    }

    public function orderList()
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $list = $this->orderController->orderList();
                return $this->sendResponse('success', $list);
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function orderCancelList()
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $listCencel = $this->orderController->orderCancelList();
                return $this->sendResponse('success', $listCencel);
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function serchOrder(Request $request)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $searchList = $this->orderController->serchOrder($request);
                return $this->sendResponse('success', $searchList);
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }
}
