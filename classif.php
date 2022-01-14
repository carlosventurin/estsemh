<?php 
include_once "header.php";

$url="/classificacoes/get_classificacoes.php";
$classif = consultar($url);
?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="indic">
        <h1>Classificações Indicativas</h1> <a href="nova_classificacao.php"><button class="btn">Adicionar Classificação</button></a>
        <table class="striped">
        <?php
            foreach ($classif["data"] as $indicacao) {
                ?>
                <tr>
                    <td><a href= '/index.php?classificacao=<?php echo $indicacao->dscclassificacao ?>'><b><h5><?php echo $indicacao->dscclassificacao?></h5></b></a></td>
                    
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
                </tr>
                <?php
            }
        ?>
        </table>
    </div>
</article>


<?php 
include_once "footer.php";
?>