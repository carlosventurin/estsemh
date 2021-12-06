<?php 
include_once "header.php";
include_once 'dbconnect.php';

session_start();

// se não existir a sessão logado
if (!isset($_SESSION['logado'])):
	header('Location: login.php');
endif;


//Dados
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuario WHERE idUsuario='$id'";
$resultadoa= mysqli_query($connect,$sql);
//transforma a variavel resultado em array 
$dadoasds =mysqli_fetch_array($resultadoa);

echo $dadoasds['nomUsuario'];
//fechando a conexão depois de armazenar os dados
?>

<!-- Prévia da história criada por um usuário -->
<article>
    <?php
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
    endif;
    ?>
</article>

<?php 
include_once "footer.php";
?>