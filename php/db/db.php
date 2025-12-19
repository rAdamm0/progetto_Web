<?php
class DatabaseHelper
{
  private $db;

  public function __construct($servername, $username, $password, $dbname, $port)
  {
    $this->db = new mysqli($servername, $username, $password, $dbname, $port);
    if ($this->db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }
  }

  public function getAvailableBooks($n = -1)
  {
    $query = "SELECT l.*, a.codice_autore, a.nome_autore, a.cognome_autore, CONCAT(a.nome_autore, ' ', a.cognome_autore) AS autore_completo FROM libri l LEFT JOIN autore_libro al ON l.codice_libro = al.codice_libro LEFT JOIN autori a ON al.codice_autore = a.codice_autore ORDER BY l.nome_libro";
    if ($n > 0) {
      $query .= " LIMIT ?";
    }
    $stmt = $this->db->prepare($query);
    if ($n > 0) {
      $stmt->bind_param('i', $n);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getBookInfo($id)
  {
    $query = "SELECT l.nome_libro, l.descrizione, l.data_uscita, l.edizione, l.disponibile, GROUP_CONCAT(CONCAT(a.nome_autore, ' ', a.cognome_autore) SEPARATOR ', ') AS autori FROM libri l LEFT JOIN autore_libro al ON l.codice_libro = al.codice_libro LEFT JOIN autori a ON al.codice_autore = a.codice_autore WHERE l.codice_libro = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

      return $result->fetch_assoc();
    }

  public function bookReviews($id)
  {
    $query = "SELECT l.nome_libro, r.valutazione, r.descrizione, r.email AS recensore FROM recensione r LEFT JOIN libri l ON r.codice_libro=l.codice_libro WHERE r.codice_libro = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function coursesList($n = -1)
  {
    $query = "SELECT codice_corso, nome_corso, descrizione, lingua, docente FROM corsi";
    if ($n > 0) {
      $query .= "LIMIT ?";
    }
    $stmt = $this->db->prepare($query);
    if ($n > 0) {
      $stmt->bind_param('i', $n);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all();
  }

  public function personalInfo($email)
  {
    $query = "SELECT nome, cognome, num_matricola, is_docente FROM utente WHERE email = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getPersonalCourses($email)
  {
    $query = "SELECT c.nome_corso, c.codice_corso FROM utente u RIGHT JOIN utente_corso uc ON u.email=uc.email RIGHT JOIN corsi c ON c.codice_corso=uc.codice_corso
      WHERE u.email=$email";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getPastBookings($email)
  {
    $query = "SELECT * FROM 'Prenotazioni Passate' where email=?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getBookByName($name)
  {
    $searchTerm = "%" . $name . "%";
    $query = "SELECT l.*, GROUP_CONCAT(CONCAT(a.nome_autore, ' ', a.cognome_autore) SEPARATOR ', ') AS autori,GROUP_CONCAT(a.codice_autore) AS autori_ids
    FROM libri l LEFT JOIN autore_libro al ON l.codice_libro = al.codice_libro LEFT JOIN autori a ON al.codice_autore = a.codice_autoreWHERE l.nome_libro LIKE'?' GROUP BY l.codice_libro ORDER BY l.nome_libro ASC;";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  public function getCoursesTagsByEmail($email)
  {
    $query = "SELECT c.codice_corso, c.nome_corso FROM corso c LEFT JOIN utente_corso uc ON c.codice_corso = uc.codice_corso WHERE uc.email = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function addTagByEmail($email, $codice_corso)
  {
    $query = "INSERT INTO `utente_corso`(`email`, `codice_corso`) VALUES (?,?)";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('si', $email, $codice_corso);
    return $stmt->execute();
  }

  public function deleteTagByEmail($email, $codice_corso)
  {
    $query = "DELETE FROM `utente_corso` WHERE email = ? AND codice_corso=?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('si', $email, $codice_corso);
    return $stmt->execute();

  }

  public function getUserInfos($email)
  {
    $query = "SELECT nome, cognome, corso, anno, num_matricola,immagine_profilo FROM utente WHERE email = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function updateUserInfos($email, $nome, $cognome, $corso, $anno, $num_matricola, $immagine_profilo)
  {
    $params = $this->getUserInfos($email);
    $newParams["nome"] = $nome != $params["nome"] ? $nome : $params["nome"];
    $newParams["cognome"] = $cognome != $params["cognome"] ? $cognome : $params["cognome"];
    $newParams["corso"] = $corso != $params["corso"] ? $corso : $params["corso"];
    $newParams["anno"] = $anno != $params["anno"] ? $anno : $params["anno"];
    $newParams["num_matricola"] = $num_matricola != $params["num_matricola"] ? $num_matricola : $params["num_matricola"];
    $newParams["immagine_profilo"] = $immagine_profilo != $params["immagine_profilo"] ? $immagine_profilo : $params["immagine_profilo"];
    $tipi = 'sssiib';
    $query = "UPDATE utente SET nome = ?, cognome = ?, corso = ?, anno = ?, num_matricola=?, immagine_profilo=:img WHERE email = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param(
      $tipi,
      $newParams["nome"],
      $newParams["cognome"],
      $newParams["corso"],
      $newParams["anno"],
      $newParams["num_matricola"],
      $newParams["immagine_profilo"]
    );
  }
  public function getCourseByBook($idBook){
      $query = "SELECT c.* FROM corsi as c JOIN libro_corso as lc
      ON c.codice_corso = lc.codice_corso
      WHERE lc.codice_libro = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param("i",$idBook);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result->fetch_assoc();

  }

}
?>
