<?php
include_once "controller/ItemController.php";
$id=$_POST['itemid'];
$itemController=new ItemController();
$result=$itemController->deleteItem($id);
if($result){
    $output="";
    $items = $itemController->getItems();
    foreach($items as $item){
        $output.="<tr>";
        $output.="<td>".$item['item_name']."</td>";
        $output.="<td>".$item['category_id']."</td>";
        $output.="<td itemid=".$item['id']."><a class='btn btn-danger m-2 item_delete'>Delete</a></td>";
        $output.="</tr>";
    }
    echo $output;
    //header('location:index.php');
}
include_once 'layouts/header.php';

include_once 'layouts/footer.php';
?>