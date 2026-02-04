<section class="mx-4">
    <h1 class="mb-4 mx-auto text-center">Bentornato <?php echo $templateParams["infos"][0]["nome"]?></h1>
    <div class="container">
        
        <div class="row">
            <!-- Immagine - in alto su mobile, destra su desktop -->
            <div class="col-12 col-md-4 order-first order-md-last text-center">
                <div class="mb-4">
                    <img src="<?php echo htmlspecialchars($templateParams["infos"][0]["immagine_profilo"]) ?>"
                        alt="Profile Image" class="rounded img-fluid ml-3 " style="object-fit: cover;">
                </div>
            </div>
            <!-- Lista - sotto l'immagine su mobile, sinistra su desktop -->
            <div class="col-12 col-md-8 order-last order-md-first">
                <aside>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <?php echo $templateParams["infos"][0]["nome"] . " " . $templateParams["infos"][0]["cognome"] ?>
                        </li>
                        <li class="list-group-item">Corso: <?php echo $templateParams["infos"][0]["corso"] ?></li>
                        <li class="list-group-item">Numero Matricola:
                            <?php echo str_pad($templateParams["infos"][0]["num_matricola"], 10, "0", STR_PAD_LEFT); ?>
                        </li>
                        <li class="list-group-item">Anno: <?php echo $templateParams["infos"][0]["anno"] ?></li>
                        <li class="lsit-group-item text-end" style="list-style: none;"><span class="badge"><button
                                    type="button" class="btn btn-outline-danger"
                                    onclick="openEditModal()">Edit</button></span></li>
                    </ul>


                    <!--updateUserInfos($email, $nome, $cognome, $corso, $anno, $num_matricola, $immagine_profilo);-->

                    <dialog id="editModal">
                        <h2>Edit Profile</h2>
                        <form method="POST" action="utilis/update_profile.php"
                            onsubmit="event.preventDefault(); updateProfile(this);">
                            <label class="form-label">Name:</label>
                            <input type="text" name="nome" class="form-control mb-2"
                                value="<?php echo htmlspecialchars($templateParams["infos"][0]["nome"]); ?>" required>

                            <label class="form-label">Cognome:</label>
                            <input type="text" name="cognome" class="form-control mb-2"
                                value="<?php echo htmlspecialchars($templateParams["infos"][0]["cognome"]); ?>"
                                required>

                            <label class="form-label">Email (Cannot change):</label>
                            <input type="text" class="form-control mb-2"
                                value="<?php echo htmlspecialchars($_SESSION["email"]) ?>" disabled>

                            <label class="form-label">Corso:</label>
                            <input type="text" name="corso" class="form-control mb-2"
                                value="<?php echo htmlspecialchars($templateParams["infos"][0]["corso"]); ?>" required>

                            <label class="form-label">Anno:</label>
                            <input type="text" name="anno" class="form-control mb-3"
                                value="<?php echo htmlspecialchars($templateParams["infos"][0]["anno"]); ?>" required>


                            <label class="form-label me-3">Profile Picture:</label>
                            <img id="profilePreview" src="uploads/default_avatar.png" alt="Anteprima Immagine Profilo"
                                style="width:100px; height:100px;" class="mb-3 object-fit-contain">
                            <input type="file" name="profile_pic" class="form-control mb-2"
                                onchange="previewImage(event)" accept="image/*">
                            <input type="hidden" name="current_image_hidden"
                                value="<?php echo htmlspecialchars($templateParams["infos"][0]["immagine_profilo"]) ?>">

                            <div class="actions justify-content-centre">
                                <button type="button" class="btn btn-danger" onclick="closeEditModal()">Cancel</button>
                                <button type="submit" class="btn btn-success" name="update">Save Changes</button>
                            </div>
                        </form>
                    </dialog>

                    <section class="mt-3">
                        <!--Ognuno di questi badge avrà una funzionalità Js in cui onClick verrà eliminato e mandato una query deleteTagByEmail-->
                        <?php foreach ($templateParams["tags"] as $pill): ?>

                            <span class="badge text-bg-secondary coursePill" id="<?php echo $pill["codice_corso"] ?>"><?php echo $pill["nome_corso"] ?></span>
                        <?php endforeach; ?>
                        <span class="badge text-bg-warning" id="add-course">Aggiungi
                            Corso</span><!--Link gestito da Js Apre una lista di corsi-->

                        <dialog id="course-edit" class="modal-sm ">
                            <h2>Add Course</h2>
                            <form method="POST" action="utilis/update_tags.php"
                            onsubmit="event.preventDefault(); updateTags(this);">
                                <?php foreach ($templateParams["courses"] as $course): ?>
                                    <?php
                                    // Controlla che questo corso sia fra quelli già registrati
                                    $isChecked = in_array($course["nome_corso"], array_column($templateParams["tags"], 'nome_corso')) ? "checked" : "";
                                    if($isChecked!="checked"):
                                    ?>
                                    <div class="form-check">
                                        <input type="checkbox" name="codici[]" value="<?php echo $course["codice_corso"]; ?>"
                                            id="<?php echo $course["codice_corso"]; ?>">

                                        <label for="<?php echo $course["codice_corso"]; ?>">
                                            <?php echo $course["nome_corso"]; ?>
                                        </label>
                                    </div>
                                    <?php endif;?>
                                <?php endforeach; ?>

                                <input type="submit" class="btn btn-primary" value="Save Changes"/>
                                <input type="button" class="btn btn-danger" value="Cancel" onclick=closeTagModal()>
                            
                            </form>
                        </dialog>
                    </section>
                </aside>
            </div>
        </div>
    </div>
</section>
<hr class="hr my-4" />
<section class="mx-4">
<!--Elenco Passate Prenotazioni-->
<div>
    <h2>Prenotazioni</h2>
    <table class="table  mh-100 overflow-auto">
        <thead>
            <tr>
                <th scope="col">Libro</th>
                <th scope="col">Autori</th>
                <th scope="col">Data Inizio</th>
                <th scope="col">Data Fine</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php if (array_key_exists("bookings", $templateParams)): ?>
                <?php foreach ($templateParams["bookings"] as $booking): ?>
                    <tr>
                        <td><?php echo $booking["nome_libro"] ?></td>
                        <td><?php echo $booking["autori"] ?></td>
                        <td><?php echo $booking["data_inizio"] ?></td>
                        <td><?php echo $booking["data_fine"] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<hr class="hr my-4" />
<span><input class="btn btn-danger mx-auto"type="button" value="Logout" onclick=delete_cookie("PHPSESSID")></span>
                </section>
