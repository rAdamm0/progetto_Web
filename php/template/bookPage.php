<?php
$libro = $templateParams["Libro"] ?? null;
if (!$libro) {
    echo '<div class= "container py-5"><div class = "alert alert-danger">Libro non trovato.</div></div>';
    return;
}
# dati del libro
$nome = htmlspecialchars($libro["nome_libro"]);
$edizione = htmlspecialchars($libro["edizione"]);
$autori = htmlspecialchars($libro["autori"]);
$disponibilità = intval($libro["disponibile"]);
$descrizione = htmlspecialchars($libro["descrizione"]);
$data_uscita = htmlspecialchars($libro["data_uscita"]);
$img = htmlspecialchars($libro["immagine"] ?? "default_cover.png");

?>
<header>
    <h1><?=  $templateParams["h1"]?></h1>
</header>
<div class="container-fluid my-3 px-3 px-md-4">
    <div class="row g-4">
        <div class="col-12 col-md-4 col-lg-3">
            <div class="card shadow-sm ratio ratio-6x9">
                    <img src="uploads/books/<?php echo $img?>" alt="Copertina del libro: <?php echo $nome?>"/>
            </div>
            <div class="d-grid gap-2 mt-3">
                <a href="prenotazioni.php?id=<?php echo $id?>&nome=<?php echo $libro["nome_libro"]?>&edizione=<?php echo $libro["edizione"]?>" 
                class="btn btn-<?php if($disponibilità==1): echo "danger";else:echo "success";endif;?>" <?php if($disponibilità==1): echo "disabled"; endif;?>>Prenota</a>
            </div>
        </div>
        <div class="cik-12 col-md-8 col-lg-9">
            <div class="card-shadow-sm">
                <div class="card-body">
                    <h2 class="mb-1"><?= $nome ?></h2>
                    <p class="text-muted mb-3"><?= $autori ?></p>
                    <div class="row gy-2">
                        <div class="col-12 col-lg-6">
                            <div class="p-3 border rounded bg-light">
                                <div class="small text-muted">Edizione</div>
                                <div class="fw-semibold"><?= $edizione ?></div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="p-3 border rounded bg-light">
                                <div class="small text-muted">Disponibilità</div>
                                <?php if ($disponibilità == 0): ?>
                                    <div class="fw-semibold text-success">Disponibile</div>
                                <?php else: ?>
                                    <div class="fw-semibold text-danger">Non disponibile</div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h5>Descrizione</h5>
                    <p class="text-muted mb-0"><?= $descrizione ?></p>
                </div>
            </div>
            <div class="card shadow-sm mt-4">
                <div class="card-body bg-light">
                    <h5 class="mb-3">Dettagli</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Titolo</span>
                            <span class="fw-semibold"><?= $nome ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Autori</span>
                            <span class="fw-semibold"><?= $autori ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Edizione</span>
                            <span class="fw-semibold"><?= $edizione ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Data di uscita</span>
                            <span class="fw-semibold"><?= $data_uscita ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card shadow-sm mt-4">
                <div class="card-body shadow-sm bg-light">
                    <?php if(!empty($_SESSION["email"])): ?>
                        <h6 class="fw-semibold mb-3">Scrivi recensione</h6>
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <form method="POST" action="book.php?id=<?= (int)$id ?>" class="row g-2">
                                        <input type="hidden" name="action" value="add_review">
                                        <input type="hidden" name="id" value="<?= (int)$id ?>">
                                        <div class="col-12 col-md-4">
                                            <label class="form-label mb-1">Valutazione</label>
                                            <select name="valutazione" class="form-select" required>
                                                <option value="">Seleziona</option>
                                                <option value="5"> - Ottimo</option>
                                                <option value="4"> - Discreto</option>
                                                <option value="3"> - Buono</option>
                                                <option value="2"> - Mediocre</option>
                                                <option value="1"> - Pessimo</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label mb-1" required>Testo</label>
                                            <textarea name="descrizione" class="form-control" rows="3" placeholder="Scrivi qui la tua recensione..." required></textarea>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <button class="btn btn-primary w-100" type="submit">
                                                Invia
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        
                    <?php else : ?>
                        <div class="alert alert-info">Per scrivere una recensione devi effetuare il login</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card shadow-sm mt-4">
                <div class="card-body bg-light">
                    <h5 class="fw-semibold mb-3">Recensioni</h5>

                    <?php if (empty($templateParams["recensione"])): ?>
                        <p class="text-muted">Nessuna recensione disponibile.</p>
                    <?php else: ?>
                        <?php foreach ($templateParams["recensione"] as $recensione): ?>
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title fw-semibold">
                                        <?= htmlspecialchars($recensione["recensore"]) ?>
                                    </h6>

                                    <div class="mb-2">
                                        <span class="badge bg-primary">
                                            Valutazione: 
                                            <?php for($i = 0 ; $i < intval($recensione["valutazione"]) ; $i++ ):?>
                                            <i class="bi bi-star-fill"></i>
                                            <?php endfor ?>
                                            <?php for($i = 0; $i<( 5 - intval($recensione["valutazione"])); $i++):?>
                                            <i class="bi bi-star"></i>
                                            <?php endfor ?>
                                        </span>
                                    </div>

                                    <p class="card-text text-muted mb-0">
                                        <?= htmlspecialchars($recensione["descrizione"]) ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
