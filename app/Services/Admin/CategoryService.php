<?php

namespace App\Services\Admin;
use App\Services\BaseService;
use App\Repositories\Admin\CategoryRepository;

class CategoryService extends BaseService
{
    private $categoryService;
    public function __construct()
    {
         $this->categoryService=new CategoryRepository();
    }

    function addCategory($req)
    {
        return $this->categoryService->addCategory($req);
    }
    function updateCategory($req,$id)
    {
        return $this->categoryService->updateCategory($req,$id);
    }
    function deleteCategory($id)
    {
        return $this->categoryService->deleteCategory($id);
    }
    function categoryLOV()
    {
        return $this->categoryService->categoryLOV();
    }
}