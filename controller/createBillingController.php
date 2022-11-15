<?php
//Számlázási cím létrehozása

    require_once("../model/CrudModel.php");
    require("../controller/billingAddressValidate.php");

    $newAddress = new crudModel();
    $id = $_GET["id"];
    $newAddress->setId($_GET["id"]);
    $validation = new Validation($_POST);
    $errors= [];

    if(isset($_POST["submit"])){
        $errors = $validation->validateForm();
        if(empty($errors)){
            $newAddress->insertBillingAddress($_POST["billing_address"]);
            $_SESSION['message'] = "Új cím rögzítve";
            $newAddress->audit($id, "Új cím létrehozása");
            header("location: ../view/index.php");
        }
    }