<?php
require_once('connectionMySql.php');

function insertContato($dadosContato) {
    
    $statusResposta = (boolean) false;

    $conexao = conexaoMysql();

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
    
    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao)) 
            $statusResposta = true; 
       
        fecharConexaoMysql($conexao);
        return $statusResposta;
    } 
        
    
        
}

function updateContato($dadosContato) {
    
    $statusResposta = (boolean) false;

    $conexao = conexaoMysql();

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

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao)) 
            $statusResposta = true; 
       
        fecharConexaoMysql($conexao);
        
        return $statusResposta;
    } 
        

}

function deleteContato($id) {

    $statusResposta = (boolean) false;

    $conexao = conexaoMysql();

    $sql = "delete from tbl_contato where id =".$id;
    
    if(mysqli_query($conexao, $sql))
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;

    fecharConexaoMysql($conexao);
    return $statusResposta;

}

function selectAllContatos() {
    
    $conexao = conexaoMysql();

    $sql = "select * from tbl_contato order by id asc";
    $result = mysqli_query($conexao, $sql);

    if ($result)
    {   
        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {

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

        fecharConexaoMysql($conexao);

        if (isset($arrayDados)) {
            return $arrayDados;
        } else
            return false;

        
    }
}

function selectByIdContato($id) {

    $conexao = conexaoMysql();

    $sql = "select * from tbl_contato where id =".$id;

    $result = mysqli_query($conexao, $sql);

    if ($result)
    {   
        if ($rsDados = mysqli_fetch_assoc($result)) {

       
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

        fecharConexaoMysql($conexao);

        if (isset($arrayDados)) {
            return $arrayDados;
        } else
            return false;
    }

}


?>