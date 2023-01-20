<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;

class CategoryandProductRepositery extends BaseRepository
{
    public function viewCategory()
    {
        $categoryView = Category::all();

        return $categoryView;
    }

    public function viewProduct($page, $pageLimit)
    {
        // $product = Product::get();
        // return $product;

        $productPrice = Product::select(
            'products.id',
            'products.name',
            // 'products.description',
            'products.image',
            'products.price',
            'discounts.discount_price',
            'discount_percentages.discount_percentage'
            // 'discount_percentages.tc'
        )
            ->leftJoin('discounts', function ($join) {
                $join->on('products.id', '=', 'discounts.product_id');
                $join->where('discounts.active', '=', '1');
            })
            ->leftJoin('discount_percentages', function ($join) {
                $join->on(
                    'products.id',
                    '=',
                    'discount_percentages.product_id'
                );
                $join->where(
                    'discount_percentages.active_percentage',
                    '=',
                    '1'
                );
            })
            ->skip($page)
            ->take($pageLimit)
            ->get();
        return $productPrice;
    }

    public function viewProducOnCategory($id)
    {
        $viewProduct = Product::where('category_id', $id)->get();
        return $viewProduct;
    }

    public function viewSingleProduct($id)
    {
        $viewSingleProduct = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'discount_percentages.tc'
        )
            ->leftJoin('discount_percentages', function ($join) {
                $join->on(
                    'products.id',
                    '=',
                    'discount_percentages.product_id'
                );
                $join->where(
                    'discount_percentages.active_percentage',
                    '=',
                    '1'
                );
            })

            ->where('products.id', $id)

            ->first();
        return $viewSingleProduct;
    }
}
