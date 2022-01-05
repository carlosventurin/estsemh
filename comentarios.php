<?php 
include_once "header.php";

$url="http://estorias-sem-h-crud.herokuapp.com/comments/get_comments.php?id_story=" . $_GET["id_story"];
$comments = (array)json_decode(file_get_contents($url));
?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5">
        <a href="/comentar.php">
		    <button class="waves-effect waves-light btn">Comentar</button>
        </a>

        <hr>
        <?php
            foreach ($comments["data"] as $comment){
                echo "<p><img src='$comment->linkfotousuario' width=50 heigth=50 align='left'><b>$comment->nomusuario</b><p>";
                echo "$comment->dsccorpocoment<hr>";
            }
        ?>
    </div>
</article>

<?php 
include_once "footer.php";
?>