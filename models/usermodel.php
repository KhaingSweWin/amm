<?php 
include_once __DIR__."/../includes/db.php";
class User{
    public function createUser($email,$password)
{
    $cont=Database::connect();
    $sql="insert into user(email,password) values(:email,:password) ";
    $statement=$cont->prepare($sql);

    $statement->bindParam(':email',$email);
    $statement->bindParam(':password',$password);

    //$statement->execute();
    if($statement->execute())
    return true;
    else 
    return false;
}
public function retreiveUser()
{
    $cont=Database::connect();
    $sql="select * from user";
    $statement=$cont->prepare($sql);

    $statement->execute();
    $results=$statement->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}
}
?>