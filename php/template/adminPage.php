<div class="container-fluid my-3 px-3 px-md-4 admin-page">

    <h1 class="text-dark">Pannello Admin</h1>

        <ul class="nav nav-tabs mt-3" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-corsi" type="button">Corsi</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-libri" type="button">Libri</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-autori" type="button">Autori</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-relazioni" type="button">Relazioni</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-utenti" type="button">Utenti</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-recensioni" type="button">Recensioni</button></li>
        </ul>

  <div class="tab-content p-3 bg-dark text-white border border-top-0">

    <!-- CORSI -->
    <div class="tab-pane fade show active" id="tab-corsi">
        <h3>Aggiungi corso</h3>

        <form method="POST" class="row g-2">
            <input type="hidden" name="action" value="add_course">
            <div class="col-md-2"><input class="form-control" name="codice_corso" type="number" placeholder="Codice" required></div>
            <div class="col-md-4"><input class="form-control" name="nome_corso" type="text" placeholder="Nome corso" required></div>
            <div class="col-md-6"><input class="form-control" name="docente" type="text" placeholder="Docente (opzionale)"></div>
            <div class="col-12"><textarea class="form-control" name="descrizione" placeholder="Descrizione" required></textarea></div>
            <div class="col-md-3"><input class="form-control" name="lingua" type="text" value="Italiano"></div>
            <div class="col-md-3"><button class="btn btn-success w-100" type="submit">Aggiungi</button></div>
        </form>

        <hr class="border-secondary">

        <h3>Lista corsi</h3>
        <div class="table-responsive">
            <table class="table table-dark table-striped align-middle">
            <thead>
              <tr>
                <th class="d-none d-md-table-cell">Codice</th>
                <th>Nome</th>
                <th class="d-none d-md-table-cell">Lingua</th>
                <th class="d-none d-md-table-cell">Docente</th>
                <th ></th>
              </tr></thead>
            <tbody>
            <?php foreach ($templateParams["corsi"] as $c): ?>
                <tr>
                <td class="d-none d-md-table-cell"><?= htmlspecialchars($c["codice_corso"]) ?></td>
                <td><?= htmlspecialchars($c["nome_corso"]) ?></td>
                <td class="d-none d-md-table-cell"><?= htmlspecialchars($c["lingua"]) ?></td>
                <td class="d-none d-md-table-cell"><?= htmlspecialchars($c["docente"] ?? "") ?></td>
                <td class="text-end">
                    <form method="POST" class="d-inline">
                    <input type="hidden" name="action" value="delete_course">
                    <input type="hidden" name="codice_corso" value="<?= (int)$c["codice_corso"] ?>">
                    <button class="btn btn-sm btn-danger" type="submit">Elimina</button>
                    </form>
                </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>

    <!-- LIBRI -->
    <div class="tab-pane fade" id="tab-libri">
      <h3>Aggiungi libro</h3>

      <form method="POST" class="row g-2">
        <input type="hidden" name="action" value="add_book">
        <div class="col-md-4"><input class="form-control" name="nome_libro" type="text" placeholder="Titolo" required></div>
        <div class="col-md-2"><input class="form-control" name="edizione" type="number" placeholder="Edizione" required></div>
        <div class="col-md-2"><input class="form-control" name="data_uscita" type="number" placeholder="Anno uscita" required></div>
        <div class="col-md-2">
          <select class="form-select" name="disponibile">
            <option value="0">Non disponibile</option>
            <option value="1">Disponibile</option>
          </select>
        </div>
        <div class="col-12"><textarea class="form-control" name="descrizione" placeholder="Descrizione"></textarea></div>
        <div class="col-md-3"><button class="btn btn-success w-100" type="submit">Aggiungi</button></div>
      </form>

      <hr class="border-secondary">

      <h3>Lista libri</h3>
      <div class="table-responsive">
        <table class="table table-dark table-striped align-middle">
          <thead><tr>
            <th class="d-none d-md-table-cell">ID</th>
            <th>Titolo</th>
            <th class="d-none d-md-table-cell">Ed.</th>
            <th class="d-none d-md-table-cell">Anno</th>
            <th>Disp.</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($templateParams["libri"] as $l): ?>
            <tr>
              <td class="d-none d-md-table-cell"><?= (int)$l["codice_libro"] ?></td>
              <td><?= htmlspecialchars($l["nome_libro"]) ?></td>
              <td class="d-none d-md-table-cell"><?= (int)$l["edizione"] ?></td>
              <td class="d-none d-md-table-cell"><?= (int)$l["data_uscita"] ?></td>
              <td><?= (int)$l["disponibile"] ?></td>
              <td class="text-end">
                <form method="POST" class="d-inline">
                  <input type="hidden" name="action" value="delete_book">
                  <input type="hidden" name="codice_libro" value="<?= (int)$l["codice_libro"] ?>">
                  <button class="btn btn-sm btn-danger" type="submit">Elimina</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- AUTORI -->
    <div class="tab-pane fade" id="tab-autori">
      <h3>Aggiungi autore</h3>

      <form method="POST" class="row g-2">
        <input type="hidden" name="action" value="add_author">
        <div class="col-md-3"><input class="form-control" name="nome_autore" type="text" placeholder="Nome" required></div>
        <div class="col-md-3"><input class="form-control" name="cognome_autore" type="text" placeholder="Cognome" required></div>
        <div class="col-12"><textarea class="form-control" name="descrizione" placeholder="Descrizione"></textarea></div>
        <div class="col-md-3"><button class="btn btn-success w-100" type="submit">Aggiungi</button></div>
      </form>

      <hr class="border-secondary">

      <h3>Lista autori</h3>
      <div class="table-responsive">
        <table class="table table-dark table-striped align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Cognome</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($templateParams["autori"] as $a): ?>
            <tr>
              <td><?= (int)$a["codice_autore"] ?></td>
              <td><?= htmlspecialchars($a["nome_autore"] ?? "") ?></td>
              <td><?= htmlspecialchars($a["cognome_autore"] ?? "") ?></td>
              <td class="text-end">
                <form method="POST" class="d-inline">
                  <input type="hidden" name="action" value="delete_author">
                  <input type="hidden" name="codice_autore" value="<?= (int)$a["codice_autore"] ?>">
                  <button class="btn btn-sm btn-danger" type="submit">Elimina</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- RELAZIONI -->
    <div class="tab-pane fade" id="tab-relazioni">
      <h3>Associa libro ↔ corso</h3>
      <form method="POST" class="row g-2">
        <input type="hidden" name="action" value="link_book_course">
        <div class="col-md-6">
          <select class="form-select" name="codice_libro" required>
            <option value="">Seleziona libro</option>
            <?php foreach ($templateParams["libri"] as $l): ?>
              <option value="<?= $l["codice_libro"] ?>"><?= $l["codice_libro"] ?> - <?= htmlspecialchars($l["nome_libro"]) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-6">
          <select class="form-select" name="codice_corso" required>
            <option value="">Seleziona corso</option>
            <?php foreach ($templateParams["corsi"] as $c): ?>
              <option value="<?= $c["codice_corso"] ?>"><?= $c["codice_corso"] ?> - <?= htmlspecialchars($c["nome_corso"]) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-3"><button class="btn btn-primary w-100" type="submit">Collega</button></div>
      </form>

      <hr class="border-secondary">

      <h3>Associa autore ↔ libro</h3>
      <form method="POST" class="row g-2">
        <input type="hidden" name="action" value="link_author_book">
        <div class="col-md-6">
          <select class="form-select" name="codice_autore" required>
            <option value="">Seleziona autore</option>
            <?php foreach ($templateParams["autori"] as $a): ?>
              <option value="<?= (int)$a["codice_autore"] ?>"><?= (int)$a["codice_autore"] ?> - <?= htmlspecialchars(($a["nome_autore"] ?? "")." ".($a["cognome_autore"] ?? "")) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-6">
          <select class="form-select" name="codice_libro" required>
            <option value="">Seleziona libro</option>
            <?php foreach ($templateParams["libri"] as $l): ?>
              <option value="<?= $l["codice_libro"] ?>"><?= $l["codice_libro"] ?> - <?= htmlspecialchars($l["nome_libro"]) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-3"><button class="btn btn-primary w-100" type="submit">Collega</button></div>
      </form>

      <hr class="border-secondary">

      <h3>Associa utente ↔ corso</h3>
      <form method="POST" class="row g-2">
        <input type="hidden" name="action" value="link_user_course">
        <div class="col-md-6">
          <select class="form-select" name="email" required>
            <option value="">Seleziona utente</option>
            <?php foreach ($templateParams["utenti"] as $u): ?>
              <option value="<?= htmlspecialchars($u["email"]) ?>"><?= htmlspecialchars($u["email"]) ?> (<?= htmlspecialchars($u["nome"]." ".$u["cognome"]) ?>)</option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-6">
          <select class="form-select" name="codice_corso" required>
            <option value="">Seleziona corso</option>
            <?php foreach ($templateParams["corsi"] as $c): ?>
              <option value="<?= (int)$c["codice_corso"] ?>"><?= (int)$c["codice_corso"] ?> - <?= htmlspecialchars($c["nome_corso"]) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-3"><button class="btn btn-primary w-100" type="submit">Collega</button></div>
      </form>
    </div>

    <!-- UTENTI -->
    <div class=" table-responsive tab-pane fade" id="tab-utenti">
      <h3>Lista utenti</h3>
      <div class="table-responsive">
        <table class="table table-dark table-striped align-middle">
          <thead>
            <tr>
              <th>Email</th>
              <th class="d-none d-md-table-cell">Nome</th>
              <th class="d-none d-md-table-cell">Cognome</th>
              <th class="d-none d-md-table-cell">Matricola</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($templateParams["utenti"] as $u): ?>
            <tr>
              <td><?= htmlspecialchars($u["email"]) ?></td>
              <td class="d-none d-md-table-cell"><?= htmlspecialchars($u["nome"]) ?></td>
              <td class="d-none d-md-table-cell"><?= htmlspecialchars($u["cognome"]) ?></td>
              <td class="d-none d-md-table-cell"><?= (int)$u["num_matricola"] ?></td>
              <td class="text-end">
                <form method="POST" class="d-inline">
                  <input type="hidden" name="action" value="delete_user">
                  <input type="hidden" name="email" value="<?= htmlspecialchars($u["email"]) ?>">
                  <button class="btn btn-sm btn-danger" type="submit">Elimina</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Recensioni -->
    <div class=" table-responsive tab-pane fade" id="tab-recensioni">
      <h3>Lista recensioni</h3>
      <div class="table-responsive">
        <table class="table table-dark table-striped align-middle">
          <thead>
            <tr>
              <th>Email Utente</th>
              <th>Codice Libro</th>
              <th class="d-none d-md-table-cell">Valutazione</th>
              <th class="d-none d-md-table-cell">Descrizione</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($templateParams["recensioni"] as $r): ?>
            <tr>
              <td><?= htmlspecialchars($r["email"]) ?></td>
              <td><?= htmlspecialchars($r["codice_libro"]) ?></td>
              <td class="d-none d-md-table-cell"><?= htmlspecialchars($r["valutazione"]) ?></td>
              <td class="d-none d-md-table-cell"><?= htmlspecialchars($r["descrizione"]) ?></td>
              <td class="text-end">
                <form method="POST" class="d-inline">
                  <input type="hidden" name="action" value="delete_review">
                  <input type="hidden" name="email_recensore" value="<?= htmlspecialchars($r["email"]) ?>">
                  <input type="hidden" name="codice_libro" value="<?= (int)$r["codice_libro"]?>">
                  <button class="btn btn-sm btn-danger" type="submit">Elimina</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>        
  </div>
</div>
