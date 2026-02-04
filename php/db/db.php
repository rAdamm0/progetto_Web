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
    $query = "SELECT l.nome_libro, l.descrizione, l.data_uscita, l.edizione, l.disponibile, GROUP_CONCAT(CONCAT(a.nome_autore, ' ', a.cognome_autore) SEPARATOR ', ') AS autori, immagine_libro as immagine FROM libri l LEFT JOIN autore_libro al ON l.codice_libro = al.codice_libro LEFT JOIN autori a ON al.codice_autore = a.codice_autore WHERE l.codice_libro = ?";
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
    return $result->fetch_all(MYSQLI_ASSOC);
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

  public function getPastBookings($email)
  {
    $query = "SELECT * FROM `prenotazioni passate` where email = ? order by data_fine ASC";
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
    $query = "SELECT c.codice_corso, c.nome_corso FROM corsi c LEFT JOIN utente_corso uc ON c.codice_corso = uc.codice_corso WHERE uc.email = ?";
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
    if ($stmt->execute()) {
      return [
        'success' => true
      ];
    } else {
      return [
        'success' => false
      ];
      ;
    }
  }

  public function deleteTagByEmail($email, $codice_corso)
  {
    $query = "DELETE FROM `utente_corso` WHERE email = ? AND codice_corso=?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('si', $email, $codice_corso);
    if ($stmt->execute()) {
      return [
        'success' => true
      ];
    } else {
      return [
        'success' => false
      ];
      ;
    }

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

  public function updateUserInfos($email, $nome, $cognome, $corso, $anno, $immagine_profilo)
  {
    $tipi = 'sssiss';
    $query = "UPDATE utente SET nome = ?, cognome = ?, corso = ?, anno = ?, immagine_profilo=? WHERE email = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param(
      $tipi,
      $nome,
      $cognome,
      $corso,
      $anno,
      $immagine_profilo,
      $email
    );
    if ($stmt->execute()) {
      return [
        'success' => true
      ];
    } else {
      return [
        'success' => false
      ];
      ;
    }
  }

  public function checkUserInDatabase($email, $pw = 0)
  {
    $query = "SELECT email, num_matricola, nome, immagine_profilo FROM utente WHERE email = ?";
    if ($pw != 0) {
      $query .= " AND pw = ?";
    }
    $stmt = $this->db->prepare($query);
    if ($pw != 0) {
      $algo = "sha256";
      $hashed_pw = hash($algo, $pw);
      $stmt->bind_param('ss', $email, $hashed_pw);
    } else {
      $stmt->bind_param('s', $email);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function checkMatrInDatabase($matricola)
  {
    $query = "SELECT email, num_matricola, nome, immagine_profilo FROM utente WHERE num_matricola = ?";
    $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $matricola);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function registerUser($email, $pw, $nome, $cognome, $numero_matricola)
  {
    $algo = "sha256";
    $hashed_pw = hash($algo, $pw);
    $query = "INSERT INTO utente(email, pw, nome, cognome, num_matricola, immagine_profilo) VALUES (?,?,?,?,?,\"./uploads/default_avatar.png\")";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('ssssi', $email, $hashed_pw, $nome, $cognome, $numero_matricola);
    if ($stmt->execute()) {
      return [
        'success' => true,
        'user_id' => $stmt->insert_id,
        'message' => 'Registration successful'
      ];
    } else {
      throw new Exception("Registration failed: " . $stmt->error);
    }
  }

  public function getReviewsByEmail($email)
  {
    $query = "SELECT l.nome_libro, r.descrizione, r.valutazione 
    FROM recensione r LEFT JOIN libri l ON r.codice_libro = l.codice_libro
     WHERE r.email = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
  public function getCourseByBook($idBook)
  {
    $query = "SELECT c.* FROM corsi as c JOIN libro_corso as lc
      ON c.codice_corso = lc.codice_corso
      WHERE lc.codice_libro = ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $idBook);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();

  }
  public function getRandomCourses($limit = 3)
  {
    $query = "SELECT * FROM corsi ORDER BY RAND() LIMIT ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
  public function getCoursesByResearch($search = "")
  {
    $search = trim($search);
    if ($search === "") {
      $query = "SELECT * FROM corsi ORDER BY nome_corso ASC";
      $stmt = $this->db->prepare($query);
    } else {
      $like = "%" . $search . "%";
      $query = "SELECT * FROM corsi
               WHERE nome_corso LIKE ?
                OR descrizione LIKE ?
                OR docente LIKE ?
                OR lingua LIKE ?
                OR CAST(codice_corso AS CHAR) LIKE ?
                ORDER BY nome_corso ASC";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('sssss', $like, $like, $like, $like, $like);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
  public function getBooksBySearch($search)
  {
    $search = trim($search);
    if ($search === "") {
      $query = $query = "SELECT l.*, GROUP_CONCAT(CONCAT(a.nome_autore,' ',a.cognome_autore) SEPARATOR ', ') AS autore_completo
                         FROM libri l
                         LEFT JOIN autore_libro al ON l.codice_libro = al.codice_libro
                         LEFT JOIN autori a ON a.codice_autore = al.codice_autore
                         GROUP BY l.codice_libro
                         ORDER BY l.nome_libro;";
      $stmt = $this->db->prepare($query);
    } else {
      $like = "%" . $search . "%";
      $query = "SELECT l.*, GROUP_CONCAT(CONCAT(a.nome_autore,' ',a.cognome_autore) SEPARATOR ', ') AS autore_completo
                FROM libri l
                JOIN autore_libro al ON l.codice_libro = al.codice_libro
                JOIN autori a ON a.codice_autore = al.codice_autore
                GROUP BY l.codice_libro
                HAVING l.nome_libro LIKE ?
                OR autore_completo LIKE ?
                OR CAST(l.data_uscita AS CHAR) LIKE ?
                ORDER BY l.nome_libro DESC";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param("ssi", $like, $like, $like);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
  public function getAllBookingsStarts($email)
  {
    $query = "SELECT id_prenotazioni as id, nome_libro as title, data_inizio as start, data_fine as description
              FROM `prenotazioni passate` 
              WHERE email = ?";

    $stmt = $this->db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getAllBookingsEnds($email)
  {
    $query = "SELECT id_prenotazioni as id, nome_libro as title, data_fine as start 
              FROM `prenotazioni passate` 
              WHERE email = ?";

    $stmt = $this->db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getBookable()
  {
    $query = "SELECT codice_libro as id, nome_libro as libro, edizione 
            FROM libri
            WHERE disponibile = 0";
    $result = $this->db->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getBooked($email){
  $query = "SELECT p.id_prenotazioni as id, l.nome_libro as libro, l.edizione
            FROM prenotazioni p LEFT JOIN libri l ON  p.codice_libro = l.codice_libro
            WHERE p.email = ?
            AND data_fine > CURDATE()";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function cancelBooking($id){
    $query = "UPDATE prenotazioni SET data_fine = CURDATE() WHERE id_prenotazioni=?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $id);
    if($stmt->execute()){
      return 'success';
    }return 'failure';
  }

  public function bookABook($email, $codice_libro, $data_inizio, $data_fine)
  {
    $checkQuery = "SELECT id_prenotazioni FROM prenotazioni WHERE codice_libro = ? 
                   AND (data_inizio <= ? AND data_fine >= ?)";
    $stmtCheck = $this->db->prepare($checkQuery);

    $stmtCheck->bind_param('iss', $codice_libro, $data_fine, $data_inizio);
    $stmtCheck->execute();
    if ($stmtCheck->get_result()->num_rows > 0) {
      return "Questo libro è già prenotato per le date selezionate.";
    }
    $checkQuery = "SELECT COUNT(*) as num FROM prenotazioni WHERE email = ? AND data_fine>?";
    $today = date("Y/m/d");
    $stmtCheck = $this->db->prepare($checkQuery);
    $stmtCheck->bind_param('ss', $email, $today);
    $stmtCheck->execute();
    if ($stmtCheck->get_result()->fetch_assoc()["num"] > 5) {
      return "Hai già prenotato 5 libri in questo periodo";
    }
    $updateQuery = "UPDATE `libri` SET disponibile = 1 where `codice_libro` = ?";
    $stmtUpd = $this->db->prepare($updateQuery);
    $stmtUpd->bind_param('i', $codice_libro);
    $stmtCheck->execute();
    if (!$stmtCheck) {
      return "Qualcosa è andato storto durante la prenotazione";
    }
    $stmtCheck->close();
    $query = "INSERT INTO `prenotazioni` (`email`, `codice_libro`, `data_inizio`, `data_fine`) VALUES (?, ?, ?, ?);";
    $stmt = $this->db->prepare($query);
    if (!$stmt) {
        return "Errore SQL Insert: " . $this->db->error;
    }
    $stmt->bind_param('siss', $email, $codice_libro, $data_inizio, $data_fine);

    if ($stmt->execute()) {
      $stmt->close();
      return true;
    } else {
      return "Errore tecnico durante il salvataggio.";
    }
  }

  public function disponibilityUpdate($codice_libro){
    $query = "UPDATE `libri` SET `disponibile`=1 WHERE `codice_libro`=?;";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $codice_libro);
    if($stmt->execute()){
      return 'success';
    }
    return 'failure';
  }

  public function checkDailyTask()
  {
    $stmt = $this->db->prepare("SELECT last_date from config LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $lastRun = $row ? $row['last_date'] : '0000-00-00';
    $today = date('Y-m-d');

    if ($lastRun !== $today) {
      // ESEGUI LA TUA FUNZIONE (es. pulizia prenotazioni vecchie)
      $this->disponibilityCheck();

      // AGGIORNA la data dell'ultima esecuzione
      // UPDATE config SET last_run = '$today'
      $stmt = $this->db->prepare("UPDATE config SET last_date = '$today' where last_date = '$lastRun'");
      $stmt->execute();
    }
  }

  public function disponibilityCheck()
  {
    $query = "UPDATE libri l
    LEFT JOIN (
    SELECT codice_libro, MAX(data_fine) as ultima_prenotazione
    FROM prenotazioni
    GROUP BY codice_libro
    ) p ON l.codice_libro = p.codice_libro
    SET l.disponibile = 0
    WHERE 
    p.codice_libro IS NULL 
    OR p.ultima_prenotazione < CURRENT_DATE;  ";
    $stmt = $this->db->prepare($query);
    if (!$stmt->execute()) {
      return "Errore nell'aggiornamento";
    }
    return "Aggiornamento svolto con successo";


  }

  public function getRange()
  {
    $query = "SELECT MAX(codice_libro) as max, MIN(codice_libro) as min
              FROM libri";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }
}

