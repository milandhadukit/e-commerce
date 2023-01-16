<?php

namespace App\Http\Controllers;

use App\Models\CustomerReview;
use Illuminate\Http\Request;
use App\Services\CustomerReviewService;
use Validator;

class CustomerReviewController extends Controller
{
    private $customerReviewService;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->customerReviewService = new CustomerReviewService();
    }
    public function addCustomerReview(Request $request)
    {
        try {
            $req = $request->all();

            $validator = Validator::make($req, [
                'product_id' => 'required|exists:products,id',
                'rating' => 'nullable|integer|max:5|min:1',
                // 'comment'=>'sometimes|required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            $this->customerReviewService->addCustomerReview($req);
            return $this->sendResponse('success', 'Review Successfully ');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function updateCustomerReview(Request $request, $id)
    {
        try {
            $req = $request->all();

            $validator = Validator::make($req, [
                // 'product_id'=>'required|exists:products,id',
                'rating' => 'nullable|integer|max:5|min:1',
                
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $checkId = CustomerReview::where('id', $id)->first();
            if (empty($checkId)) {
                return $this->noAvailable('sorry', 'Not Found');
            }

            $this->customerReviewService->updateCustomerReview($req, $id);
            return $this->sendResponse('success', 'Review Successfully Update');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }


    public function deleteCustomerReview($id)
    {
        try {
            $checkId = CustomerReview::where('id', $id)->first();
            if(empty($checkId))
            {
                return $this->noAvailable('sorry','Not Found');
            }
            $category = $this->customerReviewService->deleteCustomerReview($id);
            return $this->sendResponse('success', $category);
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function viewMyReview()
    {
        try {
           
            $viewMyReview = $this->customerReviewService->viewMyReview();
            return $this->sendResponse('success', $viewMyReview);
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }

    }
     
    
}
