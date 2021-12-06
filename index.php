<?php 
include_once "header.php";
include_once 'dbconnect.php';
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
            <?php echo $dados['nomHist'];?>
        </header>
        <hr>
        <?php echo $dados['dscCorpoHist'];?>
        </div>
        <?php endwhile; 
    endif;
    ?>
</article>

<?php 
include_once "footer.php";
?>