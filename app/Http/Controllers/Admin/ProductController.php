<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ProductService;
use Validator;
use App\Models\Product;

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
                    'category_id' => 'required|exists:categories,id',
                ]);
                $request->validate(
                    [
                        'image' => 'required',
                    ],
                    [
                        'image.required' => 'Plz Select Image',
                    ]
                );

                $imageName =
                    time() .
                    '.' .
                    $request->image->getClientOriginalExtension();
                if ($validator->fails()) {
                    return response()->json(
                        $validator->errors()->toJson(),
                        400
                    );
                }

                $this->productController->addProduct($req, $imageName);
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

    public function updateProduct(Request $request, $id)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $req = $request->all();

                $validator = Validator::make($req, [
                    'name' => 'required|min:1',
                    'description' => 'required',
                    'price' => 'required|numeric|gt:0',
                    'category_id' => 'required|exists:categories,id',
                    'image' => 'required',
                ]);
                // $imageName = time().'.'.$request->image->getClientOriginalExtension();
                if ($validator->fails()) {
                    return response()->json(
                        $validator->errors()->toJson(),
                        400
                    );
                }

                $checkId = Product::where('id', $id)->first();
                if (empty($checkId)) {
                    return $this->noAvailable('sorry', 'Not Found');
                }

                $this->productController->updateProduct($req, $id);
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
                $checkId = Product::where('id', $id)->first();
                if (empty($checkId)) {
                    return $this->noAvailable('sorry', 'Not Found');
                }
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
                $view = $this->productController->viewProductByCategory($id);
                return $this->sendResponse('success', $view);
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }
    public function productLOV()
    {
        try {
            $view = $this->productController->productLOV();
            return $this->sendResponse('success', $view);
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }
}
