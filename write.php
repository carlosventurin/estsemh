<?php 
include_once "header.php";
include_once "utils.php"; 

session_start();

if (isset($_POST['btn-enviar'])) {

	$erros = array();

    if (filter_var($_SESSION["id_usuario"], FILTER_VALIDATE_INT)) {
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $idusuario = filter_var($_SESSION["id_usuario"], FILTER_SANITIZE_NUMBER_INT);
        $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
        $classif = filter_var($_POST['classif'], FILTER_SANITIZE_STRING);
        $sinopse = filter_var($_POST['sinopse'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        $corpo = filter_var($_POST['corpo'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

        $data = array(
            'titulo' => $title, 
            'sinopse' => $sinopse, 
            'corpo' => $corpo,
            'idusuario' => (string)$idusuario,
            'nomclassificacao' => $classif,
            'idcapa' => 3,
        );

        $resultado = post("/stories/create_story.php", $data);

        if ($resultado["message"] == 'Story created.') {
            $id = $resultado["id"];

            $data = array(
                'id_story' => $id, 
                'genero' => $gender, 
            );
        
            $resultado = post("/generohists/create_generohist.php", $data);

            header('Location: historia.php?id=' . strval($id));
        } else {
            $erros[]="<li>" . $resultado["error"] . ".</li>";
        }
    }
}

$classifs = consultar("/classificacoes/get_classificacoes.php");
$genders = consultar("/genders/get_genders.php");
?>

<article class="row">
    <div class="col s12 m6 push-m3 z-depth-5" id="comentar">
        <h1>Escrever História</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <label for="title">Título:</label>
            <input type="text" name="title">
            <br>
            <label for="gender">Gênero:</label>
            <select id="gender" name="gender" class="browser-default">
                <?php
                    foreach ($genders["data"] as $gender){
                        echo "<option value='". $gender->dscgenero ."'>" . $gender->dscgenero . "</option>";
                    }
                ?>
            </select>
            <br>
            <label for="classif">Classificação Indicativa:</label>
            <select id="classif" name="classif" class="browser-default">
                <?php
                    foreach ($classifs["data"] as $classif){
                        echo "<option value='". $classif->dscclassificacao ."'>" . $classif->dscclassificacao . "</option>";
                    }
                ?>
            </select>
            <br>
            <label for="sinopse">Sinopse:</label>
            <input type="text" name="sinopse" class="materialize-textarea"></input>
            <br>
            <label for="corpo">Texto</label>
            <textarea value="corpo" name="corpo" class="materialize-textarea" style="height: 200px;"></textarea>
            <br>
            <input type="submit" name="btn-enviar" value="Cadastrar" id="botao" class="waves-effect waves-light btn">
        </form>
    </div>
</article>

<?php include_once "footer.php"; ?>