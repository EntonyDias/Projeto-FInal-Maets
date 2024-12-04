<?php
class Jogo {
    private $conn;
    private $table_name = "tb_jogos";


    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function registrar($nome, $img, $descricao, $preco, $idadeCat, $fkDes) {
        $query = "INSERT INTO " . $this->table_name . " (nomeJogo, ImgJogo, descricaoJogo, precoJogo, idadeCategJogo, fk_desenvolvedora) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nome, $img, $descricao, $preco, $idadeCat, $fkDes]);
        return $stmt;
    }
  
    public function ler() { 
        $query = "SELECT * FROM " . $this->table_name; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(); 
        return $stmt; 
    } 

    public function lerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idJogos = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $nome, $img, $descricao, $preco, $idadeCat, $fkDes) {
        $query = "UPDATE " . $this->table_name . " SET nomeJogo = ?, ImgJogo = ?, descricaoJogo = ?, precoJogo = ?, idadeCategJogo = ?, fk_desenvolvedora = ?, WHERE idJogo = ?"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nome, $img, $descricao, $preco, $idadeCat, $fkDes, $id]);
        return $stmt; 
    }

    public function deletar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE idJogos = ?"; 
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
