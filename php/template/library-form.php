
<table class= "table table-stripped table-hover">
    <thead class = "table-dark">
        <tr>
            <th scope = "col">Titolo</th>
            <th scope = "col">Autore</th>
            <th scope = "col">Anno uscita</th>
            <th scope = "col">Edizione</th>
            <th scope = "col">Disponibilità</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($templateParams["Libri"] as $libro):?>
        <tr>
            <td><a href="book.php?id=<?=  $libro["codice_libro"]?>"><?= htmlspecialchars($libro["nome_libro"]) ?></a></td>
            <td><?= htmlspecialchars($libro["autore_completo"]) ?></td>
            <td><?= htmlspecialchars($libro["data_uscita"])?></td>
            <td><?= htmlspecialchars($libro["edizione"]) ?></td>
            <td>
                <?php if ($libro["disponibile"] == 0): ?>
                    <span class="badge bg-success">Disponibile</span>
                <?php else: ?>
                    <span class="badge bg-danger">Non disponibile</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>
