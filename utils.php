<?php

function consultar($url) {
    return (array)json_decode(file_get_contents($url));
}

function post($url, $data) {
    
}