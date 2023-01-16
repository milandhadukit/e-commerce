<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use App\Services\Admin\CategoryService;
use App\Models\Category;

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
                $checkId=Category::where('id',$id)->first();
                if (empty($checkId)) {
                    return $this->noAvailable('sorry', 'Not Found');
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
                $checkId=Category::where('id',$id)->first();
                if (empty($checkId)) {
                    return $this->noAvailable('sorry', 'Not Found');
                }
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
