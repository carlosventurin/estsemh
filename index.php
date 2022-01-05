<?php 
include_once "header.php";

session_start();

// se não existir a sessão logado
if (!isset($_SESSION['logado'])):
	header('Location: login.php');
endif;

$url="https://estorias-sem-h-crud.herokuapp.com/users/get_user.php?id=" . $_SESSION["id_usuario"];
$usuario = (array)json_decode(file_get_contents($url));

$url="https://estorias-sem-h-crud.herokuapp.com/stories/get_stories.php";

if (isset($_GET['gender'])):
    $url = $url . "?genero=" . $_GET['gender'];
endif;

$stories = (array)json_decode(file_get_contents($url));

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