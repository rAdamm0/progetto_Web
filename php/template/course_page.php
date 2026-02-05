<?php
    $randomCourses = $templateParams["randomCourses"];
    $courses = $templateParams["courses"];
    $q = $templateParams["searchQuery"];
    $h1 = $templateParams["h1"];
?>
<div class="container-fluid my-3 px-3 px-md-4">
    <h1 class="display-4 fw-semibold mb-4"><?php echo htmlspecialchars($h1) ?></h1>
    <div id="coursesCarousel" class="carousel slide carousel-dark" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $first = true; ?>
            <?php foreach ($randomCourses as $c) : ?>
            <?php
                $activeClass = $first ? "active" : "";
                $first  = false;
                $imgUrl = "../php/uploads/courses/".rand(1,3).".png";  
            ?>
            <div class="carousel-item <?php echo $activeClass; ?>">
                <div class="d-flex justify-content-center">
                    <img src="<?= $imgUrl;?>" 
                    class="d-block rounded"
                    style="max-width: 420px;width : 100%;"
                    alt="cover corso">
                </div>
                <div class="mt-4">
                    <h2 class="fw-semibold"><?= htmlspecialchars($c["nome_corso"]) ?></h2>
                    <p class="fs-5 mb-0"><?= htmlspecialchars($c["descrizione"]) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- Frecce -->
        <button class="carousel-control-prev" type="button" data-bs-target="#coursesCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Precedente</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#coursesCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Successivo</span>
        </button>
        <!-- trattini -->
        <div class="carousel-indicators position-static mt-3">
        <?php for ($i = 0; $i < count($randomCourses); $i++) : ?>
            <button type="button"
                    data-bs-target="#coursesCarousel"
                    data-bs-slide-to="<?php echo $i; ?>"
                    class="<?php echo ($i === 0) ? "active" : ""; ?>"
                    aria-current="<?php echo ($i === 0) ? "true" : "false"; ?>"
                    aria-label="Slide <?php echo $i + 1; ?>"></button>
        <?php endfor; ?>
        </div>
    </div>
    <h2 class="display-5 fw-bold mt-5 mb-3">Elenco dei corsi</h2>
    <div class = "card mb-4">
        <div class = "card-body d-flex allign-items-center gap-3">
            <div class="fs-4">Corsi</div>
            <form class = "ms-auto d-flex gap-2"method="GET" action="courses.php">
                <input class = "form-control" type="search" name="q"
                                value="<?= htmlspecialchars($q) ?>"
                                placeholder="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
    <?php if (empty($courses)) : ?>
        <div class="alert alert-warning">Nessun corso trovato.</div>
    <?php else : ?>
        <div class="row g-4">
            <?php foreach($courses as $c) : ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="fw-bold fs-2 mb-1">
                                <?= htmlspecialchars($c["codice_corso"]); ?>
                            </div>
                            <div class="fs-4 fw-semibold">
                                <?= htmlspecialchars($c["nome_corso"]); ?>
                            </div>
                            <div class= "text-muted fs-5 mb-3">
                                <?= htmlspecialchars($c["docente"]); ?>
                            </div>
                            <p class="mb-3">
                                <?= htmlspecialchars($c["descrizione"]); ?>
                            </p>
                            <a class="link-primary" href="catalogo.php?course=<?= urlencode($c["codice_corso"]) ?>">
                                Vai ai libri
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
