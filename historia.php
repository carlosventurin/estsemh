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
    <div class="col s12 m6 push-m3 z-depth-5 center-align" id="vishist">
        <?php
            echo "<b><h5>".$story['nomhist']."</h5></b>";
            echo "<i>Autor:". $user['nomusuario'] . " </i><br><br>";
            echo str_replace("\n", "<br>", $story['dsccorpohist']) . "<br>";
        ?>

        <br>

        <a href="/comentarios.php?id_story=<?php echo $story["idhist"] ?>">
		    <button class="waves-effect waves-light btn"> Comentários </button>
        </a>
    </div>
</article>

<?php 
include_once "footer.php";
?>