<?php
include_once __DIR__."/../includes/db.php";
class Returnn{
    public function createReturn($lent_id,$return_date,$emp_id,$discount,$deposit)
    {
        $cont=Database::connect();
    
        $sql="insert into return_tb(lent_id,return_date,emp_id,discount,deposit) values (:lent,:return_date,:emp_id,:discount,:deposit)";
        $statement=$cont->prepare($sql);
    
        $statement->bindParam(':lent',$lent_id);
        $statement->bindParam(':emp_id',$emp_id);
        $statement->bindParam(':discount',$discount);
        $statement->bindParam(':return_date',$return_date);
        $statement->bindParam(':deposit',$deposit);
        //$statement->execute();
        if($statement->execute())
        return true;
        else
        return false;
    }
    public function createReturnDetail($return_id,$lent_id,$LentDetail_id,$return_qty,$has_broken,$broken_qty,$price){
        $cont=Database::connect();
        $sql="insert into return_detail(return_id,lent_id,LentDetail_id,return_qty,has_broken,broken_qty,price) 
        values (:return_id,:lent_id,:LentDetail_id,:return_qty,:has_broken,:broken_qty,:price)";
        $statement=$cont->prepare($sql);

        $statement->bindParam(":return_id",$return_id);
        $statement->bindParam(":lent_id",$lent_id);
        $statement->bindParam(":LentDetail_id",$LentDetail_id);
        $statement->bindParam(":return_qty",$return_qty);
        $statement->bindParam(":has_broken",$has_broken);
        $statement->bindParam(":broken_qty",$broken_qty);
        $statement->bindParam(":price",$price);
        
        if($statement->execute())
        return true;
        else
        return false;
    }
    public function changeChecker($id,$val){
        $cont=Database::connect();
        $sql = "update lent set checker = :val where id=:id";
        $statement=$cont->prepare($sql);

        $statement->bindParam(':id',$id);
        $statement->bindParam(':val',$val);
        if($statement->execute())
        return true;
        else 
        return false;
    }

    public function changeGive_back($id){
        $cont=Database::connect();
        $sql = "update lent_detail set give_back = 1 where id=:id";
        $statement=$cont->prepare($sql);

        $statement->bindParam(':id',$id);
        if($statement->execute())
        return true;
        else 
        return false;
    }
}

?>