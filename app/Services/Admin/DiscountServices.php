<?php

namespace App\Services\Admin;
use App\Services\BaseService;
use App\Repositories\Admin\DiscountRepositoty;

class DiscountServices extends BaseService
{
    private $discountServices;
    public function __construct()
    {
        $this->discountServices = new DiscountRepositoty();
    }
    public function addDescount($req)
    {
        return $this->discountServices->addDescount($req);
    }
    public function viewDiscountOnProduct()
    {
        return $this->discountServices->viewDiscountOnProduct();
    }
    public function closeDiscount($id)
    {
        return $this->discountServices->closeDiscount($id);
    }
    public function activeDiscount($id)
    {
        return $this->discountServices->activeDiscount($id);
    }
    public function updateDiscount($id, $req)
    {
        return $this->discountServices->updateDiscount($id, $req);
    }
    public function addDiscountPercentage($req)
    {
        return $this->discountServices->addDiscountPercentage($req);
    }
    public function closeDiscountPercentage($id)
    {
        return $this->discountServices->closeDiscountPercentage($id);
    }
    public function activeDiscountPercentage($id)
    {
        return $this->discountServices->activeDiscountPercentage($id);
    }
    public function viewDiscountPercentage()
    {
        return $this->discountServices->viewDiscountPercentage();
    }
    public function updateDiscountPercentage($req, $id)
    {
        return $this->discountServices->updateDiscountPercentage($req, $id);
    }
    public function viewCoupon()
    {
        return $this->discountServices->viewCoupon();
    }
}
