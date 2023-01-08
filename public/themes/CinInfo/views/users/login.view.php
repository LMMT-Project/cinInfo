<?php


use CMW\Controller\Core\SecurityController;
use CMW\Utils\SecurityService;

$title = "Connexion";
$description = "Connexion"; ?>
<section>



    <form action="" method="post" id="login-form">
        <?php (new SecurityService())->insertHiddenToken() ?>
        <div class="container">
            <div class="form">
                <h2>Se connecter</h2>
                <form>
                    <input class="login-input" type="email" name="login_email" placeholder="Email" />
                    <input class="login-input" type="password" name="login_password" placeholder="Password" />

                    <?php SecurityController::getPublicData(); ?>
                    <input type="submit" class="btn-login" value="Se connecter" />
                </form>
            </div>
        </div>
    </form>
</section>