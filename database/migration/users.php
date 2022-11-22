<?php
    include '../database/connection.php';

    if(!$connection->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'test_task_db'")->fetchColumn()){
        $createTable = 
        "CREATE TABLE `users` (
        `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(45) NOT NULL,
        `email` VARCHAR(45) NOT NULL,
        `tax_number` INT(11) DEFAULT NULL,
        `password` VARCHAR(255) NOT NULL,
        `shipping_id` VARCHAR(255) NOT NULL,
        `billing_id` VARCHAR(255) NOT NULL,
        UNIQUE KEY `email_UNIQUE` (`email`),
        UNIQUE KEY `tax_number_UNIQUE` (`tax_number`),
        FOREIGN KEY (shipping_id) REFERENCES shipping_address(id)
        FOREIGN KEY (billing_id) REFERENCES billing_address(id)
        )";

        $connection->exec($createTable);
    }else{
        $connection->exec("USE `test_task_db`;");
    }