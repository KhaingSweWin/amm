<?php
include_once __DIR__."/../includes/db.php";
class Item{

public function createItem($item_id,$income_date,$qty,$actual_price,$lent_price)
{
    $cont=Database::connect();
    $sql="insert into stock(item_id,income_date,qty,actual_price,lent_price) values(:item_id,:income_date,:qty,:actual_price,:lent_price) ";
    $statement=$cont->prepare($sql);

    $statement->bindParam(':item_id',$item_id);
    $statement->bindParam(':income_date',$income_date);
    $statement->bindParam(':qty',$qty);
    $statement->bindParam(':actual_price',$actual_price);
    $statement->bindParam(':lent_price',$lent_price);

    //$statement->execute();
    if($statement->execute())
    return true;
    else 
    return false;
}
public function retrieveItems()
{
    $cont=Database::connect();

    $sql="select * from stock";
    $statement=$cont->prepare($sql);

    $statement->execute();
    $results=$statement->fetchAll(PDO::FETCH_ASSOC);

    return $results;


}
public function selectItem($id)
{
    $cont=Database::connect();
    $sql="select * from stock where id=:id";
    $statement=$cont->prepare($sql);
    $statement->bindParam(':id',$id);
    $statement->execute();
    $result=$statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}
public function item_name($id)
{
    $cont=Database::connect();
    $sql="select item.item_name, stock.item_id from item join stock on item.id = stock.item_id where item.id=:id";
    $statement=$cont->prepare($sql);
    $statement->bindParam(':id',$id);
    $statement->execute();
    $result=$statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}
public function delete($id)
{
    $cont=Database::connect();
    $sql="delete from stock where id=:id";
    $statement=$cont->prepare($sql);
    $statement->bindParam(':id',$id);
    if($statement->execute())
    {
        return true;
    }
    else{
        return false;
    }
}
public function search($name)
{
    $cont=Database::connect();
    $sql="select * from stock where name=:name";

    $statement=$cont->prepare($sql);
    $statement->bindParam(':name',$name);
    $statement->execute();
    $results=$statement->fetchAll(PDO::FETCH_ASSOC);
    return $results;

}
}


?>