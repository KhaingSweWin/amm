<?php
include_once __DIR__."/../models/Item.php";
class ItemController extends Item{
    public function addItem($itemName,$categoryId)
    {
        $result=$this->createItem($itemName,$categoryId);
        return $result;
    }

    public function getItems()
    {
        $category=$this->retrieveItem();
        return $category;
    }

    public function updateItem($id,$itemName,$categoryId){
        $result = $this->update($id,$itemName,$categoryId);
        return $result;
    }

    public function getItemById($id){
        $category = $this->selectedItem($id);
        return $category;
    }

    public function deleteItem($id){
        $result = $this->delete($id);
        return $result;
    }

    public function searchItem($categoryId){
        $result = $this->search($categoryId);
        return $result;
    }
}
?>