<?php
include_once __DIR__."/controller/custcontroller.php";
$newid=$_POST['newid'];
$newwork=$_POST['newwork'];

$ccontroller= new CustomerController();
$done = $ccontroller->addWork($newid,$newwork);

?>