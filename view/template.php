<!DOCTYPE html>
<!-- HTML GLOBAL TEMPLATE DOCUMENT -->
<html lang="fr">

<head>
    <title><?= $title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (isset($headNode)) {
        foreach ($headNode as $heading) {
            echo $heading;
        }
    } ?>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/width900.css">
    <link rel="stylesheet" href="public/css/width540.css">
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
</head>

<body>
    <header>
        <div id="header_menu">
            <h2><a href="index.php?pge=home">Jean Forteroche</a></h2>
            <?php if (isset($_SESSION['id'])) { ?>
                <p>Bonjour <?= $_SESSION['name'] ?>.</p>
            <?php } ?>
            <img src="public/ico/menu.svg" alt="Menu retractable" id="menu_minwidth">
            <ul id="menu_maxwidth">
                <?php if (isset($_SESSION['id'])) { ?>
                    <li><a class="menu_list" href="index.php?pge=admin">Admin</a></li>
                    <li><a class="menu_list" href="index.php?pge=admin&action=createArticle">Publier</a></li>
                    <li><a class="menu_list" href="index.php?pge=admin&action=viewSignalement">
                            <?php if ($_SESSION['countSign'] >= 0) {
                                echo $_SESSION['countSign'];
                            } ?> Signalement<?php if ($_SESSION['countSign'] > 1) {echo "s";} ?>
                        </a></li>
                    <li><a class="menu_list" href="index.php?pge=admin&action=logout">Logout</a></li>
                <?php } else { ?>
                    <li><a class="menu_list" href="index.php?pge=home">Home</a></li>
                    <li><a class="menu_list" href="index.php?pge=admin">Login</a></li>
                <?php } ?>
                <li><a class="menu_list" href="index.php?pge=about">About</a></li>
            </ul>
        </div>
    </header>
    <div id="content">
        <?= $content ?>
    </div>
    <footer>
        <div id="footer_menu">
            <div class="div_footer">
                <p>Contact : <a href="mailto:jean@forteroche.com">mail</a></p>
            </div>
            <div class="div_footer">
                <p>
                    Adresse :<br>
                    28 Boulevard de la fontaine
                    75017 Paris
                </p>
            </div>
            <div class="div_footer">
                <p><a href="index.php?pge=about">Mentions légales</a></p>
            </div>
            <div class="div_footer">
                <p>Website made by <a href="mailto:antoine@smagghe.me">_4N701N3_</a></p>
            </div>
        </div>
    </footer>
<script src="public/js/menuHidden.js"></script>
<script>
    const showMenu = new menuHidden(document.getElementById("menu_minwidth"), document.getElementById("menu_maxwidth"), "flex");
    showMenu.listenIco();
</script>
</body>
</html>