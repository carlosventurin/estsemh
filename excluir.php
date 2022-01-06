<?php
//echo "Clicou";
$erros = array();
//mysqli_escape_string - função que limpa os dados e evita sqlinjection e outros caracteres indevidos.
$id_hist = $_GET['id_story'];

$url = "https://estorias-sem-h-crud.herokuapp.com/stories/delete_story.php";

$data = array(
    'id' => $id_hist
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

header('Location: index.php');	

?>