<?php
//Szállítási cím módosítása
    session_start();
    require('../model/CrudModel.php');
    require('../controller/billingAddressValidate.php');

    $data = new crudModel();
    $validation = new Validation($_POST);
    $id = $_GET["id"];
    $data->setId($_GET["id"]);
    $errors= [];
    
    $record = $data->readOneBillingAddress($id);
    $value = $record[0];
    //A felhasználó id-ja az loghoz
    $userId = $value['user_id'];

    if(isset($_POST["edit"])){
        $errors = $validation->validateForm();
        if(empty($errors)){
            $data->updateBillingAddress($_POST["billing_address"], $id);
    
            $data->audit($userId, "Számlázási cím módosítása");
            $_SESSION["message"] = "Vásárló számlázási címe frissítve!";
            //Visszavezet a felhasználót módosító oldalra
            header("location: editForm.php?id=$userId&req=edit");
        }
    }