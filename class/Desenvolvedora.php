<?php
class Desenvolvedora
{
   private $conn;
   private $table_name = "tb_desenvolvedoras";


   public function __construct($db)
   {
      $this->conn = $db;
   }

   public function registrar($nome, $cnpj, $email, $senha)
   {
      $query = "INSERT INTO " . $this->table_name . " (nomeDes, cpfDes, emailDesenvolvedora, senhaDesenvolvedora) VALUES (?, ?, ?, ?)";
      $stmt = $this->conn->prepare($query);
      $hashed_password = password_hash($senha, PASSWORD_BCRYPT);
      $stmt->execute([$nome, $cnpj, $email, $hashed_password]);
      return $stmt;
   }

   public function login($email, $senha)
   {
      $query = "SELECT * FROM " . $this->table_name . " WHERE emailDesenvolvedora = ?";
      $stmt = $this->conn->prepare($query);
      $stmt->execute([$email]);
      $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($usuario && password_verify($senha, $usuario['senhaDesenvolvedora'])) {
         return $usuario;
      }
      return false;
   }

   public function ler()
   {
      $query = "SELECT * FROM " . $this->table_name;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt;
   }

   public function lerPorId($id)
   {
      $query = "SELECT * FROM " . $this->table_name . " WHERE idDes = ?";
      $stmt = $this->conn->prepare($query);
      $stmt->execute([$id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   public function atualizar($id, $nome, $cnpj, $email, $senha)
   {
      $query = "UPDATE " . $this->table_name . " SET nomeDes = ?, cnpjDes = ?, emailDesenvolvedora = ?, senhaDesenvolvedora = ? WHERE idDes = ?";
      $stmt = $this->conn->prepare($query);
      $stmt->execute($nome, $cnpj, $email, $senha, $id);
      return $stmt;
   }

   public function deletar($id)
   {
      $query = "DELETE FROM " . $this->table_name . " WHERE idDes = ?";
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
}
