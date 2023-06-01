<?php 
    require_once "session.php";
    require "tarefa.model.php";
    require "tarefa.service.php";
    require "conexao.php";
    $user = $_SESSION["id"];
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : $acao;
    $usuario = recuperarUser($user);
    if ($acao == "inserir") {
        $tarefa_model = new Tarefa();
        $tarefa_model->__set("tarefa", $_POST["tarefa"]);
        $conexao = new Conexao();
        $tarefa_service = new tarefaService($conexao, $tarefa_model, $user);
        $tarefa_service->inserir();
        // $usuario = $tarefa_service->recuperarUser();
        header("location: nova_tarefa.php?valor=1");
    } else if ($acao == "recuperar") {    
        $conexao = new Conexao();
        $tarefa_service = new tarefaService($conexao, null, $user);
        $listaTarefas = $tarefa_service->recuperar();
        // $usuario = $tarefa_service->recuperarUser();
    } else if ($acao == "atualizar") {
        $tarefa = new Tarefa();
        $tarefa->__set("id", $_POST["id"])->__set("tarefa", $_POST["tarefa"]);
        $conexao = new Conexao();
        $tarefa_service = new tarefaService($conexao, $tarefa, $user);
        if ($tarefa_service->atualizar()) {
            if (isset($_GET["pag"]) && $_GET["pag"] == "index") {
                header("location:index.php");
            } else {
                header("location:todas_tarefas.php");
            }
        }   
    } else if ($acao == "apagar") {
        $tarefa = new Tarefa();
        $tarefa->__set("id", $_GET["id"]);
        $tarefa->__set("tarefa", $_GET["tarefa"]);
        $conexao = new Conexao();
        $tarefa_service = new tarefaService($conexao, $tarefa, $user);
        if ($tarefa_service->remover()) {
            if (isset($_GET["pag"]) && $_GET["pag"] == "index") {
                header("location:index.php");
            } else {
                header("location:todas_tarefas.php");
            }
        }
    } else if ($acao == "realizar") {
        $tarefa = new Tarefa();
        $tarefa->__set("id", $_GET["id"]);
        $conexao = new Conexao();
        $tarefa_service = new tarefaService($conexao, $tarefa, $user);
        if ($tarefa_service->realizar()) {
            if (isset($_GET["pag"]) && $_GET["pag"] == "index") {
                header("location:index.php");
            } else {
                header("location:todas_tarefas.php");
            }
        }
    } else if ($acao == "mudarnome" && (isset($_POST["novonome"]) && ($_POST["novonome"] != null && $_POST["novonome"] != ""))) {
        $conexao = new Conexao();
        $tarefa_service = new tarefaService($conexao, null, $user);
        $novoNome = $_POST["novonome"];
        $usuario = $tarefa_service->editarNome($novoNome, $user);
        header("location: Perfil.php");
    } else if ($acao == "apagarConta" && (isset($_GET["idConta"]) && $_GET["idConta"] != null)) {
        $conexao = new Conexao();
        $tarefa_service = new tarefaService($conexao, null, $user);
        $idConta = $_GET["idConta"];
        $usuario = $tarefa_service->excluirConta($user);
        header("location: logoff.php");
    }
    function recuperarUser($user) {
        $conexao = new Conexao();
        $tarefa_service = new tarefaService($conexao, null, $user);
        $usuario = $tarefa_service->recuperarUser();
        return $usuario;
    }
    
?>