<?php 
    class tarefaService {
        private $conexao;
        private $tarefa;
        private $user;
        public function __construct(Conexao $conexao,Tarefa $tarefa = null, $user) {
            $this->conexao = $conexao->conectar();
            $this->tarefa = $tarefa;
            $this->user = $user;
        }
        public function inserir() {
            $query = "insert into tb_tarefas(id_usuario,tarefa)values(:id_usuario,:tarefa)";
            $state = $this->conexao->prepare($query);
            $state->bindValue(":id_usuario", $this->user);
            $state->bindValue(":tarefa", $this->tarefa->__get("tarefa"));
            $state->execute();

        }
        public function recuperar() {
            $query = "select t.id, t.tarefa, s.status from tb_tarefas as t left join tb_status as s on (t.id_status = s.id) where t.id_usuario = :id_usuario";
            $state = $this->conexao->prepare($query);
            $state->bindValue(":id_usuario", $this->user);
            $state->execute();
            $lista = $state->fetchAll();
            // echo "<pre>";
            // print_r($lista);
            // echo "</pre>";
            return $lista;
        }
        public function atualizar() {
            $query = "update tb_tarefas set tarefa = ? where id = ? and id_usuario = ?";
            $state = $this->conexao->prepare($query);
            $state->bindValue(1, $this->tarefa->__get("tarefa"));
            $state->bindValue(2, $this->tarefa->__get("id"));
            $state->bindValue(3, $this->user);
            return $state->execute();
            
        }
        public function remover() {
            $query = "delete from tb_tarefas where tarefa = :tarefa and id = :id and id_usuario = :id_usuario";
            $state = $this->conexao->prepare($query);
            $state->bindValue(":tarefa", $this->tarefa->__get("tarefa"));
            $state->bindValue(":id", $this->tarefa->__get("id"));
            $state->bindValue(":id_usuario", $this->user);
            return $state->execute();
        }
        public function realizar() {
            $query = "update tb_tarefas set id_status = 2 where id = :id and id_usuario = :id_usuario";
            $state = $this->conexao->prepare($query);
            $state->bindValue(":id_usuario", $this->user);
            $state->bindValue(":id", $this->tarefa->__get("id"));
            return $state->execute();
        } 
        public function recuperarUser() {
            $query = "select nome from tb_usuarios where id = :id_usuario";
            $state = $this->conexao->prepare($query);
            $state->bindValue(":id_usuario", $this->user);
            $state->execute();
            $lista = $state->fetch(PDO::FETCH_OBJ);
            // echo "<pre>";
            // print_r($lista);
            // echo "</pre>";
            return $lista;
        }
        public function editarNome($novoNome, $nome) {
            $query = "update tb_usuarios set nome = :novo_nome where id = :id";
            $state = $this->conexao->prepare($query);
            $state->bindValue(":novo_nome", $novoNome);
            $state->bindValue(":id", $this->user);
            $state->execute();
            $usuario = $state->fetch(PDO::FETCH_OBJ);
            return $usuario;
        }
        public function excluirConta($idConta) {
            $query = "delete from tb_tarefas where id_usuario = :id_usuario";
            $state = $this->conexao->prepare($query);
            $state->bindValue(":id_usuario", $this->user);
            $state->execute();
            $query = "delete from tb_usuarios where id = :id";
            $state = $this->conexao->prepare($query);
            $state->bindValue(":id", $this->user);
            $state->execute();
            
        }
        
        
        
        
    }
?>