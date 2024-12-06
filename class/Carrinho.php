<?php

class Carrinho {

    private $conn;
    private $table_name = "tb_carrinho";

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function registrar($status, $fk_usuario) {
        $query = "INSERT INTO " . $this->table_name . " (status, fk_usuario) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$status, $fk_usuario]);
        return $stmt;
    }

    public function ler() { 
        $query = "SELECT * FROM " . $this->table_name; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(); 
        return $stmt; 
    } 

    public function lerJogos($id){
      $query = "SELECT tb_itens FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_NAME = 'tb_carrinho' AND REFERENCED_COLUMN_NAME = 'idCarrinho' AND idCarrinho = ?";
      $stmt = $this->conn->prepare($query);
      $stmt->execute([$id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function lerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idCarrinho = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $status) {
        $query = "UPDATE " . $this->table_name . " SET status = ? WHERE idCarrinho = ?"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$status, $id]);
        return $stmt; 
    }

    public function deletar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE idCarrinho = ?"; 
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
