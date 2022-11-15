<?php
//Szállítási cím módosítása
    session_start();
    require('../model/CrudModel.php');
    require('../controller/shippingAddressValidate.php');

    $data = new crudModel();
    $validation = new Validation($_POST);
    $id = $_GET["id"];
    $data->setId($_GET["id"]);
    $errors= [];

    $record = $data->readOneShippingAddress($id);
    $value = $record[0];
    $userId = $value['user_id'];

    if(isset($_POST['edit'])){
        $errors = $validation->validateForm();
        if(empty($errors)){
            $data->updateShippingAddress($_POST["shipping_address"], $id);

            $data->audit($userId, "Szállítási cím módosítása");
            $_SESSION["message"] = "Vásárló szállítási cím frissítve!";
            header("location: editForm.php?id=$userId&req=edit");
        }
    }