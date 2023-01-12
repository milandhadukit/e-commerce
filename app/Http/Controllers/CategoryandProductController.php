<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryandProductService;

class CategoryandProductController extends Controller
{
    private $categoryProductController;

    public function __construct()
    {
        $this->categoryProductController = new CategoryandProductService();
    }
    public function viewCategory()
    {
        try {
            $category = $this->categoryProductController->viewCategory();
            return $this->sendResponse('success', $category);
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function viewProduct()
    {
        try {
            $product = $this->categoryProductController->viewProduct();
            return $this->sendResponse('success', $product);
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function viewProducOnCategory($id)
    {
        try {
            $viewProducOnCategory = $this->categoryProductController->viewProducOnCategory(
                $id
            );
            return $this->sendResponse('success', $viewProducOnCategory);
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }
}
