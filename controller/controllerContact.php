<?php
    function inserirContact($dadosContato)
    {

        if (!empty($dadosContato)) {

            if (!empty($dadosContato[0]['nome']) && !empty($dadosContato[0]['dataNascimento']) && !empty($dadosContato[0]['email']) 
            && !empty($dadosContato[0]['profissao']) && !empty($dadosContato[0]['telefone']) && 
            !empty($dadosContato[0]['celular']) && !empty($dadosContato[0]['wppNotificacoes']) &&
            !empty($dadosContato[0]['emailNotificacoes']) && !empty($dadosContato[0]['smsNotificacoes'])) {

                $arrayDados = array(
                    "nome"      => $dadosContato[0]['nome'],
                    "dataNascimento"       => $dadosContato[0]['dataNascimento'],
                    "email"        => $dadosContato[0]['email'],
                    "profissao"       => $dadosContato[0]['profissao'],
                    "telefone"    => $dadosContato[0]['telefone'],
                    "celular"       => $dadosContato[0]['celular'],
                    "wppNotificacoes"        => $dadosContato[0]['wppNotificacoes'],
                    "emailNotificacoes"       => $dadosContato[0]['emailNotificacoes'],
                    "smsNotificacoes"    => $dadosContato[0]['smsNotificacoes'],

                );

                require_once(SRC . './model/contato.php');

                if (insertCliente($arrayDados))
                    return true;
                else
                    return array(
                        'idErro'  => 1,
                        'message' => 'Não foi possível inserir os dados no Banco de Dados'
                    );
            } else
                return array(
                    'idErro'  => 2,
                    'message' => 'Existem campos obrigatórios que não foram inseridos'
                );
        }
    }
?>