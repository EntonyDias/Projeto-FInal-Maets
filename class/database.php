<?PHP
   class Database{
      private $host = "localhost";
      private $db_name = "db_maets";
      private $username = "root";
      private $password = "";

      public $conn;
      
      public function getConnection(){
         $this->conn = null;
         try {
            $this->conn = new PDO ("mysql:host=". 
            $this->host . ";dbname=" . 
            $this->db_name, 
            $this->username, 
            $this->password);
            
         } catch(PDOException $exception) { 
             echo "Erro de conexão: " . $exception->getMessage(); 
         } 
         return $this->conn; 
     }

   }
?>