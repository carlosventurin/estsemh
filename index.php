<?php 
include_once "header.php";
include_once "utils.php";

session_start();

// se não existir a sessão logado
if (!isset($_SESSION['logado'])) {
	header('Location: login.php');
}

$stories = consultar("/stories/get_stories.php");
?>

<!-- Prévia da história criada por um usuário -->
<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="ind">
        <h1>Histórias</h1>
        <?php
        if (!empty($stories["data"])) {
            foreach ($stories["data"] as $story){
                echo "<a href='./historia.php?id=$story->idhist'><b><h5>$story->nomhist</h5></b><hr></a><br>";
                echo "<i>$story->classificacao</i><br>";
                echo "<p>$story->dscsinopsehist</p><hr>";
            }
        } else {
            echo "<h3>Nenhuma história encontrada</h3>";
        }
        ?>
    </div>
</article>

<?php 
include_once "footer.php";
?>