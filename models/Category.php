<?php
include_once __DIR__."/../includes/db.php";
class Category{
    public function createCategory($name,$pname)
    {
        $cont=Database::connect();
    
        $sql="insert into category(name,parent_name) values (:name,:pname)";
        $statement=$cont->prepare($sql);
    
        $statement->bindParam(':name',$name);
        $statement->bindParam(':pname',$pname);
    
        //$statement->execute();
        if($statement->execute())
        return true;
        else
        return false;
    }

    public function retrieveCategory()
{
    $cont=Database::connect();

    $sql="select * from category";
    $statement=$cont->prepare($sql);

    $statement->execute();
    $results=$statement->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

public function selectedCategory($id){
    $cont=Database::connect();
    $sql="select * from category where id=:id";
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
    $sql="delete from category where id=:id";
    $statement=$cont->prepare($sql);
    $statement->bindParam(':id',$id);
    if($statement->execute())
        return true;
    else 
        return false;
}
public function search($pname){
    $cont = Database::connect();
    $sql = "select * from category where parent_name=:pname";
    $statement = $cont->prepare($sql);
    $statement->bindParam(":pname",$pname);
    $statement->execute();
    $result=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

}
?>