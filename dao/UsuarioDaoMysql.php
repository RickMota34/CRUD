<?php
require_once 'models/Usuario.php';

class UsuarioDaoMysql implements UsuarioDao {
    private $pdo;

    public function __construct(PDO $model){
        $this->pdo = $model;
    }
    
    public function adicionar(Usuario $u){
        
        $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");
        $sql->bindValue(":nome", $u->getNome());
        $sql->bindValue(":email", $u->getEmail());
        $sql->execute();

        $u->setId($this->pdo->lastInsertId());
        return $u;
    }

    public function localEmail($email){

        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch();

            $u = new Usuario();
            $u->setId($data['id']);
            $u->setNome($data['nome']);
            $u->setEmail($data['email']);

            return $u;
        }else{
            return false;
        }

        return true;

    }

    public function localId($id){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch();

            $u = new Usuario();
            $u->setId($data['id']);
            $u->setNome($data['nome']);
            $u->setEmail($data['email']);

            return $u;
        }else{
            return false;
        }
        return true;
    }

    public function verUsuario(){
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM usuarios");
        if($sql->rowCount() > 0){
            $data = $sql->fetchAll();
             
            foreach($data as $item){
                $n = new Usuario();
                $n->setId($item['id']);
                $n->setNome($item['nome']);
                $n->setEmail($item['email']);

                $array[] = $n;
            }
        }

        return $array;
    }

    public function editar(Usuario $u){
        $sql = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id");
        $sql->bindValue(":nome", $u->getNome());
        $sql->bindValue(":email", $u->getEmail());
        $sql->bindValue(":id", $u->getId());
        $sql->execute();

        return $u;
    }

    public function deletar($id){
        $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
}