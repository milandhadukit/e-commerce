<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use App\Services\Admin\CategoryService;

class CategoryController extends Controller
{
    private $categoryController;
    public $checkrole;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->categoryController = new CategoryService();
        return $this->checkrole = auth()->user();
    }

    public function addCategory(Request $request)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $req = $request->all();

                $validator = Validator::make($req, [
                    'name' => 'required|min:1',
                    'description' => 'required',
                    // 'state' => 'required|regex:/^[a-zA-Z ]+$/',
                    // 'city' => 'required|regex:/^[a-zA-Z ]+$/',
                    // 'area' => 'required|regex:/^[a-zA-Z ]+$/',
                    // 'candidates' => 'required',
                    // 'end_date' => 'required|after_or_equal:today',
                ]);
                if ($validator->fails()) {
                    return response()->json(
                        $validator->errors()->toJson(),
                        400
                    );
                }
                $this->categoryController->addCategory($req);
                return $this->sendResponse(
                    'success',
                    'Category successfully Add'
                );
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }


    public function updateCategory(Request $request,$id)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                $req = $request->all();

                $validator = Validator::make($req, [

                  
                    'name'=>'required',
                    'description' => 'required',
                    
                ]);
                if ($validator->fails()) {
                    return response()->json(
                        $validator->errors()->toJson(),
                        400
                    );
                }
                $this->categoryController->updateCategory($req,$id);
                return $this->sendResponse(
                    'success',
                    'Category successfully Update'
                );
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }


public function deleteCategory($id)
    {
        try {
            if ($this->checkrole->role == 'Admin') {
                
                $this->categoryController->deleteCategory($id);
                return $this->sendResponse(
                    'success',
                    'Category successfully Delete'
                );
            }
            return $this->sendError('sorry', 'invalid Login');
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }

    public function categoryLOV()
    {
        try {
           $data= $this->categoryController->categoryLOV();
            return $this->sendResponse(
                'success',
                $data,
            );
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage());
        }
    }



}   
