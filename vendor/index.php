<?php
// Recebe a url digitada na requisição
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