<?php

/**
 * WELCOME FRONT PAGE
 *
 * */

$title = 'Billets de l\'écrivain Jean Forteroche';
ob_start();
?>
<section id="home_page">
	<div class="title_page img_cover">
		<h1>Billet simple pour l'Alaska</h1>
	</div>
	<h2 class="subtitle">Les derniers chapitres</h2>
	<div id="articles">
			<?php while ($data = $posts->fetch()) { ?>
				<div class="home_page_article">
					<a href="index.php?pge=article&action=show&idPost=<?= $data['id'] ?>" class="width75">
						<article class="post_content post_home_view">
							<h3><strong><?= $data['title'] ?></strong><span class="info_date"> rédigé <?= $data['datePost'] ?></span></h3>
							<?= ($data['text']) ?>
						</article>
					</a>
				</div>
			<?php }
			$posts->closeCursor(); ?>
			</div>
</section>
<!-- SCRIPT FOR INFINITE SCROLL -->
<script src="public/js/infiniteScroll.js"></script>
<script src="public/js/ajax.js"></script>
<script>
	const scrollPost = new infiniteScroll("index.php?pge=home");
	scrollPost.loadElt();
</script>

<?php
$content = ob_get_clean();
require('template.php');
