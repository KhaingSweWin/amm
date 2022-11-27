<?php 
include_once __DIR__."/../includes/db.php";
class Employee{
public function createEmployee($name,$add,$ph)
{
    $cont=Database::connect();

    $sql="insert into employee(emp_name,address,phone_number) values(:name,:add,:ph)";
    $statement=$cont->prepare($sql);

    $statement->bindParam(':name',$name);
    $statement->bindParam(':add',$add);
    $statement->bindParam(':ph',$ph);


    if($statement->execute())
    return true;
    else
    return false;
}
public function retrieveEmployee(){
    $cont=Database::connect();
    $sql="select * from employee";
    $statement=$cont->prepare($sql);

    $statement->execute();
    $results=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}
public function selectEmployee($id){
    $cont=Database::connect();
    $sql ="select * from employee where id=:id";
    $statement=$cont->prepare($sql);
    $statement->bindParam(':id',$id);
    $statement->execute();
    $result=$statement->fetch(PDO::FETCH_ASSOC);
    return $result;

}
public function update($id,$name,$add,$ph){
    $cont=Database::connect();
    $sql ="update employee set name=:name, add=:address, ph=:phone_number where id=:id";
    $statement=$cont->prepare($sql);
    $statement->bindParam(':id',$id);
    $statement->bindParam(':name',$name);
    $statement->bindParam(':address',$add);
    $statement->bindParam(':phone_number',$ph);

    if($statement->execute())
    return true;
    else
    return false;
    
}
public function delete($id){
    $cont=Database::connect();
    $sql="delete from employee where id=:id";
    $statement=$cont->prepare($sql);
    $statement->bindParam(':id',$id); 
    if($statement->execute())
    {
        return true;
    }
    else
    {
        return false;
    }
}
}
?>