<?php 
    class Tarefa {
        private $id;
        private $idStatus;
        private $tarefa;
        private $dataCadastro;

        public function __get($name) {
            return $this->$name;
        }
        public function __set($name, $value) {
            $this->$name = $value;
            return $this;
        }
    }
?>