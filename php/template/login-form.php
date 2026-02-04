<!-- Login Section -->
<div class="container my-5">
    <div class="form-container row max-vw-50">
        <section class="col-md-6 mb-4 border-md-end pe-md-5">
            <h2 class="section-title">Login</h2>
            <form action="#" method="POST" onsubmit="event.preventDefault(); login(this)">
                <div class="mb-3">
                    <label for="emailLogin" class="form-label">Email</label>
                    <input type="email" class="form-control" id="emailLogin" name="emailLogin" required
                        placeholder="Inserisci la tua email" value="<?php echo htmlspecialchars($_POST['emailLogin'] ?? ''); ?>" />
                    <div id="validationServer01Feedback" class="invalid-feedback login">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="passwordLogin" class="form-label">Password</label>
                    <input type="password" class="form-control mb-3" id="passwordLogin" name="passwordLogin" required
                        placeholder="Inserisci la tua password"
                        value="<?php echo htmlspecialchars($_POST['passwordLogin'] ?? ''); ?>"/>
                        <input type="checkbox" class="btn-check" id="btncheck1"
                        onclick="const input = document.getElementById('passwordLogin'); input.type = this.checked ? 'text' : 'password';">
                        <label class="btn btn-outline-primary" for="btncheck1">Mostra password</label>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Entra</button>
                </div>
            </form>
        </section>

        <section class="col-md-6 ps-md-5">
            <!-- Registration Section -->
            <h2 class="section-title">Registrazione</h2>
            <form action="#" method="POST" onsubmit="event.preventDefault(); registration(this);">
                <div class="mb-3">
                    <label for="emailReg" class="form-label">Email</label>
                    <input type="email" class="form-control" id="emailReg" name="emailReg" placeholder="Inserisci la tua email"
                        value="<?php echo htmlspecialchars($_POST['emailReg'] ?? ''); ?>"/>
                        <div id="validationServer02Feedback" class="invalid-feedback registration">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="passwordReg" class="form-label">Password</label>
                    <input type="password" class="form-control mb-3" id="passwordReg" name="passwordReg"
                        placeholder="Create a password"
                        value="<?php echo htmlspecialchars($_POST['passwordReg'] ?? ''); ?>"/>
                    <input type="checkbox" class="btn-check top-100" id="btncheck2"
                    onclick="const input = document.getElementById('passwordReg'); input.type = this.checked ? 'text' : 'password';">
                    <label class="btn btn-outline-success" for="btncheck2">Mostra password</label>
                </div>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Inserisci il tuo nome"
                        value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="cognome" class="form-label">Cognome</label>
                    <input type="text" class="form-control" id="cognome" name="cognome"
                        placeholder="Inserisci il tuo cognome"
                        value="<?php echo htmlspecialchars($_POST['cognome'] ?? ''); ?>" />
                </div>
                <div class="mb-3">
                    <label for="matricola" class="form-label">N° Matricola</label>
                    <input type="number" class="form-control" id="matricola" name="matricola"
                        placeholder="Inserisci il Numero di matricola"
                        value="<?php echo htmlspecialchars($_POST['matricola'] ?? ''); ?>"/>
                        <div id="validationServer03Feedback" class="invalid-feedback matricola">
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Registrati</button>
                </div>
            </form>
        </section>

    </div>
</div>

