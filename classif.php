<?php 
include_once "header.php";

$url="https://estorias-sem-h-crud.herokuapp.com/classificacoes/get_classificacoes.php";
$classif = (array)json_decode(file_get_contents($url));

?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="indic">
        <h1>Classificações Indicativas</h1>
        <?php
            foreach ($classif["data"] as $indicacao) {
                echo "<a href= './?classificacao=$indicacao->dscclassificacao'><b><h5>$indicacao->dscclassificacao</h5></b><hr></a>";
            }
        ?>
    </div>
</article>


<?php 
include_once "footer.php";
?>