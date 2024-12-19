<?php

class Biblioteca
{

    private $conn;
    private $table_name = "tb_bibliotecas";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function registrar($fk_usuario, $fk_itens)
    {
        $query = "INSERT INTO " . $this->table_name . " (fk_usuario) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$fk_usuario, $fk_itens]);
        return $stmt;
    }

    public function ler()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function lerJogos($id)
    {
        $query = "SELECT tb_itens JOIN tb_carrinho ON tb_itens.fk_carrinho = tb_carrinho.idCarrinho FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_NAME = 'tb_bibliotecas' AND REFERENCED_COLUMN_NAME = 'idBiblioteca' AND tb_carrinhos.status = c";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function lerPorId($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idBiblioteca = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $status)
    {
        $query = "UPDATE " . $this->table_name . " SET status = ? WHERE idBiblioteca = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$status, $id]);
        return $stmt;
    }

    public function deletar($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE idBiblioteca = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }

    public function listarTodos()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function algofaz($id)
    {
        $query = "SELECT * FROM tb_bibliotecas b JOIN tb_itens i ON b.idBiblioteca = i.fk_biblioteca WHERE b.fk_usuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }

    public function algovem($id)
    {
        $query = "SELECT * FROM tb_bibliotecas b JOIN tb_itens i ON b.idBiblioteca = i.fk_biblioteca WHERE b.fk_usuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }
}
