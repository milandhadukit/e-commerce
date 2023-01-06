<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Product;
use App\Models\Category;

class CategoryandProductRepositery extends BaseRepository
{
    public function viewCategory()
    {
        $categoryView=Category::all();
        return $categoryView;
    }
    public function viewProduct()
    {
        $product=Product::all();
        return $product;
    }

    public function viewProducOnCategory($id)
    {
        $viewProduct=Product::where('category_id',$id)->get();
        return $viewProduct;  
    }
}