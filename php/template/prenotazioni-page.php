<section class="mx-4">


  <h2 class="mx-auto w-50 text-center">Prenotazioni</h2>
  <div class="container">
    <div id="calendar"></div>
  </div>
  <hr class="hr my-4" />
  <h2 class="mx-auto w-50 text-center">Prenota un libro</h2>
  <div>
    <?php if (!isset($_SESSION["email"])): ?>
      <p class="w-50 mx-auto text-center text-danger">Non sei loggato, la prenotazione non verrà completata <a
          href="personal.php">Login</a></p>
    <?php endif; ?>
  </div>
  <div id="prenotazione mb-5">
    <form method="post" onsubmit="event.preventDefault(); addBooking(this);">
      <fieldset>
        <div class="form-group">
          <label for="libro">Scegli un libro: </label>
          <select class="form-select mb-3" name="libro" id="libro" required data-bs-toggle="popover"
            data-bs-placement="top">
            <?php if (isset($_GET["id"])): ?>
              <option value="<?php echo $_GET["id"] ?>" selected><?php echo $_GET["nome"] ?> -
                <?php echo $_GET["edizione"]; ?>° Edizione</option>
            <?php else: ?>
              <option value="" selected disabled>Seleziona un libro...</option>
            <?php endif; ?>
            <?php foreach ($templateParams["prenotabili"] as $book): ?>
              <option value="<?php echo $book["id"]; ?>">
                <?php echo $book["libro"]; ?> - <?php echo $book["edizione"]; ?>° Edizione
              </option>
            <?php endforeach; ?>
          </select>
          <div id="validationServer03Feedback" class="invalid-feedback">
          </div>
        </div>

        <div class="form-group mb-3">
          <label for="data-inizio">Data Inizio</label>
          <input type="date" name="data-inizio" id="data-inizio" readonly class="form-control"
            value="<?php echo date("Y-m-d") ?>" />
        </div>

        <div class="form-group mb-3">
          <label for="data-fine">Data Fine</label>
          <input type="date" name="data-fine" id="data-fine" required class="form-control" />
        </div>

        <div class="form-group mb-3">
          <input type="submit" id="save-event" name="save-event" value="Prenota" class="btn btn-success" />
        </div>

      </fieldset>
    </form>
  </div>
  <hr class="hr my-4" />
  <h2 class="mx-auto w-50 text-center">Annulla Prenotazione</h2>
  <div class="mb-5">
      <fieldset>
        <form action="" method="POST" onsubmit="event.preventDefault(); cancelBooking(this);">
          <select class="form-select mb-3" name="id" id="id cancel" required data-bs-toggle="popover"
      data-bs-placement="top">
      <option value="none">Seleziona un libro</option>
              <?php foreach ($templateParams["prenotati"] as $booked):?>
                <option value="<?php echo $booked["id"]?>">
                  <?php echo $booked["libro"]; ?> - <?php echo $booked["edizione"]; ?>° Edizione
                </option>
                <?php endforeach;?>
              </select>
              <div id="validationServer03Feedback" class="invalid-feedback cancel">
              </div>
              <input type="submit" class="btn btn-danger" value="Annulla Prenotazione"/>
        </form>
      </fieldset>
  </div>
</section>