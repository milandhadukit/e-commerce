<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CategoryandProductService;
use App\Models\Discount;

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

    // public function viewProducts()
    // {

    //     return view('view_product');
    // }

    //view product listing & pagination manage
    public function viewProduct(Request $request)
    {
        try {
            // $page= $request['page'];
            // $perPage=$request['perPage'];

            $pageNumber =
                isset($request['page']) && !empty($request['page'])
                    ? $request['page']
                    : 1;
            $pageLimit =
                isset($request['perPage']) && !empty($request['perPage'])
                    ? $request['perPage']
                    : 5;
            $page = ($pageNumber - 1) * $pageLimit;

            $product = $this->categoryProductController->viewProduct(
                $page,
                $pageLimit
            );
            // return $this->sendResponse('success', $product);

            $discountPrice = Discount::select('product_id')
                ->where('active', 1)
                ->get();

            return view('view_product', compact('product', 'discountPrice'));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function viewProducOnCategory($id)
    {
        try {
            $checkCategory = Category::where('id', $id)->first();

            if (empty($checkCategory)) {
                return $this->noAvailable('sorry', 'No Category Found');
            }

            $checkCategoryProduct = Product::where('category_id', $id)->first();
            if (empty($checkCategoryProduct)) {
                return $this->sendResponse('success', 'No Product Found');
            }

            $viewProducOnCategory = $this->categoryProductController->viewProducOnCategory(
                $id
            );

            return $this->sendResponse('success', $viewProducOnCategory);
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function viewSingleProduct($id)
    {
        try {
            $viewSingleProduct = Product::where('id', $id)->first();
            if (empty($viewSingleProduct)) {
                return $this->noAvailable('sorry', 'Not Found');
            }
            $singleView = $this->categoryProductController->viewSingleProduct(
                $id
            );
            // return $this->sendResponse('success', $singleView);

            return view('view_single_productDetails',compact('singleView'));


        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }
}
