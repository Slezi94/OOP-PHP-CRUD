<?php

try{
    $connection = new PDO("mysql:host=localhost;charset=utf8", "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "Connected successfully";
}catch(PDOException $e){
    echo "Connection failed: ".$e->getMessage();
}