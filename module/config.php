<?php

function createJSON($arrayDados){

    if($arrayDados != null){

        header('Content-Type: application/json');

        $jsonDados = json_encode($arrayDados);

        return $jsonDados;
    
    }else{
        return false;
    }

}


?>