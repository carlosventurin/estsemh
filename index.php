<?php 
include_once "header.php";

session_start();

// se não existir a sessão logado
if (!isset($_SESSION['logado'])):
	header('Location: login.php');
endif;

$url="https://estorias-sem-h-crud.herokuapp.com/users/get_user.php?id=" . $_SESSION["id_usuario"];

$usuario = (array)json_decode(file_get_contents($url));

$url="https://estorias-sem-h-crud.herokuapp.com/stories/get_stories.php";

$stories = (array)json_decode(file_get_contents($url));

//fechando a conexão depois de armazenar os dados
?>

<!-- Prévia da história criada por um usuário -->
<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5">
        <?php

        foreach ($stories["data"] as $story){
            echo "Ator: " . $story->nomhist . "<br>";
            echo "<hr>";
        }

        /*
        $sql="SELECT * FROM historia";
        $resultado= mysqli_query($connect,$sql);
        
        if (mysqli_num_rows($resultado)>0):
            while($dados =mysqli_fetch_array($resultado)):	
            
                ?>
                <div class="historia-preview">
                    <header class="title">
                        <?php echo $dados['nomHist'];?> | <?php 
                        $sql="SELECT * FROM usuario WHERE idUsuario = " . $dados['idUsuario'] . ";";
                        $resultadoUsuario = mysqli_query($connect,$sql);
                        $usuario =mysqli_fetch_array($resultadoUsuario);
                        echo $usuario['nomUsuario'];
                        ?>
                    </header>
                    <hr>
                    <?php echo $dados['dscSinopseHist'];?>
                </div>
            <?php endwhile; 
        endif;*/
        ?>
    </div>
</article>

<?php 
include_once "footer.php";
?>