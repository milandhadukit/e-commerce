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
    public function viewProduct( $page, $pageLimit)
    {
        return $this->categoryProductService->viewProduct( $page, $pageLimit);
    }
    public function viewProducOnCategory($id)
    {

        return $this->categoryProductService->viewProducOnCategory($id);
    }
    public function viewSingleProduct($id)
    {
        return $this->categoryProductService->viewSingleProduct($id);
    }
}