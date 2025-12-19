<!-- Login Section -->
 <?php var_dump($templateParams);
        var_dump($_POST)?>

        <div class="container-fluid align-middle">
            <div class="form-container justify-content-center max-vw-50">
                <section class="m-5">
                    <h3 class="section-title">Login</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="mb-3">
                        <label for="email-login" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email-login"
                            placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="password-login"
                            class="form-label">Password</label>
                        <input type="password" class="form-control"
                            id="password-login"
                            placeholder="Enter your password">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Sign
                            in</button>
                    </div>
                    </form>
                </section>

            <hr class="hr my-4" />

                <section class="m-5">
                    <!-- Registration Section -->
                    <h3 class="section-title">Registration</h3>
                    <form action="#" method="POST">
                    <div class="mb-3">
                        <label for="email-registrazione" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email-registrazione"
                            placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="password-registrazione"
                            class="form-label">Password</label>
                        <input type="password" class="form-control"
                            id="password-registrazione" placeholder="Create a password">
                    </div>
                    <div class="mb-3">
                        <label for="nome-registrazione"
                            class="form-label">Nome</label>
                        <input type="text" class="form-control"
                            id="nome-registrazione" placeholder="Inserisci il tuo nome">
                    </div>
                    <div class="mb-3">
                        <label for="cognome-registrazione"
                            class="form-label">Cognome</label>
                        <input type="text" class="form-control"
                            id="cognome-registrazione" placeholder="Inserisci il tuo cognome">
                    </div>
                    <div class="mb-3">
                        <label for="matricola-registrazione"
                            class="form-label">N° Matricola</label>
                        <input type="number" class="form-control"
                            id="matricola-registrazione" placeholder="Inserisci il numero matricola">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Sign
                            up</button>
                    </div>
                    </form>
                </section>

            </div>
            <?php if(isset($templateParams["errorelogin"])): ?>
            <p style><?php echo $templateParams["errorelogin"]; ?></p>
            <?php endif; ?>
        </div>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
        </script>