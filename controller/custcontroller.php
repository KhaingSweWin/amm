<?php 
include_once __DIR__."/../models/cusmodel.php";
class CustomerController extends Customer{
    public function addCustomer($name,$nrc,$add,$ph){
        $result= $this->createCustomer($name,$nrc,$add,$ph);
        return $result;
    }
    public function getCustomer(){
        $customers=$this->retrieveCustomer();
        return $customers;
    }  
    public function deleteCustomer($id){
        $result=$this->delete($id);
        return $result;
    }
    public function getWorkId(){
        $result = $this -> createWorkId();
        return $result;
    }
    public function addWork($newid,$work_detail){
        $result = $this->createWork($newid,$work_detail);
        return $result; 
    }
    public function seeDetail($id){
        $result=$this->detail($id);
        return $result;
    }
    public function deleteDetail($id1){
        $result=$this->removeDetail($id1);
        return $result;
    }
}
?>