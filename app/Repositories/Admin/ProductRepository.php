<?php
namespace App\Repositories\Admin;
use App\Repositories\BaseRepository;
use App\Models\Product;

class ProductRepository extends BaseRepository
{

    public function addProduct($req)
    {


        $productData = [

            'name' => $req['name'],
            'description' => $req['description'],
            'price'=>$req['price'],
            'category_id'=>$req['category_id'],
        
        ];
        
        $productAdd = Product::create($productData);
        return $productAdd;
    }
    public function updateProduct($req,$id)
    {

        $productData = [

            'name' => $req['name'],
            'description' => $req['description'],
            'price'=>$req['price'],
            'category_id'=>$req['category_id'],
        
        ];
        $productUpdate=Product::find($id);
        $productUpdate->update($productData);
        return $productUpdate;
    }
    public function deleleProduct($id)
    {
        $deleteProduct=Product::find($id);
        $deleteProduct->delete();
        return $deleteProduct;

    }
    public function viewProductByCategory($id)
    {
        $viewProduct=Product::where('category_id',$id)->get();
        return $viewProduct;    
    }   

}