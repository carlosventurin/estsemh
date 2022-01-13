<?php

include_once "utils.php";

//echo "Clicou";
$erros = array();
//mysqli_escape_string - função que limpa os dados e evita sqlinjection e outros caracteres indevidos.
if (isset($_GET['id_story'])) {
    $id_hist = $_GET['id_story'];

    $url = "/stories/delete_story.php";

    $data = array(
        'id' => $id_hist
    );

    $resultado = post($url, $data);

    header('Location: index.php');
} else if (isset($_POST['id_gender'])) {
    $id_gen = $_POST['id_gender'];

    $url = "/genders/delete_gender.php";

    $data = array(
        'id' => $id_gen
    );

    $resultado = post($url, $data);

    header('Location: generos.php');	
} else if (isset($_POST['id_classif'])) {
    $id_classif = $_POST['id_classif'];

    $url = "/classificacoes/delete_classificacao.php";

    $data = array(
        'id' => $id_classif
    );

    $resultado = post($url, $data);

    header('Location: classif.php');	
}

?>