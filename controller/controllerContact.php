<?php
    function inserirContato($dadosContato)
    {
        if (!empty($dadosContato)) {

            if (!empty($dadosContato[0]['nome']) && !empty($dadosContato[0]['dataNascimento']) && !empty($dadosContato[0]['email']) 
            && !empty($dadosContato[0]['profissao']) && !empty($dadosContato[0]['telefone']) && 
            !empty($dadosContato[0]['celular'])) {

                

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

                require_once('../model/db/contato.php');

                if (insertContato($arrayDados))
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
        
    function listarContato()
    {
        require_once('../model/db/contato.php');

        $dados = selectAllContatos();

        if (!empty($dados))
            return $dados;
        else
            return false;
    }

    function buscarContato($id)
    {

        if ($id != 0 && !empty($id) && is_numeric($id)) {

            require_once('../model/db/contato.php');

            $dados = selectByIdContato($id);

            if (!empty($dados))
                return $dados;
            else
                return false;
        } else {
            return array(
                'idErro'  => 4,
                'message' => 'Não é possível buscar um registro sem informar um id válido'
            );
        }
    }

    function excluirContato($id)
    {
        if ($id != 0 && !empty($id) && is_numeric($id)) {

            require_once('../model/db/contato.php');

            if (deleteContato($id)) {

                return true;
            } else
                return array(
                    'idErro'  => 3,
                    'message' => 'O banco não pode excluir o registro'
                );
        } else
            return array(
                'idErro'  => 4,
                'message' => 'Não é possível excluir um registro sem informar um id válido'
            );
    }

    function atualizarContato($dadosContato)
    {
        //Recebe o id enviado pelo arrayDados
        $idContato = $dadosContato['id'];

        if (!empty($dadosContato)) {

            if (!empty($dadosContato[0]['nome'])) {

                if (!empty($idContato) && $idContato != 0 && is_numeric($idContato)) {

                    $arrayDados = array(
                        "id"        => $idContato,
                        "nome"      => $dadosContato[0]['nome'],
                        "dataNascimento"        => $dadosContato[0]['dataNascimento'],
                        "email"       => $dadosContato[0]['email'],
                        "profissao"       => $dadosContato[0]['profissao'],
                        "telefone"    => $dadosContato[0]['telefone'],
                        "celular"        => $dadosContato[0]['celular'],
                        "wppNotificacoes"       => $dadosContato[0]['wppNotificacoes'],
                        "emailNotificacoes"       => $dadosContato[0]['emailNotificacoes'],
                        "smsNotificacoes"    => $dadosContato[0]['smsNotificacoes'],
                    );

                    require_once('../model/db/contato.php');

                    if (updateContato($arrayDados)) {
                        return true;

                    } else
                        return array(
                            'idErro'  => 1,
                            'message' => 'Não foi possível atualizar os dados no Banco de Dados'
                        );
                } else
                    return array(
                        'idErro'  => 4,
                        'message' => 'Não é possível editar um registro sem informar um id válido'
                    );
            } else
                return array(
                    'idErro'  => 2,
                    'message' => 'Existem campos obrigatórios que não foram inseridos'
                );
        }
    }


?>