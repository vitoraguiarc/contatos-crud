<?php
require_once('./vendor/autoload.php');

$app = new \Slim\App();   

// EndPoint para listagem de todos os contatos
$app->get('/contato', function ($request, $response, $args) {

    require_once('../module/config.php');
    require_once('../controller/controllerContact.php');

    if ($dados = listarContato()) 
    {

        if ($dadosJSON = createJSON($dados)) 
        {
            return $response->withStatus(200)
                            ->withHeader('Content-Type', 'application/json')
                            ->write($dadosJSON);
        }
    } else 
    {
        return  $response ->withStatus(404)
        ->withHeader('Content-Type', 'application/json')
        ->write('{"message" : "Nenhum cliente encontrado"}');
    }

});

// EndPoint para listar contato pelo id
$app->get('/contato/{id}', function ($request, $response, $args) {

    $id = $args['id'];

    require_once('../module/config.php');
    require_once('../controller/controllerContact.php');

    if ($dados = buscarContato($id)) {

        if (!isset($dados['idErro'])) {

            if ($dadosJSON = createJSON($dados)) {

                return $response->withStatus(200)
                                ->withHeader('Content-Type', 'application/json')
                                ->write($dadosJSON);
            }
        } else {

            $dadosJSON = createJSON($dados);

            return $response->withStatus(404)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message": "Dados inválidos",
                                      "Erro": ' . $dadosJSON . '
                                     }');
        }
    } else {

        return $response->withStatus(404)
                        ->withHeader('Content-Type', 'application/json')
                        ->write('{"message": "Item não encontrado"}');
    }

});

// EndPoint para deletar um contato
$app->delete('/contato/{id}', function ($request, $response, $args) {

    if (is_numeric($args['id'])) {

        $id = $args['id'];

        require_once('../module/config.php');
        require_once('../controller/controllerContact.php');
        if (buscarContato($id)) {

            $resposta = excluirContato($id);

            if (is_bool($resposta) && $resposta ==  true) {

                return $response->withStatus(200)
                    ->withHeader('Content-Type', 'application/json')
                    ->write('{"message": "Registro excluído com sucesso!"}');
            } elseif (is_array($resposta) && isset($resposta['idErro'])) {

                    $dadosJSON = createJSON($resposta);

                    return $response->withStatus(404)
                        ->withHeader('Content-Type', 'application/json')
                        ->write('{"message": "Houve um problema no processo de excluir",
                                      "Erro": ' . $dadosJSON . '
                                     }');
            }
        } else {

            return $response->withStatus(404)
                ->withHeader('Content-Type', 'application/json')
                ->write('{"message": "O ID informado não existe na base de dados."}');
        }
    } else {

        return $response->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->write('{"message": "É obrigatório um ID com formato válido (número)"}');
    }

});

// EndPoint para inserir um novo contato
$app->post('/contato', function ($request, $response, $args) {

    $contentTypeHeader = $request->getHeaderLine('Content-Type');

    $contentType = explode(";", $contentTypeHeader);

    switch ($contentType[0]) {
        case 'application/json':

            $dadosBody = $request->getParsedBody();

            require_once('../module/config.php');
            require_once('../controller/controllerContact.php');

            $arrayDados = array(
                $dadosBody
            );

            $resposta = inserirContato($arrayDados);

            if (is_bool($resposta) && $resposta == true) {

                return $response->withStatus(201)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('{"message": "Registro inserido com sucesso."}');
            } elseif (is_array($resposta) && $resposta['idErro']) {

                $dadosJSON = createJSON($resposta);

                return $response->withStatus(400)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('{"message": "Houve um problema no processo de inserir.",
                                          "Erro": ' . $dadosJSON . '
                                        }');
            }

            break;

        default:

            return $response->withStatus(400)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message": "Formato do Content-Type não é válido para esta requisição."}');

            break;
    }

});

// EndPoint para atualizar um contato
$app->post('/contato/{id}', function ($request, $response, $args) {

    if (is_numeric($args['id'])) {

        $id = $args['id'];

        require_once('../module/config.php');
        require_once('../controller/controllerContact.php');

        $contentTypeHeader = $request->getHeaderLine('Content-Type');

        $contentType = explode(";", $contentTypeHeader);

        switch ($contentType[0]) {

            case 'application/json':

                if (buscarContato($id)) {

                    $dadosBody = $request->getParsedBody();

                    $arrayDados = array(
                        $dadosBody,
                        "id"    => $id
                    );

                    $resposta = atualizarContato($arrayDados);

                    if (is_bool($resposta) && $resposta == true) {

                        return $response->withStatus(201)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message": "Registro atualizado com sucesso."}');
                    } elseif (is_array($resposta) && $resposta['idErro']) {

                        $dadosJSON = createJSON($resposta);

                        return $response->withStatus(400)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message": "Houve um problema no processo de atualizar.",
                                            "Erro": ' . $dadosJSON . '
                                            }');
                    }
                } else {
                    return $response->withStatus(404)
                        ->withHeader('Content-Type', 'application/json')
                        ->write('{"message": "O ID informado não existe na base de dados."}');
                }

                break;
        }
    } else {

        return $response->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->write('{"message": "É obrigatório um ID com formato válido (número)"}');
    }
    
});
    



$app->run();