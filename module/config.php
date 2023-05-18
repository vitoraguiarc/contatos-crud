<?php

//função para converter um array em formato json
function createJSON($arrayDados){

    if($arrayDados != null){

        /*Configura o padrão da conversão para o formato JSON. */
        header('Content-Type: application/json');

        /*Converte um array para JSON.*/
        $jsonDados = json_encode($arrayDados);

        /*json_decode(): converte um JSON para array */

        return $jsonDados;
    
    }else{
        return false;
    }

}


?>