<?php
include_once __DIR__."/controller/empcontroller.php";
$id=$_POST['pid'];
$employeecontroller= new EmployeeController();
$result=$employeecontroller->deleteEmployee($id);
if($result){
    $results=$employeecontroller->getEmployees();
    $data="";

    foreach($results as $result)
    {
        $data.="<tr>";
        $data.= "<td><div contentEditable='true' class='edit' id=''>".$result['id']."</div></td>";
        $data.= "<td><div contentEditable='true' class='edit' id=''>".$result['name']."</div></td>";
        $data.= "<td><div contentEditable='true' class='edit' id=''>".$result['address']."</div></td>";
        $data.= "<td><div contentEditable='true' class='edit' id=''>".$result['phone_number']."</div></td>";   
        $data.="<td pid=".$result['id']."><a href='' class='btn btn-danger m-2'> Delete </a></td>";
        $data.="</tr>";
    }
    echo $data;
}

   


//      echo $data; // string or json_encode
// ?>           
