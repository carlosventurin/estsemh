<?php

include_once "utils.php";

$erros = array();

//Deletar história
if (isset($_POST['id_story'])) {
    $id_story = $_POST['id_story'];

    $url = "/stories/delete_story.php";

    $data = array(
        'id' => $id_story
    );

    $resultado = post($url, $data);

    header('Location: index.php');
} 
//Deletar gênero
else if (isset($_POST['id_gender'])) {
    $id_gen = $_POST['id_gender'];

    $url = "/genders/delete_gender.php";

    $data = array(
        'id' => $id_gen
    );

    $resultado = post($url, $data);

    header('Location: generos.php');	
} 
//Deletar classificação
else if (isset($_POST['id_classif'])) {
    $id_classif = $_POST['id_classif'];

    $url = "/classificacoes/delete_classificacao.php";

    $data = array(
        'id' => $id_classif
    );

    $resultado = post($url, $data);

    header('Location: classif.php');	
} 
//Deletar comentário
else if (isset($_POST['id_comment'])) {
    $id_comment = $_POST['id_comment'];

    $url = "/comments/delete_comment.php";

    $data = array(
        'id' => $id_comment
    );

    $resultado = post($url, $data);

    header('Location: comentarios.php?id_story=' . $_POST['id_hist']);		
} 
//Deletar usuário
else if (isset($_POST['id_user'])) {
    $id_user = $_POST['id_user'];

    $url = "/users/delete_user.php";

    $data = array(
        'id' => $id_user
    );

    $resultado = post($url, $data);

    header('Location: logout.php');		
}

?>