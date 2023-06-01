<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<Script>
			function verificarTodosCampos() {
				let email = document.getElementById("email")
				let nome = document.getElementById("nome")
				let senha = document.getElementById("senha")
				if (email.value != "" && email.value != null && nome.value != "" && nome.value != null && senha.value.length >= 6) {
					document.getElementById("botao").disabled = false
				} else {
					document.getElementById("botao").disabled = true
				}
			}
			function verificarSenha() {
				let senha = document.getElementById("senha")
				let senhaValue = senha.value
				if (senhaValue.length < 6) {
					document.getElementById("redSenha").innerHTML = "* Senha menor que 6 dígitos!"
					
				} else {
					document.getElementById("redSenha").innerHTML = "*"
				}
			}
			function verificarEmail() {
				let email = document.getElementById("email")
				if (email.value != "" && email.value != null) {
					document.getElementById("redEmail").innerHTML = "*"
					return 1
				} else {
					document.getElementById("redEmail").innerHTML = "* Caixa e-mail vázio!"
				}
			}
			function verificarNome() {
				let nome = document.getElementById("nome")
				if (nome.value != "" && nome.value != null) {
					document.getElementById("redNome").innerHTML = "*"
					return 1
				} else {
					document.getElementById("redNome").innerHTML = "* Caixa nome vázio!"
				}
			}
		</Script>
	</head>

	<body onload="document.getElementById('botao').disabled = true">
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>
		<!-- <?php if (isset($_GET["erro"]) && $_GET["erro"] == 1) {?>
			<div class="bg-danger pt-2 d-flex justify-content-center"><h4 class="text-white">E-mail ou senha incorretos!</h4></div>	
		<?php }?> -->
		<div class="container app">
			<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Cadastro</h4>
								<hr />
									<form class="row mb-3 d-flex align-items-center tarefa" action="validaLogin.php?cadastro=1" method="post">
                                        Nome:<red style="color:red" id="redNome">*</red>
                                        <input type="text" class="form-control mb-3" placeholder="nome" id="nome" onblur="verificarNome()" name="nome">
                                        E-mail<red style="color:red" id="redEmail" >*</red>
                                        <input type="email" class="form-control mb-3" placeholder="E-mail" id="email" onblur="verificarEmail()" name="email">
                                        Senha<red style="color:red" id="redSenha">*</red>
                                        <input type="password" class="form-control mb-3" placeholder="Senha"  id="senha" onblur="verificarSenha()" name="senha">
                                        <button type="submit" id="botao" class="btn btn-success col-3">Cadastrar</button> <a href="login.php" style="margin-left: 10px;" class="btn btn-info col-3">Voltar</a>
                                    </form>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script>
		setInterval(() => {
			verificarTodosCampos()
		},100);
	</script>
</html>