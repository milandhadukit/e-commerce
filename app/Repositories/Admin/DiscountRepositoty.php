<?php
namespace App\Repositories\Admin;
use App\Repositories\BaseRepository;
use App\Models\Discount;
use App\Models\DiscountPercentage;
use Illuminate\Support\Str;
use Carbon\Carbon;
class DiscountRepositoty extends BaseRepository
{
    private $DiscountRepository;
    public function __construct()
    {
        $this->DiscountRepository = new Discount();
    }
    public function addDescount($req)
    {
        $discount = [
            'name' => $req['name'],
            'descreption' => $req['descreption'],
            'discount_price' => $req['discount_price'],
            'product_id' => $req['product_id'],
            'active' => 1,
        ];

        $addDiscount = $this->DiscountRepository->create($discount);
        return $addDiscount;
    }

    public function viewDiscountOnProduct()
    {
        $discount = $this->DiscountRepository
            ->select('id', 'descreption', 'discount_price', 'product_id')
            ->where('active', 1)
            ->get();
        return $discount;

        // $productPrice=Product::select(
        // 'products.name',
        // 'products.description',
        // 'products.image',
        // 'products.price',
        // 'discounts.discount_price',

        // )
        // ->leftJoin('discounts', function ($join) {
        //     $join->on('products.id', '=','discounts.product_id', );
        //     $join->where('discounts.active', '=', '1');
        // })
        // ->get();

        // return $productPrice;
    }

    public function closeDiscount($id)
    {
        $closeDiscount = [
            'active' => 0,
        ];
        $close = $this->DiscountRepository->find($id);
        $close->update($closeDiscount);
        return $close;
    }
    public function activeDiscount($id)
    {
        $activeDiscount = [
            'active' => 1,
        ];
        $active = $this->DiscountRepository->find($id);
        $active->update($activeDiscount);
        return $active;
    }
    public function updateDiscount($id, $req)
    {
        $discountUpdate = [
            'name' => $req['name'],
            'descreption' => $req['descreption'],
            'discount_price' => $req['discount_price'],
            'product_id' => $req['product_id'],
        ];

        $update = $this->DiscountRepository->find($id);

        $update->update($discountUpdate);
        return $update;
    }

    public function addDiscountPercentage($req)
    {
        $randomCoupon = Str::random(5);
        $date = Carbon::now();
        $discountPercentage = [
            'discount_percentage' => $req['discount_percentage'],
            'coupon' => $randomCoupon,
            'product_id' => $req['product_id'],
            'tc' => $req['tc'],
            'active_percentage' => 1,
        ];

        $addDiscount = DiscountPercentage::create($discountPercentage);
        return $addDiscount;
    }

    public function closeDiscountPercentage($id)
    {
        $closeDiscountPercentage = [
            'active_percentage' => 0,
        ];
        $close = DiscountPercentage::find($id);
        $close->update($closeDiscountPercentage);
        return $close;
    }

    public function activeDiscountPercentage($id)
    {
        $activeDiscountPercentage = [
            'active_percentage' => 1,
        ];
        $close = DiscountPercentage::find($id);
        $close->update($activeDiscountPercentage);
        return $close;
    }
    public function viewDiscountPercentage()
    {
        $listDiscountPercentage = DiscountPercentage::select(
            'products.name',
            'discount_percentages.tc',
            'discount_percentages.discount_percentage',
            'discount_percentages.coupon'
        )
            ->join('products', 'products.id', 'discount_percentages.product_id')
            ->get();
        return $listDiscountPercentage;
    }
    public function updateDiscountPercentage($req, $id)
    {
        $discountPercentage = [
            'discount_percentage' => $req['discount_percentage'],
            'tc' => $req['tc'],
        ];

        $updateDiscount = DiscountPercentage::find($id);
        $updateDiscount->update($discountPercentage);
        return $updateDiscount;
    }
    public function viewCoupon()
    {
        $viewOffers = DiscountPercentage::select(
            'products.name',
            'discount_percentages.tc',
            'discount_percentages.coupon',
            'discount_percentages.discount_percentage'
        )
            ->where('discount_percentages.active_percentage', 1)
            ->join('products', 'products.id', 'discount_percentages.product_id')
            ->get();
        return $viewOffers;
    }
}
