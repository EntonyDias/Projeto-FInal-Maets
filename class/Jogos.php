<?php
class Jogo {
    private $conn;
    private $table_name = "tb_jogos";


    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function registrar($nome, $img, $descricao, $preco, $idadeCat, $fkDes, $cat) {
        $query = "INSERT INTO " . $this->table_name . " (nomeJogo, ImgJogo, descricaoJogo, precoJogo, idadeCategJogo, fk_desenvolvedora, categoriaJogo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nome, $img, $descricao, $preco, $idadeCat, $fkDes, $cat]);
        return $stmt;
    }
  
    public function ler() { 
        $query = "SELECT * FROM " . $this->table_name; 
        $stmt = $this->conn->prepare($query); 
        $stmt->execute(); 
        return $stmt; 
    } 

    public function lerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idJogo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $nome, $img, $descricao, $preco, $idadeCat, $fkDes, $cat) {
        $query = "UPDATE " . $this->table_name . " SET nomeJogo = ?, ImgJogo = ?, descricaoJogo = ?, precoJogo = ?, idadeCategJogo = ?, fk_desenvolvedora = ?, categoriaJogo = ? WHERE idJogo = ?"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$nome, $img, $descricao, $preco, $idadeCat, $fkDes, $cat, $id]);
        return $stmt; 
    }

    public function listarPorDesenvolvedoraID($idDes){
            $query = "SELECT * FROM ". $this->table_name ." WHERE fk_desenvolvedora = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$idDes]);
            return $stmt;
        }

    public function deletar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE idJogo = ?"; 
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

    public function pesquisarNome($nome){
        $query = "SELECT * FROM ". $this->table_name ." WHERE nomeJogo LIKE '%".$nome."%'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll (PDO::FETCH_ASSOC);
    }

    public function pesquisarCatalogo($cat){
        $query = "SELECT * FROM ". $this->table_name ." WHERE categoriaJogo = ".$cat;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll (PDO::FETCH_ASSOC);
    }

    public function pesquisarNomeECatalogo($nome, $cat){
        $query = "SELECT * FROM ". $this->table_name ." WHERE nomeJogo LIKE '%".$nome."%' AND categoriaJogo = ".$cat;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll (PDO::FETCH_ASSOC);
    }

    

}
?>
