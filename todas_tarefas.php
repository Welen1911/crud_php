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
			function editar(num, conteudo) {
				let form = document.createElement("form")
				form.action = "tarefa_controller.php?acao=atualizar"
				form.method = "post"
				form.className = "row"

				let input = document.createElement("input")
				input.type = "text"
				input.name = "tarefa"
				input.className = "col-9 form-control"
				input.value = conteudo

				let inputId = document.createElement("input")
				inputId.type = "hidden"
				inputId.value = num
				inputId.name = "id"

				let button = document.createElement("button")
				button.type = "submit"
				button.className = "col-3 btn btn-info"
				button.innerHTML = "Atualizar"
				
				form.appendChild(input)
				form.appendChild(inputId)
				form.appendChild(button)
				
				let teste = document.getElementById("tarefa_"+num)
				teste.innerHTML = ""
				teste.insertBefore(form, teste[0])

			}
			function apagar(id, tarefa) {
				location.href = `tarefa_controller.php?acao=apagar&id=${id}&tarefa=${tarefa}`
			}
			function RealizarTarefa(id) {
				location.href = `tarefa_controller.php?acao=realizar&id=${id}`
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
					<?php if (isset($usuario->nome)) {?>
					<a href="Perfil.php" class="btn btn-secondary"><?php echo $usuario->nome;?></a><?php }?>
					<a href="logoff.php" class="btn btn-secondary">Sair</a>
				</div>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />
								<?php 
								$cont = 0;
								for ($x = 0; $x<sizeof($listaTarefas); $x++) {
									$cont++
								?>
								<div class="row mb-3 d-flex align-items-center tarefa">
									<div id="tarefa_<?= $listaTarefas[$x]['id']?>" class="col-sm-9"><?php echo $listaTarefas[$x]["tarefa"] ?> <?php echo "(".$listaTarefas[$x]['status'].")"?></div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger" onclick="apagar(<?=$listaTarefas[$x]['id']?>,`<?=$listaTarefas[$x]['tarefa']?>`)"></i>
										<?php if ($listaTarefas[$x]["status"] == "pendente") { ?>
										<i class="fas fa-edit fa-lg text-info" onclick="editar(<?=$listaTarefas[$x]['id']?>,`<?=$listaTarefas[$x]['tarefa']?>`)"></i>
										<i class="fas fa-check-square fa-lg text-success" onclick="RealizarTarefa(<?=$listaTarefas[$x]['id']?>)"></i> <?php }?>
									</div>
								</div>
								<?php } if ($cont == 0) {?>
									<div class="col-sm-9">Lista de tarefas vázia!</div>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>