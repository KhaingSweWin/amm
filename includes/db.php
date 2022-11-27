<?php

class Database{
    public static $dbhost='localhost';
    public static $username="root";
    public static $password="";
    public static $dbname="aungmyanmar";
    public static $cont;

    public static function connect(){
        try{
            self::$cont=new PDO("mysql:host=" .self::$dbhost.";
            dbname=".self::$dbname,self::$username,self::$password);
        }
        catch(PDOException $e)
        {
            exit("Error: ". $e->getMessage()) ;
        }
        return self::$cont;
    }
    public static function disconnect()
    {
        self:: $cont=null;
    }
    
}
?>