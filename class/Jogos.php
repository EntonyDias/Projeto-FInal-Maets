<?php
class Jogos {
    private $conn;
    private $table_name = "tb_jogos";


    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function registrar($nome, $img, $descricao, $preco, $idadeCat, $fkDes) {
        $query = "INSERT INTO " . $this->table_name . " (nomeJogo, ImgJogo, descricaoJogo, precoJogo, idadeCategJogo, fk_desenvolvedora) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $hashed_password = password_hash($senha, PASSWORD_BCRYPT);
        $stmt->execute([$nome, $cpf, $email, $hashed_password]);
        return $stmt;
    }

    public function login($email, $senha) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE emailUsu = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($senha, $usuario['senhaUsu'])) {
            return $usuario;
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
        $query = "UPDATE " . $this->table_name . " SET nomeUsu = ?, cpfUsu = ?, emailUsu = ?, senhaUsu = ? WHERE idUsuario = ?"; 
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
