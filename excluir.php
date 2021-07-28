<?php
//conexão com banco de dados
require 'config.php';

//puxando o DAO
require 'dao/UsuarioDaoMysql.php';
$usuarioDao = new UsuarioDaoMysql($pdo);

$id = filter_input(INPUT_GET, 'id');
if($id){

    $usuarioDao->deletar($id);

}
header("Location: index.php");