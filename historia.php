<?php 
include_once "header.php";

session_start();

$_SESSION['id_story'] = $_GET["id"];

$url="https://estorias-sem-h-crud.herokuapp.com/stories/get_story.php?id=" . $_GET["id"];
$story = (array)json_decode(file_get_contents($url));

$url="https://estorias-sem-h-crud.herokuapp.com/users/get_user.php?id=" . $story["idusuario"];
$user = (array)json_decode(file_get_contents($url));
?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="vishist">
        <?php
            echo "<b class='center-align'><h5>".$story['nomhist']."</h5></b>";
            echo "<i>Autor: <a href='usuario.php?id_user=" . $user['idusuario'] . "'>". $user['nomusuario'] . "</a></i><br><br>";
            echo str_replace("\n", "<br>", $story['dsccorpohist']) . "<br>";
        ?>

        <br>

        <form action="/comentarios.php?id_story=<?php echo $story["idhist"] ?>">
            <button class="btn waves-effect waves-light" type="submit" name="action">Comentários
            </button>
        </form>

        <?php
            if ($story["idusuario"] == $_SESSION['id_usuario']) {
                echo "<a href='/excluir.php?id_story=".$story["idhist"]."'>";
                echo "<button class='waves-effect waves-light btn red'> Excluir </button>";
                echo "</a>";
            }
        ?>
    </div>
</article>

<?php 
include_once "footer.php";
?>