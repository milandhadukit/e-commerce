<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\ReviewCustomerService;
use App\Models\CustomerReview;

class ReviewCustomerController extends Controller
{
    private $reviewCustomerController;
    public $checkrole;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->reviewCustomerController = new ReviewCustomerService();
        return $this->checkrole = auth()->user();
    }

    public function viewReview()
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $view = $this->reviewCustomerController->viewReview();
                return $this->sendResponse('success', $view);
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function deleteReview($id)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $checkId = CustomerReview::where('id', $id)->first();
                if (empty($checkId)) {
                    return $this->noAvailable('sorry', 'Not Found');
                }
                $this->reviewCustomerController->deleteReview($id);
                return $this->sendResponse('success', 'Delete Successfully');
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }
}
