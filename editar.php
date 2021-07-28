<?php
//conexão com banco de dados
require 'config.php';

//puxando o DAO
require 'dao/UsuarioDaoMysql.php';
$usuarioDao = new UsuarioDaoMysql($pdo);

$usuario = false;
$id = filter_input(INPUT_GET, 'id');

if($id){

    $usuario = $usuarioDao->localId($id);
}

if($usuario === false){
    header("Location: index.php");
    exit;
}
?>
<h1>Editar Usuários</h1>
<form action="editar_action.php" method="post">
    <input type="hidden" name="id" value="<?=$usuario->getId();?>">
    <label for="">
        Nome:
        <input type="text" name="nome" value="<?=$usuario->getNome();?>">
    </label><br><br>
    <label for="">
        Email:
        <input type="email" name="email" value="<?=$usuario->getEmail();?>">
    </label><br><br>
        <input type="submit" value="salvar">
</form>