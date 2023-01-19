<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

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

        // dd($orderData);
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
        $myOrders = DB::table('orders')
            ->where('orders.user_id', auth()->user()->id)
            ->where('orders.status', 1)
            ->select(
                'products.id',
                'products.name',
                'products.description',
                'payments.price'
            )
            ->join('products', 'products.id', 'orders.product_id')
            ->join('payments', 'payments.user_id', 'orders.user_id')

            ->get();

        return $myOrders;
    }
}

    