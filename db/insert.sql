INSERT INTO `weblio`.`utente` (`email`, `password`, `nome`, `cognome`, `corso`, `attivo`, `num_matricola`, `is_docente`) VALUES
('mario.rossi@university.it', SHA2('password123', 512), 'Mario', 'Rossi', 'Informatica', 1, 100001, 0),
('laura.bianchi@university.it', SHA2('password123', 512), 'Laura', 'Bianchi', 'Matematica', 1, 100002, 0),
('giuseppe.verdi@university.it', SHA2('password123', 512), 'Giuseppe', 'Verdi', 'Fisica', 1, 100003, 0),
('anna.russo@university.it', SHA2('password123', 512), 'Anna', 'Russo', 'Informatica', 1, 100004, 0),
('prof.smith@university.it', SHA2('prof123', 512), 'John', 'Smith', 'Informatica', 1, 200001, 1),
('prof.rossi@university.it', SHA2('prof123', 512), 'Paolo', 'Rossi', 'Matematica', 1, 200002, 1),
('elena.ferrari@university.it', SHA2('password123', 512), 'Elena', 'Ferrari', 'Fisica', 0, 100005, 0);

INSERT INTO `weblio`.`corsi` (`codice_corso`, `nome_corso`, `descrizione`, `lingua`, `docente`) VALUES
(101, 'Basi di Dati', 'Corso fondamentale sulle basi di dati e SQL', 'Italiano', 'John Smith'),
(102, 'Analisi Matematica 1', 'Corso di analisi matematica per il primo anno', 'Italiano', 'Paolo Rossi'),
(103, 'Fisica Generale', 'Principi fondamentali della fisica classica', 'Italiano', 'Maria Bianchi'),
(104, 'Programmazione Java', 'Corso avanzato di programmazione in Java', 'Italiano', 'John Smith'),
(105, 'Algebra Lineare', 'Corso di algebra lineare e geometria', 'Italiano', 'Paolo Rossi'),
(201, 'Advanced Databases', 'Advanced database concepts and NoSQL', 'English', 'John Smith');

INSERT INTO `weblio`.`libri` (`codice_libro`, `nome_libro`, `edizione`) VALUES
(1, 'Basi di Dati: Concetti e Linguaggi', 5),
(2, 'Analisi Matematica 1', 8),
(3, 'Fisica Generale: Meccanica e Termodinamica', 4),
(4, 'Programmazione Java Avanzata', 3),
(5, 'Algebra Lineare e Geometria', 6),
(6, 'Database System Concepts', 7),
(7, 'Calcolo Differenziale e Integrale', 2),
(8, 'Fisica: Elettromagnetismo e Onde', 3);

INSERT INTO `weblio`.`libro_corso` (`codice_libro`, `codice_corso`) VALUES
(1, 101),
(6, 101),
(2, 102),
(7, 102),
(3, 103),
(8, 103),
(4, 104),
(5, 105),
(6, 201);

INSERT INTO `weblio`.`autori` (`codice_autore`, `nome_autore`, `cognome_autore`, `descrizione`) VALUES
(1, 'Carlo', 'Bianchi', 'Professore di Informatica con 20 anni di esperienza'),
(2, 'Anna', 'Verdi', 'Matematica e autrice di numerosi testi universitari'),
(3, 'Marco', 'Rossi', 'Fisico teorico e divulgatore scientifico'),
(4, 'Luigi', 'Neri', 'Esperto di programmazione orientata agli oggetti'),
(5, 'Sarah', 'Johnson', 'Professore di Algebra presso MIT'),
(6, 'Abraham', 'Silberschatz', 'Co-autore di Database System Concepts'),
(7, 'Henry', 'Korth', 'Co-autore di Database System Concepts'),
(8, 'S.', 'Sudarshan', 'Co-autore di Database System Concepts');

INSERT INTO `weblio`.`autore_libro` (`codice_autore`, `codice_libro`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 6),
(8, 6),
(2, 7),
(3, 8);

INSERT INTO `weblio`.`prenotazioni` (`email`, `codice_libro`, `data_inizio`, `data_fine`) VALUES
('mario.rossi@university.it', 1, '2024-01-15', '2024-02-15'),
('laura.bianchi@university.it', 2, '2024-01-20', '2024-02-20'),
('giuseppe.verdi@university.it', 3, '2024-02-01', '2024-03-01'),
('anna.russo@university.it', 4, '2024-02-10', NULL),
('mario.rossi@university.it', 6, '2024-02-05', '2024-03-05'),
('laura.bianchi@university.it', 5, '2024-02-15', NULL);

INSERT INTO `weblio`.`recensione` (`email`, `codice_libro`, `valutazione`, `descrizione`) VALUES
('mario.rossi@university.it', 1, 5, 'Libro eccellente, molto chiaro negli esempi'),
('laura.bianchi@university.it', 2, 4, 'Buon testo, ma alcuni argomenti potrebbero essere spiegati meglio'),
('giuseppe.verdi@university.it', 3, 3, 'Testo completo ma a volte troppo tecnico'),
('anna.russo@university.it', 4, 5, 'Perfetto per chi vuole approfondire Java'),
('mario.rossi@university.it', 6, 4, 'Ottimo per database avanzati, richiede buone basi preliminari');

INSERT INTO `weblio`.`utente_corso` (`email`, `codice_corso`) VALUES
-- Mario Rossi (Informatica)
('mario.rossi@university.it', 101), -- Basi di Dati
('mario.rossi@university.it', 104), -- Programmazione Java
-- Laura Bianchi (Matematica)
('laura.bianchi@university.it', 102), -- Analisi Matematica 1
('laura.bianchi@university.it', 105), -- Algebra Lineare
-- Giuseppe Verdi (Fisica)
('giuseppe.verdi@university.it', 103), -- Fisica Generale
-- Anna Russo (Informatica)
('anna.russo@university.it', 101), -- Basi di Dati
('anna.russo@university.it', 104), -- Programmazione Java
('anna.russo@university.it', 201), -- Advanced Databases (inglese)
-- Docenti
('prof.smith@university.it', 101), -- John Smith insegna Basi di Dati
('prof.smith@university.it', 104), -- John Smith insegna Programmazione Java
('prof.smith@university.it', 201), -- John Smith insegna Advanced Databases
('prof.rossi@university.it', 102), -- Paolo Rossi insegna Analisi Matematica 1
('prof.rossi@university.it', 105), -- Paolo Rossi insegna Algebra Lineare
-- Elena Ferrari (Fisica - utente non attivo)
('elena.ferrari@university.it', 103); -- Fisica Generale