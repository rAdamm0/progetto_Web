<section class="container my-5 bg-dark p-5 rounded">
    <p class="text-start text-white">Benvenuta matricola su WebLio, la prima biblioteca totalmente online.
        Qui puoi trovare qualsiasi libro utile per il tuo processo di studio</p>
    <button class="btn btn-light justify-content-end ">Più informazioni</button>
</section>
<section class="container my-5 bg-dark p-5 rounded">
    <h2 class="mb-4 fw-bold text-white">Cosa Forniamo</h2>
    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-12 col-md-4">
            <div class="card h-100">
                <img src="../php/uploads/service/studente.jpeg" class="card-img-top" alt="Immagine di un ragazzo intento a leggere su un dispositivo mobile. Rappresenta il profilo utente">
                <div class="card-body">
                    <h3 class="card-title"><a href="personal.php">Profilo</a></h3>
                    <p class="card-text">
                        Puoi creare un semplice profilo immettendo solamente la tua matricola e password!
                    </p>
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-12 col-md-4">
            <div class="card h-100">
                <img src="../php/uploads/service/libreria.jpg" class="card-img-top" alt="Immagine di una biblioteca con scaffali pieni di libri. Rappresenta il catalogo">
                <div class="card-body">
                    <h3 class="card-title"><a href="catalogo.php">Catalogo</a></h3>
                    <p class="card-text">
                        Un Catalogo curato e pieno di libri di ogni tipo e categoria!
                    </p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-12 col-md-4">
            <div class="card h-100">
                <a href="prenotazioni.php">
                <img src="../php/uploads/service/libro.png" class="card-img-top object-fit-fill" alt="Immagine di un libro aperto. Rappresenta le prenotazioni">
                <div class="card-body">
                    <h3 class="card-title">Prenotazioni</h3>
                    </a>
                    <p class="card-text">
                        Prenota quello che necessiti completamente online e ti verrà fornito direttamente tramite email.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5 text-white">
        <div class="row align-items-center">

            <!-- Colonna sinistra (testo) -->
            <div class="col-12 col-md-6">
                <h2 class="fw-bold">Come Prenoto?</h2>

                <h3>Sfoglia il catalogo</h3>
                <p>Sfoglia il catalogo e trova uno o più libri che ti possano interessare</p>

                <h3>Prenota il libro</h3>
                <p>Visualizza la disponibilità e prenota il libro se possibile</p>

                <h3>Consulta la pagina Prenotazioni</h3>
                <p>In questa pagina troverai un calendario con tutti i libri prenotati e la possibilità di prenotarli nuovamente</p>

                <a href="catalogo.php" class="btn btn-light mb-3">Catalogo</a>
                <a class="btn btn-light mb-3" href="book.php?id=<?php echo rand($templateParams["range"]["min"], $templateParams["range"]["max"])?>" >Libro Fortunato</a>
            </div>

            <!-- Colonna destra (immagine) -->
            <div class="col-12 col-md-6">
                <img src="../php/uploads/service/prenotazioni.png" class="img-fluid rounded-3" alt="Immagine di una serie di persone in attesa di prenotare un libro. Rappresenta le prenotazioni">
            </div>
        </div>
    </div>
</section>

<section class="container my-5 bg-dark p-5 rounded text-white">
    <h2 class="mb-2">Come funziona</h2>
    <div>
        <ol>
            <li>Effettua il <a href="personal.php">login</a></li>
            <li>Personalizza la tua pagina personale</li>
            <li>Sfoglia il <a href="catalogo.php">catalogo</a> e trova un libro che ti interessa</li>
            <li>Apri la pagina del libro e visualizza le recensioni</li>
            <li>Se disponibilie clicca il tasto prenota</li>
            <li>Visualizza il <a href="prenotazioni.php">calendario</a> e clicca su una data per selezionarla come ultimo giorno della prenotazione</li>
            <li>Clicca il pulsante prenota e il libro ti verra inviato direttamente sulla tua mail!</li>
        </ol>
    </div>
</section>

<section>
    <div class="container text-center">
        <h2 class="mb-5">Chi Siamo?</h2>

        <div class="row justify-content-center pb-5">

            <!-- Profilo 1 -->
            <div class="col-12 col-md-5">
                <img src="../html/assets/foto.png" class="rounded w-75 img-fluid mb-3" alt="...">
                <h2>Lorenzo Casadei</h2>
                <p>matr:</p>
            </div>

            <!-- Profilo 2 -->
            <div class="col-12 col-md-5">
                <img src="../html/assets/foto.png" class="rounded w-75 img-fluid mb-3" alt="...">
                <h2>Adam Paolo Razzino</h2>
                <p>Email: adampaolo.razzino@studio.unibo.it</p>
                <p>N° Matricola: 0001126965</p>
            </div>

        </div>
    </div>
</section>
