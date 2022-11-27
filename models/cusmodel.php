<?php 
include_once __DIR__."/../includes/db.php";
class Customer{

public function createCustomer($name,$nrc,$add,$ph)
{
    $cont=Database::connect();

    $sql="insert into customer(cus_name,NRC,address,phone_number) values(:name,:nrc,:add,:ph)";


    $statement=$cont->prepare($sql);

    $statement->bindParam(':name',$name);
    $statement->bindParam(':nrc',$nrc);
    $statement->bindParam(':add',$add);
    $statement->bindParam(':ph',$ph);
    


    if($statement->execute())
    return true;
    else
    return false;
}
 public function retrieveCustomer(){
   $cont=Database::connect();
     $sql="select * from customer";
    $statement=$cont->prepare($sql);

   $statement->execute();
    $results=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}
public function delete($id){
  $cont=Database::connect();
  $sql="delete from customer where id=:id";
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
public function createWorkId(){
  
  $cont=Database::connect();
  $sql="select id from customer order by id DESC LIMIT 1;";
  $statement=$cont->prepare($sql);
  $statement->execute();
  $result=$statement->fetch(PDO::FETCH_ASSOC);
  return $result;

  
}
public function createWork($newid,$work_detail){

  $cont=Database::connect();
  $sql="insert into workaddress(cus_id,work_address) values(:id,:work_add)";
  $statement=$cont->prepare($sql);
  $statement->bindParam(':id',$newid);
  $statement->bindParam(':work_add',$work_detail);
  $statement->execute();
}

public function detail($id)
{
    $cont=Database::connect();
    $sql="select * from `workaddress` where cus_id=:id";
    $statement=$cont->prepare($sql);
    $statement->bindParam(':id',$id);
    $statement->execute();
    $results=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}
public function removeDetail($id1)
{
  $cont=Database::connect();
  $sql="delete from workaddress where id=:id1";
  $statement=$cont->prepare($sql);
  $statement->bindParam(':id1',$id1);
  $statement->execute();

}
    
} 


?>