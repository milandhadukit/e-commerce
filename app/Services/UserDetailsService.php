<?php

namespace App\Services;
use App\Services\BaseService;
use App\Repositories\UserDetailsRepository;

class UserDetailsService extends BaseService
{
    private $userDetailService;
    public function __construct()
    {
         $this->userDetailService=new UserDetailsRepository();
    }
    public function addUserDetails($req)
    {
        return  $this->userDetailService->addUserDetails($req);
    }
    public function viewOrderDetailsUser()
    {
        return  $this->userDetailService->viewOrderDetailsUser();
    }
    public function updateUserDetails($req,$id)
    {
        return  $this->userDetailService->updateUserDetails($req,$id);
    }
}