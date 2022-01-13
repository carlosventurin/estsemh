<?php 
include_once "header.php";

session_start();

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

        <table class="striped">
        <?php
            foreach ($comments["data"] as $comment) {
                ?>
                <tr>
                    <td style="width: 50px;"><img src='<?php echo $comment->linkfotousuario?>' alt='Foto de perfil de <?php echo $comment->nomusuario ?>' class='responsive-img' width=50 height=50></td>
                    
                    <td>    
                        <span class='black-text'>
                            <b><a href='usuario.php?id_user=<?php echo $comment->idusuario?>'><?php echo $comment->nomusuario ?></b>
                        </span>
                        <br>
                        <span class='black-text'>
                            <?php echo $comment->dsccorpocoment ?>
                        </span>
                    </td>

                     
                    <?php
                    if ($comment->idusuario == $_SESSION['id_usuario']) {
                    ?>
                        <td><a href="editar_classificacao.php?id_classif=<?php echo $indicacao->idclassificacao;?>" class="btn-floating orange"><i class="material-icons">edit</i></a></td>
                        <td><a href="#modal<?php echo $indicacao->idclassificacao;?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>
                        <!-- Modal Structure -->
                        <div id="modal<?php echo $indicacao->idclassificacao;?>" class="modal">
                            <div class="modal-content">
                                <h3>Atenção!</h3>
                                <p>Deseja excluir essa classificação?</p>
                            </div>
                            <div class="modal-footer">
                                <form action="excluir.php" method="POST">
                                    <input type="hidden" name="id_classif" value="<?php echo $indicacao->idclassificacao;?>">
                                    <button type="submit" name="btn-deletar" class="btn red">Sim, quero deletar</button>
                                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                                </form>
                            </div>
                        </div>

                    <?php } else { ?>
                        <td></td>
                        <td></td>

                    <?php } ?>
                </tr>
                <?php
            }
        ?>
        </div>
    </div>
</article>

<?php 
include_once "footer.php";
?>