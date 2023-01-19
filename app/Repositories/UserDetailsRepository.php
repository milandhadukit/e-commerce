<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\UserDetail;

class UserDetailsRepository extends BaseRepository
{
    public function addUserDetails($req)
    {
        $userDetails= [

            'name' => $req['name'],
            'state' => $req['state'],
            'city' => $req['city'],
            'address' => $req['address'],
            'mobile' => $req['mobile'],
            'pin-code' => $req['pin-code'],
            'user_id'=>auth()->user()->id,
        
        ];
        
        $userDetailsAdd = UserDetail::create($userDetails);
        return $userDetailsAdd;
    }
    public function viewOrderDetailsUser()
    {
        $orderDetails=UserDetail::where('user_id',auth()->user()->id)->get();
        return $orderDetails;
    }
    public function updateUserDetails($req,$id)
    {
        $userAddressDetails=UserDetail::find($id);
      
        $userDetails= [

            'name' => $req['name'],
            'state' => $req['state'],
            'city' => $req['city'],
            'address' => $req['address'],
            'mobile' => $req['mobile'],
            'pin-code' => $req['pin-code'],
            // 'user_id'=>auth()->user()->id,
        
        ];

        $userAddressDetails->update($userDetails);
        return $userAddressDetails;
    }
}