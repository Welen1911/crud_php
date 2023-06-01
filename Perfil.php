<?php
	require_once "session.php";
	$acao = "recuperar";
	require "tarefa_controller.php";

?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<Script>
            function editar(conteudo) {
				let form = document.createElement("form")
				form.action = "tarefa_controller.php?acao=mudarnome"
				form.method = "post"
				form.className = "row"

				let input = document.createElement("input")
                input.value = conteudo
                input.name = "novonome"
                input.className = "col-9 form-control"
                input.id = "nome"
                

                let botao = document.createElement("button")
                botao.type = "submit"
                botao.className = "btn btn-info"
                botao.innerHTML = "Atualizar"

                form.appendChild(input)
				form.appendChild(botao)
				
				let teste = document.getElementById("nome")
				teste.innerHTML = ""
				teste.insertBefore(form, teste[0])

			}
			function excluirConta(idConta) {
				location.href = `tarefa_controller.php?acao=apagarConta&idConta=${idConta}`
			}
			
			
		</Script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
				<div>
					<a href="index.php" class="btn btn-secondary">Voltar</a>
				</div>
				 
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Configurações do perfil</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4 id="nome_antigo"><?php echo $usuario->nome?></h4>
								<hr />
									<div class="row mb-3 d-flex align-items-center tarefa">
										<div id="nome" class="col-sm-9">Editar nome</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<button class="btn btn-info" onclick="editar(document.getElementById('nome_antigo').innerHTML)">Editar</button>
										</div>
									</div>
                                    <hr>
                                    <div class="row mb-3 d-flex align-items-center tarefa">
                                        <div id="tarefa_" class="col-sm-9">Excluir conta</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<button class="btn btn-danger" onclick="excluirConta(<?$_SESSION['id']?>)">Excluir</button>
										</div> 
                                    </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>