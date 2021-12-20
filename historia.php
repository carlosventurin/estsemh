<?php 
include_once "header.php";

$url="https://estorias-sem-h-crud.herokuapp.com/stories/get_story.php?id=" . $_GET["id"];
$story = (array)json_decode(file_get_contents($url));

// $url="https://estorias-sem-h-crud.herokuapp.com/users/get_user.php?id=" . $story["idusuario"];
// $user = (array)json_decode(file_get_contents($url));
?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5">
        <?php
            echo "<b><h5>".$story['nomhist']."</h5></b><br>";
            echo $story['dsccorpohist'] . "<br>";
            echo "<hr>";
        ?>
    </div>
</article>
