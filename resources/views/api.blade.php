<?php
$bdd = new PDO("mysql:host=localhost;dbname=messagerie;charset=utf8;", "homestead", "secret");
$recupMessage = $bdd->query('SELECT * FROM contacts');
while ($message = $recupMessage->fetch()) {
    ?>
    <div class="message">
        <p><strong><?= $message['name'] ?></strong> : <?= $message['message'] ?></p>
        <?php
        // Vérifier si l'utilisateur actuel est un administrateur avant d'afficher le bouton supprimer
        if (auth()->user()->is_admin == 1) {
            ?>
            <form action="{{ route('contact.destroy', $message['id']) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">Supprimer</button>
            </form>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
