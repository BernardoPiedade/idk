<?php

session_start();

// this file serves only to call the connection to the database with pdo

try {
    $conn = new PDO("mysql:host=localhost;dbname=idk;charset=utf8", "bernas", "bernas", [
       PDO::ATTR_EMULATE_PREPARES => false, 
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
     ]); 
} catch(\PDOException $e){
    // if connection fails, show PDO error. 
   echo "Error connecting to mysql: " . $e->getMessage();
}
?>