<?php
//Felhasználó létrehozásának validációja
    class Validation{
        private $data = [];
        private $errors = [];
        private static $fields = ['full_name', 'billing_address', 'shipping_address', 'email', 'tax_number', 'passw'];

        public function __construct($post_data){
            $this->data = $post_data;
            //Kapcsolat létrehozása a lekérdezésekhez
            $this->connection  = new PDO("mysql:host=localhost;dbname=test_task_db", "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }

        //Az űrlap minden mezője ki van-e töltve?
        public function validateForm(){
            foreach(self::$fields as $field){
                if(!array_key_exists($field, $this->data)){
                    trigger_error("$field nincs jelen az adatok közt!");
                    return;
                }
            }

            $this->validateFullName();
            $this->validateShippingAddress();
            $this->validateBillingAddress();
            $this->validateEmail();
            $this->validateTaxNumber();
            $this->validatePassword();
            return $this->errors;
        }

//E-mail cím létezik-e már az adatbázisban
        public function selectEmail($email){
            try{
                $select = $this->connection->prepare("SELECT email FROM users WHERE email = '$email'");
                $select->execute();
                $result = $select->fetchAll();

                return sizeof($result)>0;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

//Adószám cím létezik-e már az adatbázisban
        public function selectTaxNumber($taxNumber){
            try{
                $select = $this->connection->prepare("SELECT tax_number FROM users WHERE tax_number = '$taxNumber'");
                $select->execute();
                $result = $select->fetchAll();

                return sizeof($result)>0;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Név vizsgálata
        public function validateFullName(){
            $validate = trim($this->data['full_name']);

            if(empty($validate)){
                $this->addError('full_name', 'A mező nincs kitöltve!');
            }else{
                if(!preg_match('/^[a-zA-ZáéíóöőúüűÁÉÍÓÖŐÚÜŰ ]*$/', $validate)){
                    $this->addError('full_name', 'A név csak betűket tartalmazhat!');
                }
            }
        }

//Szállítási cím vizsgálata
        public function validateShippingAddress(){
            $validate = trim($this->data['shipping_address']);

            if(empty($validate)){
                $this->addError('shipping_address', 'A mező nincs kitöltve!');
            }else{
                if(!preg_match('/^[a-zA-ZáéíóöőúüűÁÉÍÓÖŐÚÜŰ0-9 ]*$/', $validate)){
                    $this->addError('shipping_address', 'Nem megfelelő cím!');
                }
            }
        }

//Számlázási cím vizsgálata
        public function validateBillingAddress(){
            $validate = trim($this->data['billing_address']);

            if(empty($validate)){
                $this->addError('billing_address', 'A mező nincs kitöltve!');
            }else{
                if(!preg_match('/^[a-zA-ZáéíóöőúüűÁÉÍÓÖŐÚÜŰ0-9 ]*$/', $validate)){
                    $this->addError('billing_address', 'Nem megfelelő cím!');
                }
            }
        }

//E-mail cím vizsgálata
        public function validateEmail(){
            $validate = trim($this->data['email']);

            if(empty($validate)){
                $this->addError('email', 'A mező nincs kitöltve!');
            }else{
                if(!filter_var($validate, FILTER_VALIDATE_EMAIL)){
                    $this->addError('email', 'Nem megfelelő e-mail cím!');
                }elseif($this->selectEmail($validate)){
                    $this->addError('email', 'Ilyen e-mail cím már létezik!');
                }
            }
        }

//Adószám cím vizsgálata
        public function validateTaxNumber(){
            $validate = trim($this->data['tax_number']);

            if(empty($validate)){

            }else{
                if(!preg_match('/^[0-9]{11}$/', $validate)){
                    $this->addError('tax_number', 'Nem megfelelő adószám!');
                }elseif($this->selectTaxNumber($validate)){
                    $this->addError('tax_number', 'Ilyen adószám már létezik!');
                }
            }
        }

//Jelszó cím vizsgálata
        public function validatePassword(){
            $validate = trim($this->data['passw']);

            if(empty($validate)){
                $this->addError('passw', 'A mező nincs kitöltve!');
            }else{
                if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_])[A-Za-z\d@$!%*?&_]{8,}$/', $validate)){
                    $this->addError('passw', 'Nem jelszó cím!');
                }
            }
        }

//Hibák hozzáadása
        public function AddError($key, $validate){
            $this->errors[$key] = $validate;

        }


    }