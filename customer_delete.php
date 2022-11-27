<?php
include_once __DIR__."/controller/custcontroller.php";
$id=$_POST['cid'];


$customercontroller= new CustomerController();
$result=$customercontroller->deleteCustomer($id);
if($result){
    $datas=$customercontroller->getCustomer();
    $output="";

    foreach($datas as $data)
    {

       
        $output.="<tr>";
        $output.= "<td><div contentEditable='true' class='' id=''>".$data['id']."</div></td>";
        $output.= "<td><div contentEditable='true' class='cust_edit' id=''>".$data['cus_name']."</div></td>";
        $output.= "<td><div contentEditable='true' class='cust_edit' id=''>".$data['NRC']."</div></td>";
        $output.= "<td><div contentEditable='true' class='cust_edit' id=''>".$data['address']."</div></td>";
        $output.= "<td><div contentEditable='true' class='cust_edit' id=''>".$data['phone_number']."</div></td>";   
        //$data.= "<td><div contentEditable='true' class='cust_edit' id=''>".$result['work_address']."</div></td>"; 
        $output.="<td cid=".$data['id']."><a href='' class='btn btn-danger m-2'> Delete </a></td>";
      
        $output.="</tr>";
    }
    echo $output;
}

   


//      echo $data; // string or json_encode
// ?>           
