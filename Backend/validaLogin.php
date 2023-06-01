<?php 
    require "conexao.php";
    require "User.php";
    require "loginService.php";
    echo "Validando!";
    session_start();
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    if (isset($_GET["cadastro"]) && $_GET["cadastro"] == 1) {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $user = new User();
        $user->__set("nome", $nome);
        $user->__set("email", $email);
        $user->__set("senha", $senha);
        $conexao = new Conexao();
        $login_service = new LoginService($user, $conexao);
        if ($login_service->cadastrar()) {
            header("location: login.php?cadastro=feito");
        } 
    } else {
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $user = new User();
        $user->__set("email", $email);
        $user->__set("senha", $senha);
        $conexao = new Conexao();
        $login_service = new LoginService($user, $conexao);
        $usuario = $login_service->verificar();
        if ($usuario->nome) {
            $_SESSION["id"] = $usuario->id;
            echo "usuario encontrado!";
            header("location: index.php");
        } else {
            header("location: login.php?erro=1");
        }
    }
   
   

?>