<?php


use CMW\Controller\Core\SecurityController;
use CMW\Manager\Lang\LangManager;
use CMW\Utils\SecurityService;

$title = "Inscription";
$description = "Description de votre page"; ?>


<section>

    <form action="" method="post" id="login-form">
        <?php (new SecurityService())->insertHiddenToken() ?>
        <div class="container">
            <div class="form">
                <h2>S'inscrire</h2>
                <form>
                    <input name="register_email" type="email" class="login-input"
                           placeholder="<?= LangManager::translate("users.users.mail") ?>">
                    <input name="register_pseudo" type="text" class="login-input"
                           placeholder="<?= LangManager::translate("users.users.pseudo") ?>">
                    <input name="register_password" type="password" class="login-input"
                           placeholder="Entrez votre mot de passe">
                    <input name="register_password_verify" type="password" class="login-input"
                           placeholder="<?= LangManager::translate("users.users.repeat_pass") ?>">

                    <?php SecurityController::getPublicData(); ?>
                    <input type="submit" class="btn-login"
                           value="<?= LangManager::translate("users.login.register") ?>"/>
                </form>
            </div>
        </div>
    </form>

</section>
