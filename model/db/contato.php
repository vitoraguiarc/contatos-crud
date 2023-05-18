<?php
//Import do arquivo que estabelece a conexão com o BD
require_once('connectionMySql.php');

//Função para realizar o insert no BD
function insertContato($dadosContato) {
    
    //Declaração de varaiavel para utilização no return desta função
    $statusResposta = (boolean) false;

    //Abre a conexão com o BD
    $conexao = conexaoMysql();

    //Monta o script para enviar os dados
    $sql = "insert into tbl_contato
                (nome,
                 dataNascimento,
                 email,
                 profissao,
                 telefone,
                 celular,
                 wppNotificacoes,
                 emailNotificacoes,
                 smsNotificacoes)
            values
                ('".$dadosContato['nome']."',
                '".$dadosContato['dataNascimento']."',
                '".$dadosContato['email']."',
                '".$dadosContato['profissao']."',
                '".$dadosContato['telefone']."',
                '".$dadosContato['celular']."',
                '".$dadosContato['wppNotificacoes']."',
                '".$dadosContato['emailNotificacoes']."',
                '".$dadosContato['smsNotificacoes']."'
            ); ";
    
        
    //Executa o scriipt no BD
    //Validação para verificar se o script esta correto
    if (mysqli_query($conexao, $sql)) {

        //Validação para verificar se uma linha foi acrescentada no BD
        if (mysqli_affected_rows($conexao)) 
            $statusResposta = true; 
       
        fecharConexaoMysql($conexao);
        return $statusResposta;
    } 
        
    
        
}

// //Função para realizar o update no BD
function updateContato($dadosContato) {
    
    //Declaração de varaiavel para utilização no return desta função
    $statusResposta = (boolean) false;

    //Abre a conexão com o BD
    $conexao = conexaoMysql();

    //Monta o script para enviar os dados
    $sql = "update tbl_contato set
                 nome     = '".$dadosContato['nome']."',
                 dataNascimento = '".$dadosContato['dataNascimento']."',
                 email  = '".$dadosContato['email']."',
                 profissao    = '".$dadosContato['profissao']."',
                 telefone      = '".$dadosContato['telefone']."',
                 celular     = '".$dadosContato['celular']."',
                 wppNotificacoes = '".$dadosContato['wppNotificacoes']."',
                 emailNotificacoes = '".$dadosContato['emailNotificacoes']."',
                 smsNotificacoes = '".$dadosContato['smsNotificacoes']."'

            
            where id =".$dadosContato['id'];

            
    //Executa o scriipt no BD
    //Validação para verificar se o script esta correto
    if (mysqli_query($conexao, $sql)) {

        //Validação para verificar se uma linha foi acrescentada no BD
        if (mysqli_affected_rows($conexao)) 
            $statusResposta = true; 
       
        fecharConexaoMysql($conexao);
        
        return $statusResposta;
    } 
        

}

//Função para deletar no BD
function deleteContato($id) {

    //Declaração de varaiavel para utilização no return desta função
    $statusResposta = (boolean) false;

    //Abre a conexão
    $conexao = conexaoMysql();

    //Script para deletar um registro do BD
    $sql = "delete from tbl_contato where id =".$id;
    
    //Valida se o script esta correto, sem erro de sintaxe e executa no BD
    if(mysqli_query($conexao, $sql))
        //Valida se o BD teve sucesso na execução do excript 
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;

    fecharConexaoMysql($conexao);
    return $statusResposta;

}

//Função para listar todos os contatos no BD
function selectAllContatos() {
    
    //Abre a conexão
    $conexao = conexaoMysql();

    $sql = "select * from tbl_contato order by id asc";
    $result = mysqli_query($conexao, $sql);

    if ($result)
    {   
        // mysqli_fetch_assoc() - permite converter os dados do bd em um array para manipulação no PHP
        // nesta repetição estamos, convertendo os dados do BD em um array ($rsDados), além de o próprio while conseguir gerenciar a qtde de vezes que devera ser feita a repetiçao
        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {

            //Cria um array com os dados do BD
            $arrayDados[$cont] = array (
                "id"         => $rsDados['id'],
                "nome"       => $rsDados['nome'],
                "dataNascimento" => $rsDados['dataNascimento'],
                "email"      => $rsDados['email'],
                "profissao"  => $rsDados['profissao'],
                "telefone"   => $rsDados['telefone'],
                "celular"    => $rsDados['celular'],
                "wppNotificacoes"        => $rsDados['wppNotificacoes'],
                "emailNotificacoes"       => $rsDados['emailNotificacoes'],
                "smsNotificacoes"   => $rsDados['smsNotificacoes']

 
            );
            $cont++;
        }

        //Solicita o fechamento da conexão com o BD
        fecharConexaoMysql($conexao);

        if (isset($arrayDados)) {
            return $arrayDados;
        } else
            return false;

        
    }
}

//Função para buscar um contato no BD atraves do ID
function selectByIdContato($id) {

    //Abre a conexão
    $conexao = conexaoMysql();

    $sql = "select * from tbl_contato where id =".$id;

    //Executa o script sql no BD e guarda o retorno dos dados, se houver
    $result = mysqli_query($conexao, $sql);

    if ($result)
    {   
        // mysqli_fetch_assoc() - permite converter os dados do bd em um array para manipulação no PHP
        // nesta repetição estamos, convertendo os dados do BD em um array ($rsDados), além de o próprio while conseguir gerenciar a qtde de vezes que devera ser feita a repetiçao
    
        if ($rsDados = mysqli_fetch_assoc($result)) {

            //Cria um array com os dados do BD
            $arrayDados = array (
                "id"         => $rsDados['id'],
                "nome"       => $rsDados['nome'],
                "dataNascimento" => $rsDados['dataNascimento'],
                "email"      => $rsDados['email'],
                "profissao"  => $rsDados['profissao'],
                "telefone"   => $rsDados['telefone'],
                "celular"    => $rsDados['celular'],
                "wppNotificacoes"        => $rsDados['wppNotificacoes'],
                "emailNotificacoes"       => $rsDados['emailNotificacoes'],
                "smsNotificacoes"   => $rsDados['smsNotificacoes']

            );
            
        }

        //Solicita o fechamento da conexão com o BD
        fecharConexaoMysql($conexao);



        if (isset($arrayDados)) {
            return $arrayDados;
        } else
            return false;
    }

}


?>