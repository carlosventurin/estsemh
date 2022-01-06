<?php include_once "header.php"; 

session_start();

if (isset($_POST['btn-enviar'])) {
	//echo "Clicou";

	$erros = array();
	//mysqli_escape_string - função que limpa os dados e evita sqlinjection e outros caracteres indevidos.
	$title = htmlspecialchars($_POST['title']);
    $idusuario = $_SESSION["id_usuario"];
    $gender = htmlentities($_POST['gender']);
    $classif = htmlentities($_POST['classif']);
    $sinopse = htmlentities($_POST['sinopse']);
    $corpo = htmlentities($_POST['corpo']);

	$url="https://estorias-sem-h-crud.herokuapp.com/stories/create_story.php";

    $data = array(
        'titulo' => $title, 
        'sinopse' => $sinopse, 
        'corpo' => $corpo,
        'idusuario' => (string)$idusuario,
        'nomclassificacao' => $classif,
        'idcapa' => 3,
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);

    $resultado = (array)json_decode(file_get_contents($url, false, $context));
    
    if ($resultado["message"] == 'Story created.') {
        $url="https://estorias-sem-h-crud.herokuapp.com/generohists/create_generohist.php";

        $id = $resultado["id"];

        $data = array(
            'idhist' => $id, 
            'genero' => $password, 
        );
    
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );

        $context  = stream_context_create($options);
    
        $resultado = (array)json_decode(file_get_contents($url, false, $context));

        header('Location: historia.php?id=' . strval($id));
    } else {
        $erros[]="<li>" . $resultado["error"] . ".</li>";
    }
}

$url="https://estorias-sem-h-crud.herokuapp.com/classificacoes/get_classificacoes.php";
$classifs = (array)json_decode(file_get_contents($url));

$url="https://estorias-sem-h-crud.herokuapp.com/genders/get_genders.php";
$genders = (array)json_decode(file_get_contents($url));

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