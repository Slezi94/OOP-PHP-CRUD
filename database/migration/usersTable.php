
<?php
    include 'connection.php';

    if(!$connection->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'test_task_db'")->fetchColumn()){
        $createTable =
        "CREATE TABLE `users` (
        `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) NOT NULL,
        `tax_number` INT(11) DEFAULT NULL,
        `password` VARCHAR(255) NOT NULL,
        `shipping_id` VARCHAR(255) NOT NULL,
        `billing_id` VARCHAR(255) NOT NULL,
        )";

        $connection->exec($createTable);
} else {
    $connection->exec("USE `test_task_db`;");
}
