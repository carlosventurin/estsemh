<?php 
include_once "header.php";
include_once "utils.php";

session_start();

$url="/stories/get_story.php?id=" . $_GET["id"];
$story = consultar($url);

$url="/users/get_user.php?id=" . $story["idusuario"];
$usuario = consultar($url);
?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="vishist">
        <?php
            echo "<b class='center-align'><h5>".$story['nomhist']."</h5></b>";
            echo "<i>Autor: <a href='usuario.php?id_user=" . $usuario['idusuario'] . "'>". $usuario['nomusuario'] . "</a></i><br><br>";
            echo str_replace("\n", "<br>", $story['dsccorpohist']) . "<br>";
        ?>

        <br>

        <a href="comentarios.php?id_story=<?php echo $story["idhist"] ?>">
            <button class="btn waves-effect waves-light">Comentários</button>
        </a>

        <?php 
        if ($story["idusuario"] == $_SESSION['id_usuario']) {
            ?>
                <td><a href="#modal<?php echo $story['idhist']?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>
            
                <!-- Modal Structure -->
                <div id="modal<?php echo $story['idhist']?>" class="modal">
                    <div class="modal-content">
                    <h3>Atenção!</h3>
                    <p>Deseja excluir essa história?</p>
                    </div>
                    <div class="modal-footer">
                    
                    <form action="excluir.php" method="POST">
                        <input type="hidden" name="id_story" value="<?php echo $story['idhist']?>">
                        <button type="submit" name="btn-deletar" class="btn red">Sim, quero deletar</button>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                    </form>
                    </div>
                </div>
            <?php
        }?>
    </div>
</article>

<?php 
include_once "footer.php";
?>