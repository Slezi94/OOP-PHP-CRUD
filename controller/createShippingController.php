<?php
//Szállítási cím létrehozása
    require_once("../model/CrudModel.php");
    require('../controller/shippingAddressValidate.php');

    $newAddress = new crudModel();
    $id = $_GET["id"];
    $newAddress->setId($_GET["id"]);
    $validation = new Validation($_POST);
    $errors= [];

    if(isset($_POST["submit"])){
        $errors = $validation->validateForm();
        echo "dsaf";
        if(empty($errors)){
            $newAddress->insertShippingAddress($_POST["shipping_address"]);

            $_SESSION['message'] = "Új cím rögzítve";
            $newAddress->audit($id, "Új cím létrehozása");
            header("location: ../view/index.php");
        }

    }