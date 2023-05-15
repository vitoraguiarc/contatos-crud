<?php
     // constantes p/ estabelecer a conexão com o BD (local do BD, usuário, senha e database)
    const SERVER = 'localhost';
    const USER = 'root';
    const PASSWORD = 'bcd123';
    const DATABASE = 'db_contatos';
    
   
   //Abre conexão com o BD Mysql
    function conexaoMysql()
    {
        $conexao = array();
        
        //caso a conexão for estabelecida com o BD, iremos ter um array de dados sobre a conexão
        $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

        //validação para verificar se a conexão foi realizada com sucesso
        if ($conexao)
            return $conexao;
        else
            return false;
    } 

    //Fecha a conexão com o BD Mysql
    function fecharConexaoMysql($conexao)
    {
        mysqli_close($conexao);
    }

?>