<?php

namespace App\Services;
use App\Services\BaseService;
use App\Repositories\CategoryandProductRepositery;

class CategoryandProductService extends BaseService
{
    private $categoryProductService;
    public function __construct()
    {
         $this->categoryProductService=new CategoryandProductRepositery();
    }
    public function viewCategory()
    {
        return $this->categoryProductService->viewCategory();
    }
    public function viewProduct()
    {
        return $this->categoryProductService->viewProduct();
    }
    public function viewProducOnCategory($id)
    {

        return $this->categoryProductService->viewProducOnCategory($id);
    }
}