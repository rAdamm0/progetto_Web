<section class="mx-4">
  <h1 class="mb-4 mx-auto text-center">About You</h1>
            <div class="container">
                <div class="row">
                    <!-- Immagine - in alto su mobile, destra su desktop -->
                    <div
                        class="col-12 col-md-4 order-first order-md-last text-center">
                        <div class="mb-4">
                            <img src="./assets/foto.png"
                                alt="Profile Image"
                                class="rounded img-fluid ml-3 "
                                style="object-fit: cover;">
                        </div>
                    </div>

                    <!-- Lista - sotto l'immagine su mobile, sinistra su desktop -->
                    <div class="col-12 col-md-8 order-last order-md-first">
                        <aside>
                            <ul class="list-group">
                                <li class="list-group-item"><?php echo $templateParams["info"]["nome"]?></li>
                                <li class="list-group-item">Corso: Ingegneria e
                                    Scienze Informatiche</li>
                                <li class="list-group-item">Eta': 23 anni</li>
                                <li class="list-group-item">Numero Matricola:
                                    0001126965</li>
                                <li class="list-group-item">Anno: Terzo</li>
                                <li class="lsit-group-item text-end"
                                    style="list-style: none;"><span
                                        class="badge"><button type=" button"
                                            class="btn btn-outline-danger">Edit</button></span></li>
                            </ul>
                            <section class="mt-3">
                                <!--Ognuno di questi badge avrà una funzionalità Js in cui onClick verrà eliminato e mandato una query deleteTagByEmail-->
                                <span class="badge text-bg-secondary">Ingegneria
                                    del
                                    Software</span>
                                <span class="badge text-bg-secondary">Tecnologie
                                    Web</span>
                                <span class="badge text-bg-secondary">OOP</span>
                                <span class="badge text-bg-secondary">Sistemi
                                    Operativi</span>
                                <span
                                    class="badge text-bg-secondary">Fisica</span>
                                <span class="badge text-bg-secondary">Matematica
                                    delle Probabilita'</span>
                                <span class="badge text-bg-warning">Aggiungi
                                    Corso</span><!--Link gestito da Js Apre una lista di corsi-->
                            </section>
                        </aside>
                    </div>
                </div>
            </div>
</section>