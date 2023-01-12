<?php
namespace App\Repositories\Admin;
use App\Repositories\BaseRepository;
use App\Models\Order;
use App\Models\Product;

class OrderAdminRepository extends BaseRepository
{
    private $orderRepoitory;
    public function __construct()
    {
        $this->orderRepoitory = new Order();
    }
    public function orderList()
    {
        $viewList = $this->orderRepoitory

            ->where('status', 1)
            ->select(
                'orders.id',
                'products.name',
                'products.description',
                'products.image',
                'orders.date'
            )
            ->join('products', 'products.id', 'orders.product_id')
            ->get();
        return $viewList;
    }
    public function orderCancelList()
    {
        $cencelList = $this->orderRepoitory
            ->where('status', 0)
            ->select(
                'orders.id',
                'products.name',
                'products.description',
                'products.image',
                'orders.date'
            )
            ->join('products', 'products.id', 'orders.product_id')
            ->get();
        return $cencelList;
    }
    public function serchOrder($request)
    {
        $searchData = $this->orderRepoitory
            ->select(
                'orders.id',
                'products.name',
                'products.description',
                'products.image',
                'orders.date'
            )
            ->join('products', 'products.id', 'orders.product_id')
            ->where('products.name', 'like', '%' . $request->search . '%')

            ->get();
        return $searchData;
    }
}
