<?php
//conexão com banco de dados
require 'config.php';

//puxando o DAO
require 'dao/UsuarioDaoMysql.php';
$usuarioDao = new UsuarioDaoMysql($pdo);

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
if($nome && $email){

    if($usuarioDao->localEmail($email) === false){
        $novoUsuario = new Usuario();
        $novoUsuario->setNome($nome);
        $novoUsuario->setEmail($email);

        $usuarioDao->adicionar($novoUsuario);
        header("Location: index.php");
        exit;
    }
    else{
        header("Location: adicionar.php");
        exit;
    }
    
}else{
    header("Location: adicionar.php");
    exit;
}
?>