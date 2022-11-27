<?php
include_once __DIR__."/controller/custcontroller.php";
$id1=$_POST['did'];
//print_r($id1);




$customercontroller= new CustomerController();

$outcome=$customercontroller->deleteDetail($id1);
if($outcome){
    $id=$_POST['id'];
    print_r($id);
    $datas=$customercontroller->seeDetail($id);
    $output="";

    foreach($datas as $data)
    {
        $output.="<tr>";
        $output.="<td>".$count."</td>";        
        $output.="<td><div contentEditable='true' class='cust_edit' id='work_address_".$data['id']."' >".$data['work_address']."</div><td>";
        $output.="<td  detail=".$data['id']."><a class='btn btn-danger deleteCustomer '> Delete</a></td>";
        $output.="</tr>";      
        
    }
    echo $output;
}


   
