<?php 
include_once "header.php";
include_once 'dbconnect.php';
//iniciar a sessão
session_start();

//se existir o indice btn_entrar , é porque alguem clicou no botão
if (isset($_POST['btn-entrar'])) {
	//echo "Clicou";
	$erros = array();
	//mysqli_escape_string - função que limpa os dados e evita sqlinjection e outros caracteres indevidos.
	$login = htmlspecialchars($_POST['login']);
	$senha = htmlspecialchars($_POST['senha']);
	$url="https://estorias-sem-h-crud.herokuapp.com/login.php";

	// Create a stream
	$opts = array(
		'http'=>array(
		'method'=>"GET",
		'header' => "Authorization: Basic " . base64_encode("$login:$senha")                 
		)
	);
  
  	$context = stream_context_create($opts);

	$resultado = (array)json_decode(file_get_contents($url, false, $context));

	if ($resultado["success"] == 1) {
		$_SESSION['logado'] = true;
		$_SESSION['id_usuario'] = $resultado['idUsuario'];

		header('Location: index.php');	
	} else {
		$erros[]="<li>" . $resultado["error"] . ".</li>";
	}
}
?>
<?php
if(!empty($erros)):
	foreach($erros as $erro):
		echo $erro;
	endforeach;
endif;
?>
<div class="row">
	<div class="col s12 m6 push-m3 z-depth-5">
		<h1>Login</h1>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
			Login: <input type="text" name="login"><br>
			Senha: <input type="password" name="senha"><br>
			<button type="submit" name="btn-entrar" class="waves-effect waves-light btn"> Entrar </button>
		</form>
	</div>
</div>

<?php 
include_once "footer.php";
?>