<?php 
include_once "header.php";
include_once "utils.php";

$url="/genders/get_genders.php";
$genders = consultar($url);

?>

<!-- Tabela com dados de usuários -->
<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="ind">
        <h1>Gêneros</h1> <a href="novo_genero.php"><button class="btn">Adicionar Gênero</button></a>
        <table class="striped">
            <?php
                foreach ($genders["data"] as $gender){
                    ?>
                    <tr>
                        <td><a href='/index.php?gender=<?php echo $gender->dscgenero?>'><b><h5><?php echo $gender->dscgenero?></h5></b></a></td>
                        <td><a href="editar_genero.php?id_gender=<?php echo $gender->idgenero;?>" class="btn-floating orange"><i class="material-icons">edit</i></a></td>

                        <td><a href="#modal<?php echo $gender->idgenero;?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>
				
                        <!-- Modal Structure -->
                        <div id="modal<?php echo $gender->idgenero;?>" class="modal">
                            <div class="modal-content">
                            <h3>Atenção!</h3>
                            <p>Deseja excluir esse gênero?</p>
                            </div>
                            <div class="modal-footer">
                            
                            <form action="excluir.php" method="POST">
                                <input type="hidden" name="id_gender" value="<?php echo $gender->idgenero;?>">
                                <button type="submit" name="btn-deletar" class="btn red">Sim, quero deletar</button>
                                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                            </form>
                            </div>
                        </div>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
</article>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems, options);
});
</script>

<?php 
include_once "footer.php";
?>