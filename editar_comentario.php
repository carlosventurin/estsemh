<?php 
include_once "header.php"; 
include_once "utils.php"; 

session_start();

$comment = consultar("/comments/get_comment.php?id=" . $_GET["id_comment"]);

if (isset($_POST['btn-comentar'])) {
	$erros = array();
	
    if (filter_var($_POST["idcomment"], FILTER_VALIDATE_INT)) {
        $id = $_POST["idcomment"];
        $comment = filter_var($_POST['corpo'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

        $data = array(
            'id' => $id,
            'corpo' => $comment,
        );
        
        $resultado = post("/comments/update_comment.php", $data);
        
        $comment = consultar("/comments/get_comment.php?id=" . $id);
        header('Location: comentarios.php?id_story=' . $comment['idhist']);	
    } else {
        $erros[] = "<li> ID deve ser um número inteiro </li>";
    }
}

?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="comentar">
        <h1>Editar Comentário</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
            <label for="corpo">Comentário:</label>
            <input type="text" name="corpo" value="<?php echo filter_var($comment['dsccorpocoment'], FILTER_SANITIZE_STRING)?>"></input>
            <input type="hidden" name="idcomment" value="<?php echo $comment['idcoment'];?>">
            <br>
            <input type="submit" name="btn-comentar" value="Enviar" id="botao" class="waves-effect waves-light btn">
        </form>
    </div>
</article>

<?php include_once "footer.php"; ?>
