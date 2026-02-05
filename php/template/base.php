<!DOCTYPE html>
<html lang="it">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if (!empty($templateParams["calendario"])): ?>
            <?php foreach ($templateParams["calendario"] as $cal): ?>
                <?php echo $cal; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Playfair+Display" />
        <link rel="stylesheet" href="../css/styles.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <title><?php echo $templateParams["titolo"] ?></title>
    </head>

    <body class="d-flex flex-column min-vh-100">
        <main class="flex-grow-1">
            <!--OFF-CANVA-->
            <section>
                <div class="offcanvas offcanvas-start toggle" tabindex="-1" id="offcanvas">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasLabel">Informazioni aggiuntive</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <h6>Creatori del sito</h6>
                        <ul>
                            <li>
                                Casadei Lorenzo - 
                                n° matricola:
                                email: lorenzo.casadei16@studio.unibo.it
                            </li>
                            <li>
                                Razzino Adam Paolo - 
                                n° matricola: 0001126965
                                email: adampaolo.razzino@studio.unibo.it
                            </li>
                        </ul>
                        <p>Un sito che si occupa della presentazione di libri universitari,
                            dando la possibilità di creare un proprio profilo personalizzabile, visualizzare il catalogo
                            presentato, prenotare e lasciare recensioni di libri
                        </p>
                    </div>
                </div>
            </section>
            <!--NAVBAR-->
            <section>
                <nav class="navbar navbar-expand-lg text-white bg-dark mb-3">
                    <div class="container-fluid">
                        <a class="navbar-brand text-white" href="home.php">WebLio</a>
                        <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active text-white" aria-current="page" href="home.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="courses.php">Corsi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="catalogo.php">Catalogo</a>
                                </li>
                                <?php if($_SESSION["email"] == "admin@university.it"): ?>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="admin.php">Admin</a>
                                </li>
                                <?php endif;?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        About You
                                    </a>
                                    <ul class="dropdown-menu bg-dark">
                                        <li><a class="dropdown-item text-white" href="prenotazioni.php">Prenotazioni</a>
                                        </li>
                                        <li><a class="dropdown-item text-white" data-bs-toggle="offcanvas"
                                                href="../php/personal.php">
                                                <?php if(isset($_SESSION["email"])):
                                                    echo "Profilo";
                                                    else:
                                                    echo "Login";
                                                    endif;?>
                                                </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </section>

            <div class="mx-4">
                <?php require($templateParams["baseUpperPage"]) ?>
            </div>
        </main>

        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <p class="col-md-4 mb-0 text-muted">© 2026, WeBlio</p>

            <a href="../php/home.php" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <i class="bi bi-book-fill fs-3"></i>
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="home.php" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a data-bs-toggle="offcanvas" href="#offcanvas" class="nav-link px-2 text-muted">About</a></li>
            </ul>
        </div>
        </footer>
        <?php if(isset($templateParams["script"])):?>
        <script src="../js/<?php echo $templateParams["script"]?>?v=<?php echo time(); ?>"></script>
        <?php endif;?>
    </body>

</html>
