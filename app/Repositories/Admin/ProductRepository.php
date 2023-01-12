<?php
namespace App\Repositories\Admin;
use App\Repositories\BaseRepository;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductRepository extends BaseRepository
{
    public function addProduct($req, $imageName)
    {
        //$imageName pass to controler
        $req['image']->move(public_path('/product_image'), $imageName);

        $productData = [
            'name' => $req['name'],
            'description' => $req['description'],
            'price' => $req['price'],
            'category_id' => $req['category_id'],
            'image' => $imageName,
        ];
        // dd($productData);
        $productAdd = Product::create($productData);
        return $productAdd;
    }
    public function updateProduct($req, $id)
    {
      

        $databaseimage=Product::select('image')->where('id','=',$id)->first();
        //  $value=$databaseimage['image'];
     

        $imagePath = public_path('product_image/'. $databaseimage['image']);

        //   dd($imagePath);
            if(File::exists($imagePath)){
                unlink($imagePath);
            }

            $imageName = time() . '.' . $req['image']->getClientOriginalExtension();
            $req['image']->move(public_path('/product_image'), $imageName);
    
        $productData = [
            'name' => $req['name'],
            'description' => $req['description'],
            'price' => $req['price'],
            'category_id' => $req['category_id'],
            'image' => $imageName,
        ];
        $productUpdate = Product::find($id);
        // dd($productUpdate);
        $productUpdate->update($productData);
        return $productUpdate;
    }
    public function deleleProduct($id)
    {
        $deleteProduct = Product::find($id);
        $deleteProduct->delete();
        return $deleteProduct;
    }
    public function viewProductByCategory($id)
    {
        $viewProduct = Product::where('category_id', $id)->get();
        return $viewProduct;
    }
    public function productLOV()
    {
        $product=Product::all();
        return $product;
    }
}
