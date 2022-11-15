<?php
//Szállítási cím törlése
    session_start();
    require_once("../model/CrudModel.php");

    $record = new crudModel();
    $shippingAddresses = $record->readOneShippingAddress($_GET["id"]);
    $value = $shippingAddresses[0];
    $userId = $value["user_id"];

    if(isset($_GET["id"]) && isset($_GET["req"])){
        if($_GET["req"] == "delete"){
            $record->setId($_GET["id"]);
            $record->deleteShippingAddress($_GET["id"]);
            //Alert
            $_SESSION["message"] = "Vásárló szállítási címe törölve!";
        }

        header("location: ../view/editForm.php?id=$userId&req=edit");
    }