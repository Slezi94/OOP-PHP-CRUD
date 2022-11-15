<?php
//Felhasználó törlése
    session_start();
    require_once("../model/CrudModel.php");

    $record = new crudModel();

    if(isset($_GET["id"]) && isset($_GET["req"])){
        if($_GET["req"] == "delete"){
            $record->setId($_GET["id"]);
            $record->delete();
            echo "delete";
        }

        $record->audit($_GET["id"], "Vásárló adatok törlése!");
        $_SESSION["message"] = "Vásárló adatai törölve!";
        header("location: ../view/index.php");
    }