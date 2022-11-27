<?php 
include_once __DIR__."/../models/usermodel.php";
class UserController extends User{
public function addUser($email,$password){
$result=$this->createUser($email,$password);
return $result;
}
public function getUser(){
    $results=$this->retreiveUser();
    return $results;
}
}
?>