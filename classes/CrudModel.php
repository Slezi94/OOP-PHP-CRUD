<?php
    class CrudModel{
        private $id;
        private $fullName;
        private $email;
        private $taxNumber;
        private $password;
        private $shippingAddress;
        private$billingAddress;
        protected $connection;

        public function __construct($id = 0, $fullName = '', $email = '', $taxNumber = '', $password = '', $shippingAddress = '', $billingAddress = ''){
            $this->id = $id;
            $this->fullName = $fullName;
            $this->email = $email;
            $this->taxNumber = $taxNumber;
            $this->password = $password;
            $this->shippingAddress = $shippingAddress;
            $this->billingAddress = $billingAddress;

            include('../database/connection.php');
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function setFullName($fullName) {
            $this->fullName = $fullName;
        }

        public function getFullName(){
            return $this->fullName;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setTaxNumber($taxNumber) {
            $this->taxNumber = $taxNumber;
        }

        public function getTaxNumber(){
            return $this->taxNumber;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setShippingAddress($shippingAddress) {
            $this->shippingAddress = $shippingAddress;
        }

        public function getShippingAddress(){
                    return $this->shippingAddress;
        }

        public function setBillingAddress($billingAddress) {
            $this->billingAddress = $billingAddress;
        }

        public function getBillingAddress(){
            return $this->billingAddress;
        }


        public function create(){
            try{
                $insert = $this->connection->prepare("INSERT INTO users (name, email, tax_number, password)
                VALUES (?,?,?,?)");
                $shippingInsert = $this->connection->prepare("INSERT INTO shipping_address (user_id, shipping_address) VALUES (lastInsertId(),?)");
                $billingInsert = $this->connection->prepare("INSERT INTO billing_address (user_id, billing_address) VALUES (lastInsertId(),?)");

                $insert->execute([$this->fullName, $this->email, $this->taxNumber == "" ? NULL : $this->taxNumber, password_hash($this->password, PASSWORD_BCRYPT)]);
                $shippingInsert->execute([$this->shippingAddress]);
                $billingInsert->execute([$this->shippingAddress]);
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function read(){
            try{
                $select = $this->connection->prepare("SELECT * FROM users");
                $select->execute();
                $result = $select->fetchAll();

                foreach($result as &$row){
                    $row["billing_address"] = $this->connection->query("SELECT * FROM billing_address WHERE user_id = ".$row['id'])->fetchAll();
                    $row["shipping_address"] = $this->connection->query("SELECT * FROM shipping_address WHERE user_id = ".$row['id'])->fetchAll();
                }

                return $result;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Egy felhasználó lekérdezése
        public function readOne(){
            try{
                $select = $this->connection->prepare("SELECT * FROM users WHERE id = ?");
                $select->execute([$this->id]);
                $result = $select->fetchAll();

                return $result;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Felhasználó módosítása adatbázisban
        public function update(){
            try{
                if(!empty($this->password)){
                    $update = $this->connection->prepare("UPDATE users SET name=?, email=?, tax_number=?, password=? WHERE id = ?");
                    $update->execute([$this->fullName, $this->email, $this->taxNumber, password_hash($this->password, PASSWORD_BCRYPT), $this->id]);
                }else{
                    $update = $this->connection->prepare("UPDATE users SET name=?, email=?, tax_number=? WHERE id = ?");
                    $update->execute([$this->fullName, $this->email, $this->taxNumber, $this->id]);    
                }

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Felhasználó törlése adatbázisból
        public function delete(){
            try{
                $delete = $this->connection->prepare("DELETE FROM users WHERE id = ? ");
                $delete->execute([$this->id]);

                return $delete->fetchAll();

            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Számlázási cím mentése adatbázisba
        public function insertBillingAddress($newBillingAddress){
            try{
                $insert = $this->connection->prepare("INSERT INTO billing_address (user_id, billing_address)
                VALUES (?,?)");
                $insert->execute([$this->id, $newBillingAddress]);
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Szállítási cím mentése adatbázisba
        public function insertShippingAddress($newShippingAddress){
            try{
                $insert = $this->connection->prepare("INSERT INTO shipping_address (user_id, shipping_address)
                VALUES (?,?)");
                $insert->execute([$this->id, $newShippingAddress]);
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Számlázási cím módosítása adatbázisban
        public function updateBillingAddress($addressValue, $addressId){
            try{
                $update = $this->connection->prepare("UPDATE billing_address SET billing_address = ? WHERE id = ?");
                $update->execute([$addressValue, $addressId]);
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Szállítási cím módosítása adatbázisban
        public function updateShippingAddress($addressValue, $addressId){
            try{
                $update = $this->connection->prepare("UPDATE shipping_address SET shipping_address = ? WHERE id = ?");
                $update->execute([$addressValue, $addressId]);
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Számlázási cím lekérdezése 
        public function readBillingAddress(){
            try{
                $select = $this->connection->prepare("SELECT * FROM billing_address WHERE user_id = ?");
                $select->execute([$this->id]);
                $result = $select->fetchAll();

                return $result;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Szállítási cím lekérdezése 
        public function readShippingAddress(){
            try{
                $select = $this->connection->prepare("SELECT * FROM shipping_address WHERE user_id = ?");
                $select->execute([$this->id]);
                $result = $select->fetchAll();
        
                return $result;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Egy számlázási cím lekérdezése 
        public function readOneBillingAddress($addressId){
            try{
                $select = $this->connection->prepare("SELECT * FROM billing_address WHERE id = ?");
                $select->execute([$addressId]);
                $result = $select->fetchAll();

                return $result;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Egy szállítási cím lekérdezése 
        public function readOneShippingAddress($addressId){
            try{
                $select = $this->connection->prepare("SELECT * FROM shipping_address WHERE id = ?");
                $select->execute([$addressId]);
                $result = $select->fetchAll();

                return $result;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Számlázási cím törlése adatbázisból
        public function deleteBillingAddress($addressId){
            try{
                $delete = $this->connection->prepare("DELETE FROM billing_address WHERE id = ?");
                $delete->execute([$addressId]);

                return $delete->fetchAll();
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Szállítási cím törlése adatbázisból
        public function deleteShippingAddress($addressId){
            try{
                $delete = $this->connection->prepare("DELETE FROM shipping_address WHERE id = ?");
                $delete->execute([$addressId]);

                return $delete->fetchAll();
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Legutóbbi felhasználó id-ja
        public function lastInsert(){
            try{
                return $this->connection->lastInsertId();
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

//Logolás mentése adatbázisba
        public function audit($user_id, $log){
            try{
                $insert = $this->connection->prepare("INSERT INTO audit (user_id, log, `timestamp`)
                VALUES (?,?,now())");
                $insert->execute([$user_id, $log]);
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
    }
