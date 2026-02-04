<div class="d-flex flex-column flex-md-row justify-content-between align-items-stretch align-items-md-center gap-2 mb-3">
    <h1 class="m-0"><?= $templateParams["h1"] ?></h1>

    <form class="d-flex gap-2" method="GET" action="catalogo.php">
        <input 
            class="form-control" 
            type="search" 
            name="q"
            placeholder="Cerca un libro..." 
            aria-label="Search">
        <button class="btn btn-outline-primary flex-shrink-0" type="submit">Cerca</button>
    </form>
</div>

<div class="table-responsive">
  <table class="table table-striped table-hover align-middle">
      <thead class="table-dark">
          <tr>
              <th scope="col">Titolo</th>
              <th scope="col" class="d-none d-md-table-cell">Autore</th>
              <th scope="col" class="d-none d-lg-table-cell">Anno uscita</th>
              <th scope="col" class="d-none d-lg-table-cell">Edizione</th>
              <th scope="col">Disponibilità</th>
          </tr>
      </thead>
      
      <tbody>
          <?php foreach ($templateParams["Libri"] as $libro): ?>
          <tr>
              <td>
                <a href="book.php?id=<?= $libro["codice_libro"] ?>">
                  <?= htmlspecialchars($libro["nome_libro"]) ?>
                </a>
              </td>

              <td class="d-none d-md-table-cell">
                <?= htmlspecialchars($libro["autore_completo"]) ?>
              </td>

              <td class="d-none d-lg-table-cell">
                <?= htmlspecialchars($libro["data_uscita"]) ?>
              </td>

              <td class="d-none d-lg-table-cell">
                <?= htmlspecialchars($libro["edizione"]) ?>
              </td>

              <td>
                  <?php if ($libro["disponibile"] == 0): ?>
                      <span class="badge bg-success disp">Disponibile</span>
                  <?php else: ?>
                      <span class="badge bg-danger disp">Non disponibile</span>
                  <?php endif; ?>
              </td>
          </tr>
          <?php endforeach; ?>
      </tbody>
  </table>
</div>

