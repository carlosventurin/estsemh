<?php 
include_once "header.php";

$url="https://estorias-sem-h-crud.herokuapp.com/genders/get_genders.php";
$genders = (array)json_decode(file_get_contents($url));


?>
<!-- Tabela com dados de usuários -->
<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="ind">
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