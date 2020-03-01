<?php

/** 
 *	WELCOME ADMIN PAGE
 *
 */

ob_start();
$title = "Page d'accueil administrateur du site web de Jean Forteroche.";
?>

<section id="adminIndex">
	<div class="title_page title_page_admin">
		<h2><span class="overline">Bonjour <?php if (isset($_SESSION['name'])) {echo $_SESSION['name'];} ?>,</span></h2>
		<p><span class="overline">Bienvenue sur la page administrateur.</span></p>
	</div>
	<div id="figure_ico_admin">
		<figure>
			<a href="index.php?pge=admin&action=edit">
				<img src="public\ico\edit-regular.svg" alt="Ecrire un nouveau billet" class="ico_admin_index">
				<figcaption>
					Publier
				</figcaption>
		</figure>
		<figure>
			<a href="index.php?pge=admin&action=viewSignalement">
				<img src="public\ico\bullhorn-solid.svg" alt="Signalements de commentaires" class="ico_admin_index">
				<figcaption>
					<?= $countSign ?> Signalement<?php if ($countSign > 1) {
														echo "s";
													} ?>
				</figcaption>
			</a>
		</figure>
		<figure>
			<a href="index.php?pge=home">
				<img src="public\ico\check-square-regular.svg" alt=" Modifier un billet" class="ico_admin_index">
				<figcaption>
					Modifications
				</figcaption>
			</a>
		</figure>
		<figure>
			<a href="index.php?pge=home">
				<img src="public\ico\trash-alt-regular.svg" alt="Supprimer un billet" class="ico_admin_index">
				<figcaption>
					Suppressions
				</figcaption>
			</a>
		</figure>
	</div>
</section>

<?php
$content = ob_get_clean();
require('template.php');
?>