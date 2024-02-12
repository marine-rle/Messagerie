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
        <strong style="color: #343a40"><?= $message['name'] ?></strong>
        <?php
            // Vérifier si l'utilisateur actuel est un administrateur avant d'afficher le bouton supprimer
            if (auth()->user()->is_admin == 1) {
            ?>
        <form action="{{ route('contact.destroy', $message['id']) }}" method="post" id="message">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn ">Supprimer</button>
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
        margin-top: 20px;
        padding-left: 20px;
        line-height: 0.2;
    }


    .odd {
        background-color: #f2f2f2;
    }


    .even {
        background-color: #ffffff;
    }

    #message button[type="submit"] {
        background-color: #343a40;
        color: white;
        font-size: small
    }

    #message button[type="submit"]:hover {
        background-color: #4c5054;
        color: white;
        font-size: small
    }
</style>
