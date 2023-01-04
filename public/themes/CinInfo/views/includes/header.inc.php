<?php use CMW\Controller\Core\MenusController;
use CMW\Controller\Users\UsersController;
use CMW\Utils\Utils;
?>
<!-- Navigation-->
<header id="header">
    <div class="navbar">
        <a href="/"><h1>CININFO</h1></a>
    </div>

    <div class="profil">
        <?php if (UsersController::isUserLogged()) : ?>
            <a href="/logout">Déconnexion</a>
            <br>
            <small style="margin-left: 10px">Connecté en tant que (<?= UsersController::getSessionUser()?->getUsername() ?>)</small>
        <?php else : ?>
            <a href="/register">Inscription</a>
            <a href="/login">Connexion</a>
        <?php endif; ?>
    </div>
</header>