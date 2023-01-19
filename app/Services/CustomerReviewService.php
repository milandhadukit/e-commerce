<?php

namespace App\Services;
use App\Services\BaseService;
use App\Repositories\CustomerReviewRepository;

class CustomerReviewService extends BaseService
{
    private $customerReviewRepository;
    public function __construct()
    {
         $this->customerReviewRepository=new CustomerReviewRepository();
    }
    public function addCustomerReview($req)
    {
        return $this->customerReviewRepository->addCustomerReview($req);
    }
    public function updateCustomerReview($req,$id)
    {
        return $this->customerReviewRepository->updateCustomerReview($req,$id);

    }
    public function deleteMyReview($id)
    {
        return $this->customerReviewRepository->deleteMyReview($id);
    }

    public function viewMyReview()
    {
        return $this->customerReviewRepository->viewMyReview();
    }
}