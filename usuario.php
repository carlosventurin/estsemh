<?php 
include_once "header.php";
include_once "utils.php";

session_start();

$usuario = consultar("/users/get_user.php?id=" . $_GET["id_user"]);
$stories = consultar("/stories/get_stories.php?id_user=" . $_GET["id_user"]);

$file_extention = explode("/",explode(";", $usuario['linkfotousuario'])[0])[1];
?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="vishist">
        
        <p><b><h1><?php echo $usuario['nomusuario'] ?></h1></b><img src="<?php echo $usuario['linkfotousuario'] ?>" width=200 heigth=200 align='center'><p>
        <!-- donwload image -->
        <a href="<?php echo $usuario['linkfotousuario'] ?>" download="<?php echo $usuario['nomusuario'] . ".". $file_extention?>"><i class="material-icons">file_download</i></a>

        <?php 
        if ($usuario['idusuario'] == $_SESSION['id_usuario']) {
            ?>
                <td><a href="#modal<?php echo $usuario['idusuario']?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>
            
                <!-- Modal Structure -->
                <div id="modal<?php echo $usuario['idusuario']?>" class="modal">
                    <div class="modal-content">
                    <h3>Atenção!</h3>
                    <p>Deseja excluir sua conta? As suas histórias também serão deletadas.</p>
                    </div>
                    <div class="modal-footer">
                    
                    <form action="excluir.php" method="POST">
                        <input type="hidden" name="id_user" value="<?php echo $usuario['idusuario']?>">
                        <button type="submit" name="btn-deletar" class="btn red">Sim, quero deletar</button>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                    </form>
                    </div>
                </div>

            <?php
        }?>

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