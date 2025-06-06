<?php
    //CONNECTION ESTABLISHMENT
    define("HOST","localhost");
    define("DBNAME","atmmachine");
    define("USERNAME","root");
    define("PASSWORD","Venkat@mysql");
    
    class db{
        function dbConnection(){
            $dsn = "mysql:host=".HOST.";dbname=".DBNAME.";";
            $connection = new PDO($dsn,USERNAME,PASSWORD);  
            return $connection;
        }
    }
    $dbobj = new db();
?>