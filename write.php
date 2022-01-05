<?php include_once "header.php"; 

session_start();

if (isset($_POST['btn-comentar'])) {
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
        $data = array(
            'newLogin' => $email, 
            'newPassword' => $password, 
            'newName' => $username
        );

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

$url="https://estorias-sem-h-crud.herokuapp.com/classificacoes/get_classificacoes.php";
$classifs = (array)json_decode(file_get_contents($url));

$url="https://estorias-sem-h-crud.herokuapp.com/genders/get_genders.php";
$genders = (array)json_decode(file_get_contents($url));

?>
<!-- <script>
    $(document).ready(function() {
    $('select').formSelect();
    // Old way
    // $('select').material_select();
});
</script> -->
<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="comentar">
        <h1>Escrever História</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <label for="title">Título:</label>
            <input type="text" name="title">
            <br>
            <label for="gender">Gênero:</label>
            <select id="gender" name="gender" class="browser-default">
                <?php
                    foreach ($genders["data"] as $gender){
                        echo "<option value='". $gender->dscgenero ."'>" . $gender->dscgenero . "</option>";
                    }
                ?>
            </select>
            <br>
            <label for="classif">Classificação Indicativa:</label>
            <select id="classif" name="classif" class="browser-default">
                <?php
                    foreach ($classifs["data"] as $classif){
                        echo "<option value='". $classif->dscclassificacao ."'>" . $classif->dscclassificacao . "</option>";
                    }
                ?>
            </select>
            <br>
            <label for="corpo">Texto</label>
            <textarea value="corpo" name="txtArea" class="materialize-textarea" style="height: 200px;"></textarea>
            <br>
            <input type="submit" name="btn-comentar" value="Cadastrar" id="botao" class="waves-effect waves-light btn">
        </form>
    </div>
</article>

<?php include_once "footer.php"; ?>