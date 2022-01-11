<?php

function consultar($url) {
    return (array)json_decode(file_get_contents($url));
}

function post($url, $data) {
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context  = stream_context_create($options);

    return (array)json_decode(file_get_contents($url, false, $context));
}

function entrar($login, $senha, $erros) {
    $url="https://estorias-sem-h-crud.herokuapp.com/login.php";

    $opts = array(
		'http'=> array(
            'method'=>"GET",
            'header' => "Authorization: Basic " . base64_encode("$login:$senha")                 
		)
	);
	
  	$context = stream_context_create($opts);

	return (array)json_decode(file_get_contents($url, false, $context));
}