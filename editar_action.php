<?php
//conexão com banco de dados
require 'config.php';

//puxando o DAO
require 'dao/UsuarioDaoMysql.php';
$usuarioDao = new UsuarioDaoMysql($pdo);

$id = filter_input(INPUT_POST, 'id');
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
if($id && $nome && $email){

    $usuario = $usuarioDao->localid($id);
    $usuario->setNome($nome);
    $usuario->setEmail($email);

    $usuarioDao->editar($usuario);
    
    header("Location:index.php");
}
else{
    header("Location: editar.php?=id".$id);
}
?>