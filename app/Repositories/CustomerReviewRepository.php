<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Product;
use App\Models\Category;
use App\Models\CustomerReview;

class CustomerReviewRepository extends BaseRepository
{
    public function addCustomerReview($req)
    {
        $checkReview = CustomerReview::select('rating', 'comment')
            ->where('user_id', auth()->user()->id)
            ->where('product_id', $req['product_id'])
            ->get()
            ->toArray();

        // dd(($checkReview['rating']));

        if (empty($checkReview['rating'])) {
            $updateReview = CustomerReview::where(
                'product_id',
                $req['product_id']
            )
                ->where('user_id', auth()->user()->id)
                ->update([
                    'rating' => $req['rating'],
                ]);
            return $updateReview;
        }


        if (empty($checkReview['comment'])) {
            $updateComment = CustomerReview::where(
                'product_id',
                $req['comment']
            )
                ->where('user_id', auth()->user()->id)
                ->update([
                    'comment' => $req['comment'],
                ]);
            return $updateComment;
        }   

        if (!empty($checkReview['rating'])) {

            return 'done';
        }

        $reviewData = [
            'user_id' => auth()->user()->id,
            'product_id' => $req['product_id'],
            'rating' => $req['rating'],
            'comment' => $req['comment'],
        ];
      
        $review = CustomerReview::create($reviewData);
        return $review;
    
    }
    public function updateCustomerReview($req,$id)
    {
        $reviewData = [
           
            'rating' => $req['rating'],
            'comment' => $req['comment'],
        ];
        $updateReview=CustomerReview::find($id);
        return  $updateReview->update($reviewData);
   
    }
    public function deleteCustomerReview($id)
    {
        $deleteReview=CustomerReview::where('user_id',auth()->user()->id)->find($id);
        $deleteReview->delete();
        return $deleteReview;
    }
    public function viewMyReview()
    {
        $viewReview=CustomerReview::where('user_id', auth()->user()->id)
        ->select('customer_reviews.id','products.name', 'customer_reviews.comment', 'customer_reviews.rating')
        ->join('products', 'products.id', 'customer_reviews.product_id')
        ->get();
        return $viewReview;
    }
}
