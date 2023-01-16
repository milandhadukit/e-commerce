<?php
namespace App\Repositories\Admin;
use App\Repositories\BaseRepository;
use App\Models\CustomerReview;


class ReviewCustomerRepository extends BaseRepository
{
    public function viewReview()
    {
        $viewReview=CustomerReview::
        select('customer_reviews.id','products.name as product_name', 'customer_reviews.comment', 'customer_reviews.rating','users.name as username')
        ->join('products', 'products.id', 'customer_reviews.product_id')
        ->join('users','users.id','customer_reviews.user_id')
        ->get();
        return $viewReview;
    }
    public function deleteReview($id)
    {
        $deleteReview=CustomerReview::find($id);
        return $deleteReview->delete();

    }
}