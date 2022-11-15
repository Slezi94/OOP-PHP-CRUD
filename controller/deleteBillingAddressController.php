<?php
//Számlázási cím törlése
    session_start();
    require_once("../model/CrudModel.php");

    $record = new crudModel();
    $billingAddresses = $record->readOneBillingAddress($_GET["id"]);
    $value = $billingAddresses[0];
    $userId = $value["user_id"];

    if(isset($_GET["id"]) && isset($_GET["req"])){
        if($_GET["req"] == "delete"){
            $record->setId($_GET["id"]);
            $record->deleteBillingAddress($_GET["id"]);
            //Alert
            $_SESSION["message"] = "Vásárló számlázási címe törölve!";
        }

        header("location: ../view/editForm.php?id=$userId&req=edit");
    }