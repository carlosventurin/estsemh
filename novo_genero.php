<?php 
include_once "header.php"; 
include_once "utils.php"; 

session_start();

if (isset($_POST['btn-genero'])) {
	//echo "Clicou";
	$erros = array();
	//mysqli_escape_string - função que limpa os dados e evita sqlinjection e outros caracteres indevidos.
	$genero = $_POST["genero"];

    $genero = filter_var($genero, FILTER_SANITIZE_STRING);

    $data = array(
        'nome' => $genero, 
    );

    $resultado = post("/genders/create_gender.php", $data);
    
    header('Location: generos.php');	
}
?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="comentar">
        <h1>Escrever Gênero</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
            <label for="genero">Novo Gênero:</label>
            <input type="text" name="genero"></input>
            <br>
            <input type="submit" name="btn-genero" value="Enviar" id="botao" class="waves-effect waves-light btn">
        </form>
    </div>
</article>

<?php include_once "footer.php"; ?>
