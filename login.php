<?php 
include_once "header.php";
//iniciar a sessão
session_start();

unset($_SESSION['logado']);
unset($_SESSION['id_usuario']);

//se existir o indice btn_entrar , é porque alguem clicou no botão
if (isset($_POST['btn-entrar'])) {
	//echo "Clicou";
	$erros = array();
	//mysqli_escape_string - função que limpa os dados e evita sqlinjection e outros caracteres indevidos.
	$login = htmlspecialchars($_POST['login']);
	$senha = htmlspecialchars($_POST['senha']);

	if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
		$resultado = entrar($login, $senha, $erros);

		if ($resultado["success"] == 1) {
			$_SESSION['logado'] = true;
			$_SESSION['id_usuario'] = $resultado['idUsuario'];

			header('Location: index.php');	
		} else {
			$erros[]="<li>" . $resultado["error"] . ".</li>";
		}
	} else {
		$erros[]="<li>Login inválido.</li>";
	}
}
?>
<div class="row">
	<div class="col s12 m6 push-m3 z-depth-5" id="log">
		<h1>Login</h1>
		<?php
		if(!empty($erros)):
			foreach($erros as $erro):
				echo $erro;
			endforeach;
		endif;
		?>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
			Login: <input type="text" name="login"><br>
			Senha: <input type="password" name="senha"><br>
			<button type="submit" name="btn-entrar" class="waves-effect waves-light btn"> Entrar </button>
		</form>

		<a href="cadastro.php"><button class="waves-effect waves-light btn red">Cadastre-se</button></a>
	</div>
</div>

<?php 
include_once "footer.php";
?>