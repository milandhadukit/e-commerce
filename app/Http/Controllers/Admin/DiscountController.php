<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\DiscountServices;
use Validator;
use Carbon\Carbon;

class DiscountController extends Controller
{
    private $discountController;
    public $checkrole;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->discountController = new DiscountServices();
        return $this->checkrole = auth()->user();
    }

    public function addDescount(Request $request)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $req = $request->all();

                $validator = Validator::make($req, [
                    'name' => 'required|min:2',
                    'product_id' => 'required|exists:products,id',
                ]);
                if ($validator->fails()) {
                    return response()->json(
                        $validator->errors()->toJson(),
                        400
                    );
                }
                $this->discountController->addDescount($req);
                return $this->sendResponse(
                    'success',
                    'Discount successfully Add'
                );
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function viewDiscountOnProduct()
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $viewDiscount = $this->discountController->viewDiscountOnProduct();
                return $this->sendResponse('success', $viewDiscount);
            }

            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function closeDiscount($id)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $this->discountController->closeDiscount($id);
                return $this->sendResponse('success', 'close successfully');
            }

            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }
    public function activeDiscount($id)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $this->discountController->activeDiscount($id);
                return $this->sendResponse('success', 'Active successfully');
            }

            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function updateDiscount($id, Request $request)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $req = $request->all();

                $validator = Validator::make($req, [
                    'name' => 'required|min:2',
                    'product_id' => 'required|exists:products,id',
                ]);
                if ($validator->fails()) {
                    return response()->json(
                        $validator->errors()->toJson(),
                        400
                    );
                }
                $this->discountController->updateDiscount($id, $req);
                return $this->sendResponse('success', 'Update successfully');
            }

            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function addDiscountPercentage(Request $request)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $req = $request->all();

                $validator = Validator::make($req, [
                    'discount_percentage' => 'required|integer|not_in:0',
                    'product_id' => 'required|exists:products,id',
                    'tc'=>'required',
                ]);
                if ($validator->fails()) {
                    return response()->json(
                        $validator->errors()->toJson(),
                        400
                    );
                }
                $this->discountController->addDiscountPercentage($req);
                return $this->sendResponse(
                    'success',
                    'Discount Percentage successfully Add'
                );
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function closeDiscountPercentage($id)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $this->discountController->closeDiscount($id);
                return $this->sendResponse('success', 'close successfully');
            }

            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }
    public function activeDiscountPercentage($id)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $this->discountController->activeDiscountPercentage($id);
                return $this->sendResponse('success', 'Active successfully');
            }

            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function viewDiscountPercentage()
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $viewDiscountData = $this->discountController->viewDiscountPercentage();
                return $this->sendResponse('success', $viewDiscountData);
            }

            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }
    public function updateDiscountPercentage(Request $request,$id)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $req = $request->all();

                $validator = Validator::make($req, [
                    'discount_percentage' => 'required|integer|not_in:0',
                    'tc'=>'required',
                ]);
                if ($validator->fails()) {
                    return response()->json(
                        $validator->errors()->toJson(),
                        400
                    );
                }
                $this->discountController->updateDiscountPercentage($req,$id);
                return $this->sendResponse(
                    'success',
                    'Discount Percentage successfully Update'
                );
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }



}
