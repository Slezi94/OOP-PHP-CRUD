<?php
    include '../database/connection.php';

    if(!$connection->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'test_task_db'")->fetchColumn()){
        $createTable = 
        "CREATE TABLE `audit` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `log` varchar(45) NOT NULL,
        `timestamp` timestamp NOT NULL,
        PRIMARY KEY (`id`),
        FOREIGN KEY (user_id) REFERENCES user(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $connection->exec($createTable);
    }else{
        $connection->exec("USE `test_task_db`;");
    }