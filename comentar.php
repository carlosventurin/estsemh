<?php 
include_once "header.php"; 
include_once "utils.php"; 

session_start();

if (isset($_POST['btn-comentar'])) {
	//echo "Clicou";
	$erros = array();

    if (filter_var($_SESSION['id_usuario'], FILTER_VALIDATE_INT) && filter_var($_POST['id_story'], FILTER_VALIDATE_INT)) {
        $comment = filter_var($_POST['corpo'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

        $id_usuario = filter_var($_SESSION["id_usuario"], FILTER_SANITIZE_NUMBER_INT);
        $id_hist = filter_var($_POST["id_story"], FILTER_SANITIZE_NUMBER_INT);
        $data = array(
            'comment' => $comment, 
            'idusuario' => $id_usuario, 
            'idhist' => $id_hist
        );

        $resultado = post("/comments/create_comment.php", $data);
        
        header('Location: comentarios.php?id_story=' . $id_hist);
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
        <h1>Escrever Comentário</h1>
        <form action="/comentar.php?id_story=<?php echo $_GET["id_story"]?>" method="POST">
            <label for="corpo">Comentário:</label>
            <input type="text" name="corpo"></input>
            <input type="hidden" name="id_story" value="<?php echo $_GET["id_story"];?>">
            <br>
            <input type="submit" name="btn-comentar" value="Enviar" id="botao" class="waves-effect waves-light btn">
        </form>
    </div>
</article>

<?php include_once "footer.php"; ?>
