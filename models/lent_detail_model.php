<?php 
include_once __DIR__."/../includes/db.php";
class LentDetail{
    public function retrieveDetail($id){
        $cont=Database::connect();
        $sql="select employee.emp_name,lent_detail.* ,item.item_name from employee join lent_detail join item on employee.id = lent_detail.emp_id and lent_detail.item_id=item.id WHERE lent_id=:id";
       $statement=$cont->prepare($sql);
       $statement->bindParam(':id',$id); 
   
       $statement->execute();
       $result=$statement->fetchAll(PDO::FETCH_ASSOC);
       return $result;
    }
}
?>