<?php
class Item {
    private $conn;
    private $table_name = "tb_itens";


    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function registrar($fkJogo, $fkCar, $fkBib) {
        $query = "INSERT INTO " . $this->table_name . " (fk_jogos, fk_carrinho, fk_biblioteca) VALUES ( ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$fkJogo, $fkCar, $fkBib]);
        return $stmt;
    }
  
    public function ler() { 
        $query = "SELECT * FROM " . $this->table_name; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(); 
        return $stmt; 
    } 

    public function lerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idItens = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $fkJogo, $fkCar, $fkBib) {
        $query = "UPDATE " . $this->table_name . " SET fk_jogos = ?, fk_carrinho = ?, fk_biblioteca = ? WHERE idItens = ?"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$fkJogo, $fkCar, $fkBib, $id]);
        return $stmt; 
    }

    public function deletar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE idItens = ?"; 
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
