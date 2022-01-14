<?php 
include_once "header.php"; 
include_once "utils.php"; 

session_start();

$classif_to_update = consultar("/classificacoes/get_classificacao.php?id=" . $_GET["id_classif"]);

if (isset($_POST['btn-classif'])) {
	//echo "Clicou";
	$erros = array();

    $idclassif = $_POST['idclassificacao'];
    $classif = filter_var($_POST["classif"], FILTER_SANITIZE_STRING);

    if (filter_var($idclassif, FILTER_VALIDATE_INT)) {
        $idclassif = filter_var($idclassif, FILTER_SANITIZE_NUMBER_INT);
        
        $data = array(
            'id' => $idclassif,
            'nome' => $classif, 
        );
    
        $resultado = post("/classificacoes/update_classificacao.php", $data);
        
        header('Location: classif.php');
    } else {
        $erros[] = "<li> ID deve ser um número inteiro </li>";
    }
}
?>

<article class="row">
    <?php
		if(!empty($erros)):
			foreach($erros as $erro):
				echo $erro;
			endforeach;
		endif;
    ?>
    <div class="col s12 m6 push-m3 z-depth-5" id="comentar">
        <h1>Editar Classificação</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
            <label for="classif">Nome Classificação:</label>
            <input type="text" name="classif" value="<?php echo $classif_to_update['dscclassificacao'];?>"></input>
            <input type="hidden" name="idclassificacao" value="<?php echo $classif_to_update['idclassificacao'];?>">
            <br>
            <input type="submit" name="btn-classif" value="Enviar" id="botao" class="waves-effect waves-light btn">
        </form>
    </div>
</article>

<?php include_once "footer.php"; ?>
