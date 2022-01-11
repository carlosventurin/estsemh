<?php 
include_once "header.php"; 
include_once "utils.php"; 

session_start();

if (isset($_POST['btn-classif'])) {
	//echo "Clicou";
	$erros = array();
	//mysqli_escape_string - função que limpa os dados e evita sqlinjection e outros caracteres indevidos.
	$classif = $_POST["classif"];

    $data = array(
        'nome' => $classif, 
    );

    $resultado = post("https://estorias-sem-h-crud.herokuapp.com/classificacoes/create_classificacao.php", $data);
    
    header('Location: classif.php');
}
?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="comentar">
        <h1>Escrever Classificação</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
            <label for="classif">Nova Classificação:</label>
            <input type="text" name="classif"></input>
            <br>
            <input type="submit" name="btn-classif" value="Enviar" id="botao" class="waves-effect waves-light btn">
        </form>
    </div>
</article>

<?php include_once "footer.php"; ?>
