<?php
//echo "Clicou";
$erros = array();
//mysqli_escape_string - função que limpa os dados e evita sqlinjection e outros caracteres indevidos.
if (isset($_GET['id_story'])) {
    $id_hist = $_GET['id_story'];

    $url = "https://estorias-sem-h-crud.herokuapp.com/stories/delete_story.php";

    $data = array(
        'id' => $id_hist
    );

    $resultado = post($url, $data);

    header('Location: index.php');	
}

?>