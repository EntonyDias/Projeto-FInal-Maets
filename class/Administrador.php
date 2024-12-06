<?php
class Administrador {
    private $conn;
    private $table_name = "tb_administradores";
    private $table_fk = "tb_usuarios";


    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function registrar($fk_usuario) {
        $query = "INSERT INTO " . $this->table_name . " (fk_usuario) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$fk_usuario]);
        return $stmt;
    }

//SELECT * FROM tb_administradores
//JOIN tb_usuarios ON tb_administradores.fk_usuario = tb_usuarios.idUsuario WHERE emailUsu = 'lily@lily';

    public function login($email, $senha) {
        $query = "SELECT * FROM " . $this->table_name .
        " JOIN ". $this->table_fk . " ON " .  $this->table_name.".fk_usuario = " . $this->table_fk.".idUsuario
        WHERE emailUsu = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        $administrador = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($administrador && password_verify($senha, $administrador['senhaUsu'])) {
            return $administrador;
        }
        return false;
    }
  
    public function ler() { 
        $query = "SELECT * FROM " . $this->table_name; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(); 
        return $stmt; 
    } 

    public function lerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $nome, $cpf, $email, $senha) {
        $query = "UPDATE " . $this->table_name .
        " JOIN ". $this->table_name.".fk_usuario ON = ".$this->table_fk.".idUsuario
        SET nomeUsu = ?, cpfUsu = ?, emailUsu = ?, senhaUsu = ? WHERE idUsuario = ?"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nome, $cpf, $email, $senha, $id]);
        return $stmt; 
    }

    public function deletar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE idUsuario = ?"; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute([$id]); 
        return $stmt; 
    }

    public function listarTodos(){
            $query = "SELECT * FROM ".$this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll (PDO::FETCH_ASSOC);
    }
    
}
?>
