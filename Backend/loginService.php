<?php 
    class LoginService {
        private $nome;
        private $email;
        private $senha;
        private $conexao;
        public function __construct(User $user, Conexao $conexao) {
            $this->nome = $user->nome;
            $this->email = $user->email;
            $this->senha = $user->senha;
            $this->conexao = $conexao->conectar();
        }
        public function verificar() {
            $query = "select * from tb_usuarios where email = :email and senha = :senha";
            $state = $this->conexao->prepare($query);
            $state->bindValue(":email", $this->email);
            $state->bindValue(":senha", $this->senha);
            $state->execute();
            $usuario = $state->fetch(PDO::FETCH_OBJ);
            return $usuario;
        }
        public function cadastrar() {
            $query = "insert into tb_usuarios(nome, email, senha) values (:nome, :email, :senha)";
            $state = $this->conexao->prepare($query);
            $state->bindValue(":nome", $this->nome);
            $state->bindValue(":email", $this->email);
            $state->bindValue(":senha", $this->senha);
            return $state->execute();
        }
        public function editarNome($novoNome) {
            $query = "update tb_usuarios set nome = :novo_nome where nome = :nome";
            $state = $this->conexao->prepare($query);
            $state->bindValue(":novo_nome", $novoNome);
            $state->bindValue(":nome", $this->nome);
            $state->execute();
            $usuario = $state->fetch(PDO::FETCH_OBJ);
            return $usuario;
        }
    }
?>