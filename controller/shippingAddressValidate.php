<?php
//Szállítási cím validáció
    class Validation{
        private $data = [];
        private $errors = [];
        private static $fields = ['shipping_address'];

        public function __construct($post_data){
            $this->data = $post_data;
        }

        public function validateForm(){
            foreach(self::$fields as $field){
                if(!array_key_exists($field, $this->data)){
                    trigger_error("$field nincs jelen az adatok közt!");
                    return;
                }
            }

            $this->validateShippingAddress();
            return $this->errors;
        }


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

        public function AddError($key, $validate){
            $this->errors[$key] = $validate;

        }
    }