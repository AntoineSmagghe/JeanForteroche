<?php

/**
 * THE EDIT VIEW FOR THE POST BY ADMIN SIDE
 * 
 *
 */

$title = "Edition d'un chapitre";
ob_start();
?>

<section id="write_post">
    <h1>Ecrire un billet</h1>
    <form id="editForm" method="post" action="index.php?pge=admin&action=edit<?php if (isset($modifyThisTitle)) {
                                                                                    echo '&idPost=' . $idPost;
                                                                                } ?>">
        <input type="text" name="titlePostEdit" value="<?php if (isset($modifyThisTitle)) {
                                                            echo $modifyThisTitle;
                                                        } ?>" required placeholder="Titre">
        <textarea name="textEdit" id="textEdit" rows="30">
            <?php if (isset($modifyThisText)) {
                echo $modifyThisText;
            } ?>
        </textarea>
        <input type="submit" value="Publier">
    </form>
</section>
<script src="public\js\popupStop.js"></script>
<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=gztlpltjww9p3itqri37k5u4l17cm8e1zu3r8l5exsmfscnp"></script>
<script>
    tinymce.init({
        selector: '#textEdit',
        plugins: 'print preview',
        force_br_newlines: true,
        remove_linebreaks: false,
        convert_newlines_to_br: true,
    });

    const validePublish = new popupStop(document.querySelectorAll("input[type='submit']"), "Souhaitez-vous vraiment publier l'article?", "Article publié!");
    validePublish.validateAction();
</script>

<?php
$content = ob_get_clean();
require('template.php');
?>