<table class= "table table-stripped table-hover">
    <thead class = "table-dark">
        <tr>
            <th scope = "col">Titolo</th>
            <th scope = "col">Autore</th>
            <th scope = "col">Anno uscita</th>
            <th scope = "col">Edizione</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($templateParams["Libri"] as $libro): ?>
        <tr>
            <td><?= htmlspecialchars($libro["nome_libro"]) ?></td>
            <td><?= htmlspecialchars($libro["autore_completo"]) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
