<?php
$bdd = new PDO("mysql:host=localhost;dbname=messagerie;charset=utf8;", "homestead", "secret");
$recupMessage = $bdd->query('SELECT * FROM contacts');
$counter = 0; // Variable de comptage pour alterner les couleurs

while ($message = $recupMessage->fetch()) {
    $counter++; // Incrémenter le compteur à chaque itération

    // Appliquer une classe différente en fonction de la parité du compteur
    $class = $counter % 2 == 0 ? 'even' : 'odd';
?>

    <div class="message-container <?= $class ?>">
        <div class="message-header">
            <strong><?= $message['name'] ?></strong>
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
        <div class="message-body">
            <?= $message['message'] ?>
        </div>
    </div>
<?php
}
?>
<style>
    .message-container {
        margin-bottom: 20px;
        border: 1px solid #ccc;
        padding: 10px;
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .message-body {
        padding-left: 20px;
    }

    .odd {
        background-color: #f2f2f2; /* Couleur de fond pour les messages impairs */
    }

    /* Vous pouvez définir un style différent pour les messages pairs si nécessaire */
    .even {
        /* background-color: #ffffff; */
    }
</style>
