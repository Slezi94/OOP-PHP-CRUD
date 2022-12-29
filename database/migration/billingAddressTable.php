<?php
    include 'connection.php';

    if(!$connection->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'test_task_db'")->fetchColumn()){
        $createTable =
        "CREATE TABLE `billing_address` (
        `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `user_id` VARCHAR(255) NOT NULL,
        `billing_address` VARCHAR(255) NOT NULL,
        )";

        $connection->exec($createTable);
    }else{
        $connection->exec("USE `test_task_db`;");
    }