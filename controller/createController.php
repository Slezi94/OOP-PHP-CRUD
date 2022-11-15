<?php
//Felhasználó létrehozása
    session_start();
    require("../model/CrudModel.php");
    require("../controller/createValidate.php");

    $source = new crudModel();
    $validation = new Validation($_POST);
    $errors= [];

    if(isset($_POST["submit"])){
        $errors = $validation->validateForm();
        //Ha az errors tömb üres létrehozza az új felhasználót
        if(empty($errors)){
            $source->setFullName($_POST["full_name"]);
            $source->setEmail($_POST["email"]);
            $source->setTaxNumber($_POST["tax_number"]);
            $source->setPassword($_POST["passw"]);
            $source->create();

            //Az újonnan létrehozott felhasználó id-jét felhasználjuk, hogy elmentsük a címeket
            $userId = $source->lastInsert();
            $source->setId($userId);
            $source->insertBillingAddress($_POST["billing_address"]);
            $source->insertShippingAddress($_POST["shipping_address"]);

            //Logolás
            $source->audit($userId, "Új felhasználó létrehozása");
            //Visszajelzés
            $_SESSION["message"] = "Vásárló adatai rögzítve!";
            //Művelet végén visszatérés az indexre
            header("location: ../view/index.php");
        }
    }
