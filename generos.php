<?php 
include_once "header.php";
include_once "utils.php";

$url="https://estorias-sem-h-crud.herokuapp.com/genders/get_genders.php";
$genders = consultar($url);

?>
<!-- Tabela com dados de usuários -->
<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="ind">
        <h1>Gêneros</h1>
        <?php
            foreach ($genders["data"] as $gender){
                echo "<a href='./?gender=$gender->dscgenero'><b><h5>$gender->dscgenero</h5></b><hr></a>";
            }
        ?>
    </div>
</article>

<?php 
include_once "footer.php";
?>