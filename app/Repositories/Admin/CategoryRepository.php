<?php
namespace App\Repositories\Admin;
use App\Repositories\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository

{
    private $categoryRepo;
    public function __construct()
    {
        $this->categoryRepo=new Category();
    }

    public function addCategory($req)
    {
      
        $categoryData = [

            'name' => $req['name'],
            'description' => $req['description'],
        
        ];
        
        $categoryAdd =  $this->categoryRepo->create($categoryData);
        return $categoryAdd;
    }

    public function updateCategory($req,$id)
    {
      
        $categoryData = [

            'name' => $req['name'],
            'description' => $req['description'],
        
        ];
        $categoryUpdate= $this->categoryRepo->find($id);
        $categoryUpdate->update($categoryData);
        return $categoryUpdate;
    }
    public function deleteCategory($id)
    {
        $categoryDelete=$this->categoryRepo->find($id);
        $categoryDelete->delete();
        return $categoryDelete;

    }

    public function categoryLOV()
    {
        $viewCategory=$this->categoryRepo->all();
        return $viewCategory;
    }


}