<?php
include_once __DIR__."/../includes/db.php";
class Item{
    public function createItem($itemName,$categoryId)
    {
        $cont=Database::connect();
    
        $sql="insert into item(item_name,category_id) values (:itemName,:categoryId)";
        $statement=$cont->prepare($sql);
    
        $statement->bindParam(':itemName',$itemName);
        $statement->bindParam(':categoryId',$categoryId);
    
        //$statement->execute();
        if($statement->execute())
            return true;
        else
            return false;
    }

    public function retrieveItem()
{
    $cont=Database::connect();

    $sql="select * from item";
    $statement=$cont->prepare($sql);

    $statement->execute();
    $results=$statement->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

public function selectedItem($id){
    $cont=Database::connect();
    $sql="select * from item where id=:id";
    $statement=$cont->prepare($sql);
    $statement->bindParam(':id',$id);
    $statement->execute();
    $result=$statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}

public function update($id,$name,$pname){
    $cont=Database::connect();
    $sql="Update category set name=:name,pname=:pname where id=:id";
    $statement=$cont->prepare($sql);
    $statement->bindParam(':id',$id);
    $statement->bindParam(':name',$name);
    $statement->bindParam(':pname',$pname);
    if($statement->execute())
        return true;
    else 
        return false;
}

public function delete($id){
    $cont=Database::connect();
    $sql="delete from item where id=:id";
    $statement=$cont->prepare($sql);
    $statement->bindParam(':id',$id);
    if($statement->execute())
        return true;
    else 
        return false;
}
public function search($categoryId){
    $cont = Database::connect();
    $sql = "select * from category where categoryId=:categoryId";
    $statement = $cont->prepare($sql);
    $statement->bindParam(":categoryId",$categoryId);
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

}
?>