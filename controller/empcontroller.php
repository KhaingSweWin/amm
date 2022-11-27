<?php 
include_once __DIR__."/../models/empmodel.php";
class EmployeeController extends Employee{
    public function addEmployee($name,$add,$ph){
        $result= $this->createEmployee($name,$add,$ph);
        return $result;
    }
    public function getEmployees(){
        $employees=$this->retrieveEmployee();
        return $employees;
    }
    public function getEmployee($id){
        $employee=-$this->selectEmployee($id);
        return $employee;
    }
    public function deleteEmployee($id){
        $result=$this->delete($id);
        return $result;
    }
}
?>