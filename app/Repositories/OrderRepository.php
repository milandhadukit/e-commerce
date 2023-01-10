<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\UserDetail;

class OrderRepository extends BaseRepository
{
    public function addOrder($req)
    {
        $date = Carbon::now();

        $orderData = [
            'user_id' => auth()->user()->id,
            'product_id' => $req['product_id'],
            'date' => $date->format('Y-m-d'),
        ];

        //  dd($orderData);
        $orderAdd = Order::create($orderData);
        return $orderAdd;
    }
    public function cancelOrder($id)
    {
        $orderCencel = [
            'status' => 0,
        ];
        $cancelOrders = Order::find($id);
        $cancelOrders->update($orderCencel);
        return $cancelOrders;
    }
    public function myOrder()
    {
        $myOrder = Order::where('user_id', auth()->user()->id)
            ->where('status', 1)
            ->select('products.id','products.name', 'products.description', 'products.image','orders.date')
            ->join('products', 'products.id', 'orders.product_id')
            ->get();

        return $myOrder;
    }
}
