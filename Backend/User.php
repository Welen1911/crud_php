<?php 
    class User {
        private $nome;
        private $email;
        private $senha;
        public function __get($name) {
            return $this->$name;    
        }
        public function __set($name, $value) {
            $this->$name = $value;
        }
    }
?>