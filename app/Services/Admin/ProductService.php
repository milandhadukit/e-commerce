<?php

namespace App\Services\Admin;
use App\Services\BaseService;
use App\Repositories\Admin\ProductRepository;

class ProductService extends BaseService
{
    private $productService;
    public function __construct()
    {
        $this->productService = new ProductRepository();
    }
    public function addProduct($req, $imageName)
    {
        return $this->productService->addProduct($req, $imageName);
    }
    public function updateProduct($req, $id)
    {
        return $this->productService->updateProduct($req, $id);
    }
    public function deleleProduct($id)
    {
        return $this->productService->deleleProduct($id);
    }
    public function viewProductByCategory($id)
    {
        return $this->productService->viewProductByCategory($id);
    }
}
