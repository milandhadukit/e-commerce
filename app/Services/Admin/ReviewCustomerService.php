<?php

namespace App\Services\Admin;
use App\Services\BaseService;
use App\Repositories\Admin\ReviewCustomerRepository;

class ReviewCustomerService extends BaseService
{
    private $reviewCustomerRepository;
    public function __construct()
    {
        $this->reviewCustomerRepository = new ReviewCustomerRepository();
    }
    public function viewReview()
    {
        return  $this->reviewCustomerRepository->viewReview();
    }
    public function deleteReview($id)
    {
        return  $this->reviewCustomerRepository->deleteReview($id);
    }
}   