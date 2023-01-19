<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Services\UserDetailsService;

class UserDetailController extends Controller
{
    private $userDetailController;

    public function __construct()
    {
        // $this->middleware('auth:api');
        $this->middleware('auth');
        $this->userDetailController = new UserDetailsService();
    }

    public function addUserDetails(Request $request)
    {
        try {
            $req = $request->all();

            $validator = Validator::make($req, [
                'name' => 'required|min:2|regex:/^[a-zA-Z ]+$/',
                'state' => 'required|regex:/^[a-zA-Z ]+$/',
                'city' => 'required|regex:/^[a-zA-Z ]+$/',
                'address' => 'required',
                'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'pin-code' => 'required|min:6|max:6',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $this->userDetailController->addUserDetails($req);
            // return $this->sendResponse('success', 'UserDetails successfully Add');
            return redirect()
                ->route('payment-detail')
                ->with('success', 'UserDetails successfully Add');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function viewOrderDetailsUser()
    {
        try {
            $OrderDetails = $this->userDetailController->viewOrderDetailsUser();

            // return $this->sendResponse('success', $OrderDetails);
            return view('view_order_address', compact('OrderDetails'));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function editAddress($id)
    {
        $userDetails = UserDetail::find($id);
        return view('edit_address', compact('userDetails'));
    }

    public function updateUserDetails(Request $request, $id)
    {
        try {
            $req = $request->all();

            $validator = Validator::make($req, [
                'name' => 'required|min:2|regex:/^[a-zA-Z ]+$/',
                'state' => 'required|regex:/^[a-zA-Z ]+$/',
                'city' => 'required|regex:/^[a-zA-Z ]+$/',
                'address' => 'required',
                'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'pin-code' => 'required|min:6|max:6',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }
            $this->userDetailController->updateUserDetails($req, $id);
            // return $this->sendResponse('success', 'UserDetails successfully Add');

            return redirect()->route('view.detail')->with(
                'success',
                ' successfully Change'
            );
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }
}
