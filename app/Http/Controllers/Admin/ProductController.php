<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ProductService;
use Validator;

class ProductController extends Controller
{
    private $productController;
    public $checkrole;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->productController = new ProductService();
        return $this->checkrole = auth()->user();
    }
    public function addProduct(Request $request)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $req = $request->all();

                $validator = Validator::make($req, [
                    'name' => 'required|min:1',
                    'description' => 'required',
                    'price' => 'required|numeric|gt:0',
                    'category_id'=>'required|exists:categories,id',
                   
                ]);
                if ($validator->fails()) {
                    return response()->json(
                        $validator->errors()->toJson(),
                        400
                    );
                }
                $this->productController->addProduct($req);
                return $this->sendResponse(
                    'success',
                    'Product successfully Add'
                );
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }   
    }

    public function updateProduct(Request $request,$id)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $req = $request->all();

                $validator = Validator::make($req, [
                    'name' => 'required|min:1',
                    'description' => 'required',
                    'price' => 'required|numeric|gt:0',
                    'category_id'=>'required|exists:categories,id',
                   
                ]);
                if ($validator->fails()) {
                    return response()->json(
                        $validator->errors()->toJson(),
                        400
                    );
                }
                $this->productController->updateProduct($req,$id);
                return $this->sendResponse(
                    'success',
                    'Product successfully Update'
                );
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }   
    }

    public function deleleProduct($id)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                
                $this->productController->deleleProduct($id);
                return $this->sendResponse(
                    'success',
                    'Product successfully Delete'
                );
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }
    
    //view product based on category
    public function viewProductByCategory($id)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                
                $view= $this->productController->viewProductByCategory($id);
                return $this->sendResponse(
                    'success',
                    $view,
                );
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

}
