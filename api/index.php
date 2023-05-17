<?php

header('Access-Control-Allow-Origin: *');

// Permite ativar os métodos do protocolo HTTP que irão requisitar API
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

// Permite ativar o content-Types das requisições (Formato de dados que será utilizada (JSON, XML, FORK/DATA, etc...))
header('Access-Control-Allow-Header: Content-Type');

// Permite liberar quais content-Types serão utilizadas na API
header('Content-Type: application/json');

// Recebe a Url digitada na requisição
$urlHTTP = (string) $_GET['url'];

// Converte a url requisitada em um array para dividir as opções de busca, que é separa 
$url = explode('/', $urlHTTP);

// Verifica qual API será encaminhada a requisição (cliente, telefone, etc)
switch (strtoupper($url[0])) {

    case 'CONTATO':
        require_once('contatoAPI/index.php');
        break;
}

?>