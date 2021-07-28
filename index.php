<?php
//conexão com banco de dados
require 'config.php';

//puxando o DAO
require 'dao/UsuarioDaoMysql.php';
$usuarioDao = new UsuarioDaoMysql($pdo);
$lista = $usuarioDao->verUsuario();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizualisar</title>
</head>
<body>
 <a href="adicionar.php">Novo Usuário</a>
    <table border="1" width="100%">
      <tr>
         <th>Id</th>
         <th>Nome</th>
         <th>Email</th>
         <th>Acões</th>
      </tr>
      <?php foreach($lista as $item):?>
        <tr>
           <td><?=$item->getId();?></td>
           <td><?=$item->getNome();?></td>
           <td><?=$item->getEmail();?></td>
           <td><a href="editar.php?id=<?=$item->getId();?>">[Editar]</a> <a href="excluir.php?id=<?=$item->getId();?>" onclick="return confirm('tem certeza que deseja excluir: <?=$item->getNome();?>?')">[Excluir]</a></td>
        </tr>
      <?php endforeach;?>
    </table>
</body>
</html>