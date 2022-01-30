<?php

    namespace Hcode;

    class Model {
        
        private $values = [];

        public function __call($name, $args) {

            $method = substr($name, 0, 3);
            $fieldName = substr($name, 3, strlen($name));

           switch($method) {

                case "get":
                    return (isset($this->value[$fieldName])) ? $this->value[$fieldName] : null ;
                break;

                case "set";
                    $this->values[$fieldName] = $args[0];
                break;    
           }

        }

        public function setData($data = array()) {

            foreach ($data as $key => $value) {

                $this->{"set".$key}($value);

            }
            
        }

        public function getValues() {
            return $this->values;
        }

    }