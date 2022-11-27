<?php
include_once __DIR__."/../models/stockmodel.php";
class ItemController extends Item{

public function addItem($item_id,$income_date,$qty,$actual_price,$lent_price)
{
    $result = $this->createItem($item_id,$income_date,$qty,$actual_price,$lent_price);
    return $result;
}
public function getItems()
{
    $items=$this->retrieveItems();
    return $items;
}
public function getItem($id)
{
    $item=$this->selectItem($id);
    return $item;
}
public function getitem_name($id)
{
    $item_name=$this->item_name($id);
    return $item_name;
}
public function deleteAddItem($id)
{
    $result=$this->delete($id);
    return $result;
}




}


?>