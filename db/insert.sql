INSERT INTO `weblio`.`utente` (`email`, `pw`, `nome`, `cognome`, `corso`, `num_matricola`,`immagine_profilo`) VALUES
('mario.rossi@university.it', SHA2('password123', 512), 'Mario', 'Rossi', 'Informatica',  1000000001,''),
('laura.bianchi@university.it', SHA2('password123', 512), 'Laura', 'Bianchi', 'Matematica',  1000000002,''),
('giuseppe.verdi@university.it', SHA2('password123', 512), 'Giuseppe', 'Verdi', 'Fisica',  1000000003,''),
('anna.russo@university.it', SHA2('password123', 512), 'Anna', 'Russo', 'Informatica', 1000000004,''),
('prof.smith@university.it', SHA2('prof123', 512), 'John', 'Smith', 'Informatica', 2000000001,''),
('prof.rossi@university.it', SHA2('prof123', 512), 'Paolo', 'Rossi', 'Matematica', 2000000002,''),
('elena.ferrari@university.it', SHA2('password123', 512), 'Elena', 'Ferrari', 'Fisica', 1000000005,''),
('admin@university.it', SHA2('adminpw123',512),'admin','admin','admin',0000000000,'');

INSERT INTO `weblio`.`corsi` (`codice_corso`, `nome_corso`, `descrizione`, `lingua`, `docente`) VALUES
(101, 'Basi di Dati', 'Corso fondamentale sulle basi di dati e SQL', 'Italiano', 'John Smith'),
(102, 'Analisi Matematica 1', 'Corso di analisi matematica per il primo anno', 'Italiano', 'Paolo Rossi'),
(103, 'Fisica Generale', 'Principi fondamentali della fisica classica', 'Italiano', 'Maria Bianchi'),
(104, 'Programmazione Java', 'Corso avanzato di programmazione in Java', 'Italiano', 'John Smith'),
(105, 'Algebra Lineare', 'Corso di algebra lineare e geometria', 'Italiano', 'Paolo Rossi'),
(201, 'Advanced Databases', 'Advanced database concepts and NoSQL', 'English', 'John Smith');

INSERT INTO `weblio`.`libri` 
(`codice_libro`, `nome_libro`, `edizione`, `data_uscita`, `descrizione`, `disponibile`, `immagine_libro`) VALUES
(1, 'Basi di Dati: Concetti e Linguaggi', 5, 2018, 'Manuale introduttivo e avanzato sui concetti fondamentali delle basi di dati relazionali.', 0,'base_di_dati.png'),
(2, 'Analisi Matematica 1', 8, 2016, 'Testo universitario di riferimento per lo studio dei limiti, derivate e integrali.', 0, 'analisi_matematica.png'),
(3, 'Fisica Generale: Meccanica e Termodinamica', 4, 2014, 'Volume dedicato alla meccanica classica e ai principi di termodinamica.', 1, 'fisica_generale.jpg'),
(4, 'Programmazione Java Avanzata', 3, 2019, 'Guida alla programmazione avanzata in Java con esempi su OOP e pattern.', 1,'OOP.jpg'),
(5, 'Algebra Lineare e Geometria', 6, 2015, 'Libro che tratta vettori, matrici, spazi vettoriali e geometria analitica.', 0,'algebra_e_geometria.jpg'),
(6, 'Database System Concepts', 7, 2020, 'Classico testo in inglese sulla progettazione e gestione dei database.', 1,'database.jpeg'),
(7, 'Calcolo Differenziale e Integrale', 2, 2013, 'Introduzione al calcolo differenziale e integrale con numerosi esercizi.', 0, 'calcolo_diff.jpg'),
(8, 'Fisica: Elettromagnetismo e Onde', 3, 2017, 'Volume dedicato ai campi elettrici, magnetici e alla propagazione delle onde.', 0, 'fisica_elettr.jpg');

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

INSERT INTO `weblio`.`prenotazioni` (`id_prenotazioni`,`email`, `codice_libro`, `data_inizio`, `data_fine`) VALUES
(1,'mario.rossi@university.it', 1, '2024-01-15', '2024-02-10'),
(2,'laura.bianchi@university.it', 2, '2024-01-20', '2024-02-19'),
(3,'giuseppe.verdi@university.it', 3, '2024-02-01', '2024-02-20'),
(4,'anna.russo@university.it', 4, '2024-02-10', '2024-02-20'),
(5,'mario.rossi@university.it', 6, '2024-02-05', '2024-03-03'),
(6,'laura.bianchi@university.it', 5, '2024-02-15', '2024-02-25');

INSERT INTO `weblio`.`recensione` (`email`, `codice_libro`, `valutazione`, `descrizione`) VALUES
('mario.rossi@university.it', 1, 5, 'Libro eccellente, molto chiaro negli esempi'),
('laura.bianchi@university.it', 2, 4, 'Buon testo, ma alcuni argomenti potrebbero essere spiegati meglio'),
('giuseppe.verdi@university.it', 3, 3, 'Testo completo ma a volte troppo tecnico'),
('anna.russo@university.it', 4, 5, 'Perfetto per chi vuole approfondire Java'),
('mario.rossi@university.it', 6, 4, 'Ottimo per database avanzati, richiede buone basi preliminari');

INSERT INTO `weblio`.`utente_corso` (`email`, `codice_corso`) VALUES
('mario.rossi@university.it', 101),
('mario.rossi@university.it', 104),
('laura.bianchi@university.it', 102),
('laura.bianchi@university.it', 105),
('giuseppe.verdi@university.it', 103),
('anna.russo@university.it', 101),
('anna.russo@university.it', 104),
('anna.russo@university.it', 201),
('prof.smith@university.it', 101),
('prof.smith@university.it', 104),
('prof.smith@university.it', 201),
('prof.rossi@university.it', 102),
('prof.rossi@university.it', 105),
('elena.ferrari@university.it', 103);

INSERT INTO config (last_date) VALUES (CURDATE());