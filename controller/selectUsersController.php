<?php
//Felhasználók lekérdezése
    session_start();
    require_once("../model/CrudModel.php");

    try{
        $data = new crudModel();
        $records = $data->read();
    }catch(PDOException $e){
        return "Nincs megjeleníthető adat".$e->getMessage();
    }