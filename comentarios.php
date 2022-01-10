<?php 
include_once "header.php";

$url="http://estorias-sem-h-crud.herokuapp.com/comments/get_comments.php?id_story=" . $_GET["id_story"];
$comments = consultar($url);
?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5">
        <h1>Comentários</h1>

        <a href="/comentar.php">
		    <button class="waves-effect waves-light btn">Comentar</button>
        </a>

        <hr>

        <div class="col s11">
        <?php
            foreach ($comments["data"] as $comment){
                echo "
                <div class='row'>
                    <div class='col'>
                        <img src='$comment->linkfotousuario' alt='Foto de perfil de $comment->nomusuario' class='responsive-img' width=50 height=50>
                    </div>
                    <div class='col s10'>
                        <span class='black-text'>
                            <b><a href='usuario.php?id_user=$comment->idusuario'>$comment->nomusuario</b>
                        </span>
                        <br>
                        <span class='black-text'>
                            $comment->dsccorpocoment
                        </span>
                    </div>
                </div>";
            }
        ?>
        </div>
    </div>
</article>

<?php 
include_once "footer.php";
?>