<?php 
include_once "header.php";
include_once 'dbconnect.php';
//iniciar a sessão
session_start();

//se existir o indice btn_entrar , é porque alguem clicou no botão
if (isset($_POST['btn-entrar'])):
	//echo "Clicou";
	$erros = array();
	//mysqli_escape_string - função que limpa os dados e evita sqlinjection e outros caracteres indevidos.
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);
	
	
	if(empty($login) or empty($senha)):
		$erros[] = "<li> O campo login/senha precisa ser preenchido </li>";
	else:
		//criptografando a senha
		$senha = md5($senha);
		//usuario: marta/senha:123456
		$sql= "SELECT idUsuario FROM usuario WHERE dscEmailUsuario='$login' AND senhaUsuario='$senha'";
		
		$resultado = mysqli_query($connect,$sql);
		
		//numeros de linhas do resultado da query maior que 0 ou Se houver algum registro na tabela
		if (mysqli_num_rows($resultado) > 0):
			$dados=mysqli_fetch_array($resultado);
			$_SESSION['logado'] = true;
			$_SESSION['id_usuario']= $dados['id'];

			header('Location: index.php');		
		
		else:
			$erros[]="<li>Usuário e senha não conferem.</li>";
		endif;
	endif;	
endif;	
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