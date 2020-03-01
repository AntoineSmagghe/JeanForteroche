<?php

/**
 * ERROR VIEW TEMPLATE
 *
 * */

$title = "Erreur !";
ob_start();
?>

<h1>Erreur :</h1>
<p><?= $messageError ?></p>

<?php
$content = ob_get_clean();
require('template.php');
?>