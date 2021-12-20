<?php include_once "header.php"; 

if (isset($_POST['btn-cadastrar'])) {
	//echo "Clicou";
	$erros = array();
	//mysqli_escape_string - função que limpa os dados e evita sqlinjection e outros caracteres indevidos.
	$username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
	$password_repete = htmlspecialchars($_POST['rpassword']);
	$url="https://estorias-sem-h-crud.herokuapp.com/register.php";

    if ($password !== $password_repete) {
        $erros[]="<li> Senhas não batem.</li>";
    } else {
        $data = array('newLogin' => $email, 'newPassword' => $password, 'newName' => $username);

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);

        $resultado = (array)json_decode(file_get_contents($url, false, $context));


        
        if ($resultado["success"] == 1) {    
            header('Location: login.php');	
        } else {
            $erros[]="<li>" . $resultado["error"] . ".</li>";
        }
    }
}

?>
<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="cadastr">
        <h1>Cadastro</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <label for="username">Usuário:</label>
            <input type="text" name="username">
            <br>
            <label for="email">Email:</label>
            <input type="text" name="email">
            <br>
            <label for="password">Senha:</label>
            <input type="text" name="password">
            <br>
            <label for="rpassword">Repita a Senha:</label>
            <input type="text" name="rpassword">
            <br>
            <input type="submit" name="btn-cadastrar" value="Cadastrar" id="botao" class="waves-effect waves-light btn">
        </form>
    </div>
</article>

<?php include_once "footer.php"; ?>
