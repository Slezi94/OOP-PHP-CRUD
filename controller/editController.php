<?php
//Felhasználó módosítása
    session_start();
    require_once("../model/CrudModel.php");
    require("../controller/editValidate.php");

    $data = new crudModel();
    $id = $_GET["id"];
    $validation = new Validation($_POST, $id);
    $data->setId($_GET["id"]);
    $errors = [];

    if(isset($_POST["edit"])) {
        $errors = $validation->validateForm();
        if(empty($errors)) {
            $data->setFullName($_POST["full_name"]);
            $data->setEmail($_POST["email"]);
            $data->setTaxNumber($_POST["tax_number"]);
            $data->setPassword($_POST["passw"]);
    
            $data->update();
            $data->audit($id, "Vásárló adatok módosítása!");
            $_SESSION["message"] = "Vásárló adatai frissítve!";
            header("location: index.php");
        }
    }
    //Címek lekérdezése
    $billingAddresses = $data->readBillingAddress();
    $shippingAddresses = $data->readShippingAddress();
    //Mezők feltöltése a felhasználó adataival
    $record = $data->readOne();
    $value = $record[0];