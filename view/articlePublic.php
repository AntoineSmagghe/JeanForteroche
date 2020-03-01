<?php
/**
 * ONE ARTICLE VIEW
 */

ob_start();
$dataPost = $post->fetch();
$idPost = $dataPost['id'];
$text = $dataPost['text'];
$titlePost = $dataPost['title'];
?>

<div id="single_article_content">
<!-- POST PART -->
<article class="post_content width75">
    <h3><strong><?= $titlePost; ?></strong><span class="info_date"> rédigé <?= $dataPost['datePost'] ?></span></h3>
    <?= $text; ?>
    <?php if (isset($_SESSION['id'])) { ?>
        <a class="del" href="index.php?pge=admin&action=delete&idPost=<?= $idPost; ?>">Supprimer</a>
        <a class="modify" href="index.php?pge=admin&action=updatePost&idPost=<?= $idPost; ?>">Modifier</a>
    <?php } ?>
</article>
<?php $post->closeCursor(); ?>

<!-- COMMENT PART -->
<div id="comment_under_post">
    <?php while ($data = $comments->fetch()) { ?>
        <section class="comment">
            <h4><?= $data['name'] ?> <span class="info_date"> a commenté <?= $data['dateComment'] ?></span></h4>
            <p><?= nl2br($data['txt']); ?> </p>
            <?php if (isset($_SESSION['id'])) { ?>
                <a class="del" href="index.php?pge=admin&action=deleteComm&idComm=<?= $data['id_comment'] ?>&idPost=<?= $data['id_posts'] ?>&from=article">Supprimer</a>
            <?php } else { ?>
                <a class="signal" href="index.php?pge=article&action=signal&idComm=<?= $data['id_comment']; ?>&idPost=<?= $data['id_posts'] ?>">Signaler</a>
            <?php } ?>
        </section>
    <?php }
    $comments->closeCursor(); ?>
</div>

<!-- ADD COMMENT -->
<div id="write_comment">
    <h2>Ecrire un commentaire</h2>
    <form id="add_comment" action="index.php?pge=article&action=show&idPost=<?= $_GET['idPost'] ?>" method="POST">
        <input type="text" name="pseudo" <?php if (isset($_SESSION['id'])){ echo "value='" . $_SESSION["name"] . "'";}else { echo "placeholder='Pseudo'"; } ?> required>
        <textarea name="comment" placeholder="Tapez votre commentaire ici." required></textarea>
        <input type="submit">
    </form>
</div>
</div>
<script src="public/js/popupStop.js"></script>
<script>
    window.addEventListener('load', () => {
        <?php if (isset($_SESSION['id'])) { ?>
            const alertDel = new popupStop(document.getElementsByClassName("del"), "Souhaitez vous vraiment supprimer ce commentaire?", "Le commentaire a été supprimé");
            alertDel.validateAction();
        <?php } else { ?>
            const alert = new popupStop(document.getElementsByClassName("signal"), "Souhaitez vous vraiment signaler ce commentaire?", "Le commentaire a été signalé. Merci.");
            alert.validateAction();
        <?php } ?>
    });
</script>
<?php
$content = ob_get_clean();
$repHtml = preg_replace("#<[^>]+>#", '', $text);
$title = preg_match("#^([^ ]+\ ){15}#", $repHtml, $matches);
if (!empty($matches)) {
    $title = $matches[0];
} else {
    $title = $titlePost;
}
require('template.php');
?>