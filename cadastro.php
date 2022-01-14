<?php 
include_once "header.php";
include_once "utils.php"; 

if (isset($_POST['btn-cadastrar'])) {
    define('MULTIPART_BOUNDARY', '--------------------------'.microtime(true));

	//echo "Clicou";
	$erros = array();
	$newLogin = htmlspecialchars($_POST['newLogin']);

    if (filter_var($newLogin, FILTER_VALIDATE_EMAIL)) {
        $newLogin = filter_var($newLogin, FILTER_SANITIZE_EMAIL);
        $newName = filter_var($_POST['newName'], FILTER_SANITIZE_STRING);

        // A senha é criptografada no backend (olhe crud/register.php)
        $password = filter_var($_POST['newPassword'], FILTER_SANITIZE_STRING);
        $password_repete = filter_var($_POST['rpassword'], FILTER_SANITIZE_STRING);

        $url = BASE_URL . "/register.php";

        if ($password !== $password_repete) {
            $erros[]="<li> Senhas não batem.</li>";
        } else {
            $data = ""; 
            $boundary = "---------------------".substr(md5(rand(0,32000)), 0, 10); 
            
            //Collect Postdata 
            foreach($_POST as $key => $val) 
            {
                if ($key != "rpassword") {
                    $data .= "--$boundary\n"; 
                    $data .= "Content-Disposition: form-data; name=\"".$key."\"\n\n".$val."\n"; 
                }
            }

            $data .= "--$boundary\n"; 
        
            $fileContents = file_get_contents($_FILES['newPhoto']['tmp_name']); 
            
            $data .= "Content-Disposition: form-data; name=\"newPhoto\"; filename=\"{$_FILES['newPhoto']['name']}\"\n"; 
            $data .= "Content-Type: image/jpeg\n"; 
            $data .= "Content-Transfer-Encoding: binary\n\n"; 
            $data .= $fileContents."\n"; 
            $data .= "--$boundary\n";

            $options = array(
                'http' => array(
                    'header'  => "Content-type: multipart/form-data; boundary=$boundary\r\n",
                    'method'  => 'POST',
                    'content' => $data
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
    } else {
        $erros[]="<li>Email inválido.</li>";
    }
}

?>
<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="cadastr">
        <h1>Cadastro</h1>
        <?php 
        if(!empty($erros)):
			foreach($erros as $erro):
				echo $erro;
			endforeach;
		endif;
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
            <label for="newName">Usuário:</label>
            <input type="text" name="newName">
            <br>
            <label for="newLogin">Email:</label>
            <input type="email" name="newLogin">
            <br>
            <label for="newPassword">Senha:</label>
            <input type="password" name="newPassword">
            <br>
            <label for="rpassword">Repita a Senha:</label>
            <input type="password" name="rpassword">
            <br>
            <label for="newPhoto">Foto de Perfil</label>
            <input type="file" name="newPhoto" accept="image/png, image/jpeg">
            <br>
            <input type="submit" name="btn-cadastrar" value="Cadastrar" id="botao" class="waves-effect waves-light btn">
        </form>
    </div>
</article>

<?php include_once "footer.php"; ?>
