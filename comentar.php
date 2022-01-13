<?php 
include_once "header.php"; 
include_once "utils.php"; 

session_start();

if (isset($_POST['btn-comentar'])) {
	//echo "Clicou";
	$erros = array();
	//mysqli_escape_string - função que limpa os dados e evita sqlinjection e outros caracteres indevidos.
	$comment = htmlspecialchars($_POST['corpo']);
	$id_usuario = $_SESSION["id_usuario"];
    $id_hist = $_SESSION["id_story"];

    $data = array(
        'comment' => $comment, 
        'idusuario' => $id_usuario, 
        'idhist' => $id_hist
    );

    $resultado = post("/comments/create_comment.php", $data);
    
    header('Location: comentarios.php?id_story=' . $id_hist);	
}

?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="comentar">
        <h1>Escrever Comentário</h1>
        <form action="/comentar.php?id_story=<?php echo $_GET["id_story"]?>" method="POST">
            <label for="corpo">Comentário:</label>
            <input type="text" name="corpo"></input>
            <br>
            <input type="submit" name="btn-comentar" value="Enviar" id="botao" class="waves-effect waves-light btn">
        </form>
    </div>
</article>

<?php include_once "footer.php"; ?>
