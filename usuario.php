<?php 
include_once "header.php";
include_once "utils.php";

session_start();

$usuario = consultar("https://estorias-sem-h-crud.herokuapp.com/users/get_user.php?id=" . $_GET["id_user"]);
$stories = consultar("https://estorias-sem-h-crud.herokuapp.com/stories/get_stories.php?id_user=" . $_GET["id_user"]);
?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="vishist">
        <?php
            echo "<p><b><h1>".$usuario['nomusuario']."</h1></b><img src='".$usuario['linkfotousuario']."' width=200 heigth=200 align='center'><p>";
        ?>

        <br>

        <?php
            if (isset($stories["data"])) {
                echo "<h3>Histórias do usuário</h3>";
                foreach ($stories["data"] as $story){
                    echo "<a href='./historia.php?id=$story->idhist'><b><h5>$story->nomhist</h5></b><hr></a><br>";
                    echo "<i>$story->classificacao</i><br>";
                    echo "<p>$story->dscsinopsehist</p><hr>";
                }
            } else {
                echo "<h3>Nenhuma história do usuário</h3>";
            }
        ?>
    </div>
</article>

<?php 
include_once "footer.php";
?>