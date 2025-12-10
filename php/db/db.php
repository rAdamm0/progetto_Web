<?php
class DatabaseHelper{
  private $db;

  public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }        
    }

    public function getAvailableBooks($n=-1){
      $query="SELECT l.*, a.codice_autore, a.nome_autore, a.cognome_autore, CONCAT(a.nome_autore, ' ', a.cognome_autore) AS autore_completo FROM libri l LEFT JOIN autore_libro al ON l.codice_libro = al.codice_libro LEFT JOIN autori a ON al.codice_autore = a.codice_autore WHERE l.disponibile = 0 ORDER BY l.nome_libro";
      if($n>0){
        $query.="LIMIT ?";
      }
      $stmt = $this->db->prepare($query);
      if($n > 0){
            $stmt->bind_param('i',$n);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBookInfo($id){
      $query="SELECT l.nome_libro, l.edizione, GROUP_CONCAT(CONCAT(a.nome_autore, ' ', a.cognome_autore) SEPARATOR ', ') AS autori FROM libri l LEFT JOIN autore_libro al ON l.codice_libro = al.codice_libro LEFT JOIN autori a ON al.codice_autore = a.codice_autore WHERE l.codice_libro = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param(`i`,$id);
      $stmt-execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

}
?>
