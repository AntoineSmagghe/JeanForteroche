<?php

/**
 * VIEW OF ALL THE SIGNALED COMMENTS IN THE ADMIN PART
 * 
 */

ob_start();
$title = "Commentaires signalés par les utilisateurs sur le site de Jean Forteroche";
?>

<div id="signalements_page">
    <?php if ($_SESSION['countSign'] === 0) { ?>
        <h2>Aucun commentaire signalé.</h2>
    <?php } else { ?>
        <h2><?= $_SESSION['countSign'] ?> commentaire<?php if ($_SESSION['countSign'] > 1) {echo 's ont';}else{echo ' a';} ?> été signalé<?php if ($_SESSION['countSign'] > 1) {echo 's';} ?> :</h2>
    <?php }
    while ($data = $viewSign->fetch()) { ?>
        <section class="comment">
            <h4><?= $data['name'] ?> <span class="info_date"> a commenté <?= $data['dateComment'] ?></span></h4>
            <p><?= nl2br($data['txt']); ?> </p>
            <a class="del" href="index.php?pge=admin&action=deleteComm&idComm=<?= $data['id_comment'] ?>&idPost=<?= $data['id_posts'] ?>&from=signal">Supprimer</a>
            <a class="validate" href="index.php?pge=admin&action=validComm&idComm=<?= $data['id_comment'] ?>&idPost=<?= $data['id_posts'] ?>">Valider</a>
            <a class="show_post" href="index.php?pge=article&action=show&idPost=<?= $data['id_posts'] ?>">Voir le post</a>
        </section>
    <?php }
    $viewSign->closeCursor();
    ?>
        <script src="public/js/popupStop.js"></script>
        <script>
            const alertDel = new popupStop(document.getElementsByClassName("del"), "Souhaitez vous vraiment supprimer ce commentaire?", "Le commentaire a été supprimé");
            alertDel.validateAction();
        </script>
    </div>

<?php
$content = ob_get_clean();
require('template.php');
?>
