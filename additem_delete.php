<?php
include_once __DIR__.'/controller/stockcontroller.php';

$id=$_POST['pid'];
$scontroller= new ItemController();
$result=$scontroller->delete($id);
if($result){
    $data="";
    $items=$scontroller->getItems();

    $count=0;
    foreach($items as $item)
    {
        $count+=1;
        $data.="<tr>";
        $data.= "<td><div>".$count."</div></td>";
        $data.= "<td><div contentEditable='true' class='edit_item' id=''>".$item['income_date']."</div></td>";
        $data.= "<td><div contentEditable='true' class='edit_item' id=''>".$item['qty']."</div></td>"; 
        $data.= "<td><div contentEditable='true' class='edit_item' id=''>".$item['actual_price']."</div></td>";  
        $data.= "<td><div contentEditable='true' class='edit_item' id=''>".$item['lent_price']."</div></td>";  
        $data.="<td pid=".$item['id']."><a href='' class='btn btn-danger m-2 delete_item'> Delete </a></td>";
        $data.="</tr>";
    }
    echo $data;
}

?>