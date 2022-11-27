<?php
include_once __DIR__."/../models/Category.php";
class CategoryController extends Category{
    public function addCategory($name,$pname)
    {
        $result=$this->createCategory($name,$pname);
        return $result;
    }

    public function getCategories()
    {
        $category=$this->retrieveCategory();
        return $category;
    }

    public function updateCategory($id,$name,$pname){
        $result = $this->update($id,$name,$pname);
        return $result;
    }

    public function getCategoryById($id){
        $category = $this->selectedCategory($id);
        return $category;
    }

    public function deleteCategory($id){
        $result = $this->delete($id);
        return $result;
    }

    public function searchCategory($pname){
        $result = $this->search($pname);
        return $result;
    }
}
?>