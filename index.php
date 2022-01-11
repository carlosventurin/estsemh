<?php 
include_once "header.php";
include_once "utils.php";

session_start();

// se não existir a sessão logado
if (!isset($_SESSION['logado'])):
	header('Location: login.php');
endif;

$url="https://estorias-sem-h-crud.herokuapp.com/stories/get_stories.php";

if (isset($_GET['gender'])):
    $url = $url . "?genero=" . $_GET['gender'];
elseif (isset($_GET['classificacao'])):
    $url = $url . "?classificacao='" .  urldecode($_GET['classificacao']) . "'";
endif;

$stories = consultar($url);

//fechando a conexão depois de armazenar os dados
?>

<!-- Prévia da história criada por um usuário -->
<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="ind">
        <h1>Histórias</h1>
        <?php
            foreach ($stories["data"] as $story){
                echo "<a href='./historia.php?id=$story->idhist'><b><h5>$story->nomhist</h5></b><hr></a><br>";
                echo "<i>$story->classificacao</i><br>";
                echo "<p>$story->dscsinopsehist</p><hr>";
            }
        ?>
    </div>
</article>

<?php 
include_once "footer.php";
?>