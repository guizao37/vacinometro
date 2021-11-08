<?php

if (isset($_POST['submit'])) {
	include_once('../models/config.php');
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$ra = $_POST['ra'];
	$senha = $_POST['senha'];
	$vacinado = $_POST['vacinado'];
	if ($vacinado=='sim'){
	$fabricante = $_POST['fabricante'];
	$dose = $_POST['dose'];
	} else {
		$fabricante = "Não vacinado";
		$dose = NULL;
	}

	$sql = "SELECT * FROM usuarios WHERE email= '$email'";
	$sql2 = "SELECT * FROM usuarios WHERE ra = '$ra'";

	$result = $conexao->query($sql);
	$result2 = $conexao->query($sql2);

	if ((mysqli_num_rows($result) == 0) and (mysqli_num_rows($result2) == 0)) {
		$msg = "Usuário cadastrado com sucesso";
		$result = mysqli_query($conexao, "INSERT INTO usuarios(nome, sobrenome, email, ra, senha, vacinado, fabricante, dose) 
			VALUES('$nome', '$sobrenome', '$email', '$ra', '$senha', '$vacinado', '$fabricante', '$dose')");
		header('Location: index.php');
	} else {
		$msg = "Falha ao cadastrar";
		header('Location: index.php');
	} 
}

?>

<html>

<head>
	<meta charset="utf-8">
	<title>Conta</title>
	<link rel="stylesheet" type="text/css" href="../estilo/style.css">
	<script>
		function mostrar(x) {
			if (x == 1) {
				document.getElementById('mostrar').style.display = 'block';
			} else {
				document.getElementById('mostrar').style.display = 'none'
			}
		}
	</script>
</head>

<body>
	<div id="cabecalho">
		<img src="../imagens/puc.jpg" width="200px">
	</div>
	<div id="lado">
		<div id="login">
			<form action="../controllers/testLogin.php" method="POST">
				<fieldset>
					<legend>Login</legend>
					<input type="email" name="email" style="width:260px; height: 35px;" placeholder="E-mail" class="icon1" required><br>
					<br>
					<input type="password" name="senha" style="width:260px; height: 35px;" placeholder="Senha" class="icon2" required><br>
					<br>
					<a href="recuperar.php" class="esqueci">Esqueci a senha</a><br>
					<br>
					<input type="submit" name="entrar" value="ENTRAR" class="form-submit-button">
				</fieldset>
			</form>
		</div>
		<hr style="width: 1px; height: 674px; background: white;">
		<div id="cadastro" style="text-align: left;">
			<form name="cadastro" action="index.php" method="POST">
				<fieldset>
					<legend>Cadastre-se</legend>
					<?php
					if(isset($_POST['submit'])){
						echo $msg;
					}
					?>
					<input type="text" name=nome style="width:300px; height: 35px;" placeholder="Nome" required><br>
					<br>
					<input type="text" name=sobrenome style="width:300px; height: 35px;" placeholder="Sobrenome" required><br>
					<br>
					<input type="email" name="email" style="width:300px; height: 35px;" placeholder="E-mail" required><br>
					<br>
					<input type="text" name="ra" style="width:300px; height: 35px;" placeholder="Informe o RA"><br>
					<br>
					<input type="password" name="senha" style="width:300px; height: 35px;" placeholder="Senha" required><br>
					<br>
					<p>Já foi vacinado?</p>
					<br>
					<input type="radio" name="vacinado" value="sim" onclick="mostrar(1)" checked>
					<label for="bool">Sim</label>
					<input type="radio" name="vacinado" value="nao" onclick="mostrar(0)">
					<label>Não</label>
					<br>
					<div id="mostrar">
						<br>
						<select name="fabricante" style="width: 300px; height:35px">
							<option value="" disabled selected>Selecione a vacina que você tomou</option>
							<option value="Astrazeneca / Oxford">Astrazeneca / Oxford</option>
							<option value="Pfizer">Pfizer</option>
							<option value="Coronavac">Coronavac</option>
							<option value="Janssen">Janssen / Johnson & Johnson</option>
							<option value="Outra">Outra</option>
						</select><br><br>
						<input type="radio" id="dose" name="dose" value="Primeira dose">
						<label for="primeira_dose">Primeira dose</label><br>
						<input type="radio" id="dose" name="dose" value="Segunda dose">
						<label for="segunda_dose">Segunda dose</label><br>
						<input type="radio" id="dose" name="dose" value="Terceira dose">
						<label for="terceira_dose">Terceira dose</label><br>
						<input type="radio" id="dose" name="dose" value="Dose única">
						<label for="dose_unica">Dose única</label><br>
					</div>
					<br>
					<input type="submit" name="submit" value="CADASTRAR" class="form-submit-button">
				</fieldset>
			</form>
		</div>
	</div>
</body>

</html>