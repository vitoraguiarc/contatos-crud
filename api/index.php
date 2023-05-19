<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Header: Content-Type');
header('Content-Type: application/json');

$urlHTTP = (string) $_GET['url'];

$url = explode('/', $urlHTTP);

switch (strtoupper($url[0])) {

    case 'CONTATO':
        require_once('contatoAPI.php');
        break;
}

?>