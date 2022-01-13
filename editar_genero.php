<?php 
include_once "header.php"; 
include_once "utils.php"; 

session_start();

$gender_to_update = consultar("/genders/get_gender.php?id=" . $_GET["id_gender"]);

if (isset($_POST['btn-genero'])) {
	//echo "Clicou";
	$erros = array();

    $idgenero = $_POST['idgenero'];
    $genero = $_POST["genero"];

    $data = array(
        'id' => $idgenero,
        'nome' => $genero, 
    );

    $resultado = post("/genders/update_gender.php", $data);
    
    header('Location: generos.php');	
}
?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="comentar">
        <h1>Editar Gênero</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
            <label for="genero">Nome Gênero:</label>
            <input type="text" name="genero" value='<?php echo $gender_to_update['dscgenero']?>'></input>
            <input type="hidden" name="idgenero" value="<?php echo $gender_to_update['idgenero'];?>">
            <br>
            <input type="submit" name="btn-genero" value="Enviar" id="botao" class="waves-effect waves-light btn">
        </form>
    </div>
</article>

<?php include_once "footer.php"; ?>
