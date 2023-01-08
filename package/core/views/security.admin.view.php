<?php

use CMW\Manager\Lang\LangManager;
use CMW\Utils\SecurityService;
use CMW\Utils\Utils;

$title = LangManager::translate("core.security.title");
$description = LangManager::translate("core.security.description");
/* @var string $captcha */
?>
<div class="d-flex flex-wrap justify-content-between">
    <h3><i class="fa-solid fa-gears"></i> <span class="m-lg-auto">Sécurité</span></h3>
    <div class="buttons"><button form="captchaConfig" type="submit" class="btn btn-primary">Sauvegarder</button></div>
</div>
<section class="row">
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4><?= LangManager::translate("core.security.captcha.title") ?></h4>
            </div>
            <div class="card-body">
                <form id="captchaConfig" action="security/edit/captcha" method="post">
                    <?php (new SecurityService())->insertHiddenToken() ?>
                    <div class="row">
                        <h6><?= LangManager::translate("core.security.captcha.type") ?> :</h6>
                        <fieldset class="form-group">
                            <select id="captcha" name="captcha" class="form-select" required onclick="generateCaptchaInputs()">
                                <option value="captcha-none" <?= $captcha === "none" ? "selected" : "" ?>>
                                    Pas de catpcha
                                </option>
                                <option value="captcha-hcaptcha" <?= $captcha === "hcaptcha" ? "selected" : "" ?>>
                                    HCaptcha
                                </option>
                                <option value="captcha-recaptcha" <?= $captcha === "recaptcha" ? "selected" : "" ?>>
                                    RECaptcha
                                </option>
                            </select>
                        </fieldset>
                        <div id="security-content-wrapper" class="mt-3"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Double authentification</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <h6>Obligation :</h6>
                        <fieldset class="form-group">
                            <select class="form-select" id="basicSelect">
                                <option>Aucune</option>
                                <option>Pour le staff</option>
                                <option>Pour tout les utilisateurs</option>
                            </select>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>




<script>

    const generateHcaptchaInputs = (parent = null) => {
        if (parent === null) {
            parent = document.getElementById("security-content-wrapper");
        }

        let divWrapper = document.createElement("div");
        divWrapper.setAttribute("class", "row");

        let divPrepend = document.createElement("div");
        divPrepend.setAttribute("class", "col-md-6");

        let divPrepend2 = document.createElement("div");
        divPrepend2.setAttribute("class", "col-md-6");

        let divInfoCaptcha = document.createElement("p");
        divInfoCaptcha.innerHTML += 'Obtenez vos clé ici gratuitement : <a href="https://www.hcaptcha.com/" target="_blank">https://www.hcaptcha.com/</a>';

        let divFormGroupSiteKey = document.createElement("div");
        divFormGroupSiteKey.setAttribute("class", "form-group");

        let divFormGroupSecretKey = document.createElement("div");
        divFormGroupSecretKey.setAttribute("class", "form-group");

        let labelSiteKey = document.createElement("label");
        labelSiteKey.innerHTML += "<h6>Site Key :</h6>";

        let labelSecreteKey = document.createElement("label");
        labelSecreteKey.innerHTML += "<h6>Secret Key :</h6>";

        let inputSiteKey = document.createElement("input");
        inputSiteKey.setAttribute("value", '<?= Utils::getEnv()->getValue("HCAPTCHA_SITE_KEY") ?>');
        inputSiteKey.setAttribute("placeholder", "Site-Key")
        inputSiteKey.setAttribute("type", "text")
        inputSiteKey.setAttribute("name", "captcha_hcaptcha_site_key");
        inputSiteKey.setAttribute("class", "form-control");
        inputSiteKey.setAttribute("required", "true");

        let inputSecretKey = document.createElement("input");
        inputSecretKey.setAttribute("value", '<?= Utils::getEnv()->getValue("HCAPTCHA_SECRET_KEY") ?>');
        inputSecretKey.setAttribute("placeholder", "Secret-Key")
        inputSecretKey.setAttribute("type", "text")
        inputSecretKey.setAttribute("name", "captcha_hcaptcha_secret_key");
        inputSecretKey.setAttribute("class", "form-control");
        inputSecretKey.setAttribute("required", "true");


        parent.append(divWrapper);

        divWrapper.append(divPrepend);
        divPrepend.append(divFormGroupSiteKey);
        divFormGroupSiteKey.append(labelSiteKey);
        divFormGroupSiteKey.append(inputSiteKey);

        divWrapper.append(divPrepend2);
        divPrepend2.append(divFormGroupSecretKey);
        divFormGroupSecretKey.append(labelSecreteKey);
        divFormGroupSecretKey.append(inputSecretKey);

        parent.append(divInfoCaptcha);

    }

    const generateRecaptchaInputs = (parent = null) => {


        if (parent === null) {
            parent = document.getElementById("security-content-wrapper");
        }

        let divWrapper = document.createElement("div");
        divWrapper.setAttribute("class", "row");

        let divPrepend = document.createElement("div");
        divPrepend.setAttribute("class", "col-md-6");

        let divPrepend2 = document.createElement("div");
        divPrepend2.setAttribute("class", "col-md-6");

        let divInfoCaptcha = document.createElement("p");
        divInfoCaptcha.innerHTML += 'Obtenez vos clé ici gratuitement : <a href="https://www.google.com/recaptcha/" target="_blank">https://www.google.com/recaptcha/</a>';

        let divFormGroupSiteKey = document.createElement("div");
        divFormGroupSiteKey.setAttribute("class", "form-group");

        let divFormGroupSecretKey = document.createElement("div");
        divFormGroupSecretKey.setAttribute("class", "form-group");

        let labelSiteKey = document.createElement("label");
        labelSiteKey.innerHTML += "<h6>Site Key :</h6>";

        let labelSecreteKey = document.createElement("label");
        labelSecreteKey.innerHTML += "<h6>Secret Key :</h6>";

        let inputSiteKey = document.createElement("input");
        inputSiteKey.setAttribute("value", '<?= Utils::getEnv()->getValue("RECAPTCHA_SITE_KEY") ?>');
        inputSiteKey.setAttribute("placeholder", "Site-Key")
        inputSiteKey.setAttribute("type", "text")
        inputSiteKey.setAttribute("name", "captcha_recaptcha_site_key");
        inputSiteKey.setAttribute("class", "form-control");
        inputSiteKey.setAttribute("required", "true");

        let inputSecretKey = document.createElement("input");
        inputSecretKey.setAttribute("value", '<?= Utils::getEnv()->getValue("RECAPTCHA_SECRET_KEY") ?>');
        inputSecretKey.setAttribute("placeholder", "Secret-Key")
        inputSecretKey.setAttribute("type", "text")
        inputSecretKey.setAttribute("name", "captcha_recaptcha_secret_key");
        inputSecretKey.setAttribute("class", "form-control");
        inputSecretKey.setAttribute("required", "true");


        parent.append(divWrapper);

        divWrapper.append(divPrepend);
        divPrepend.append(divFormGroupSiteKey);
        divFormGroupSiteKey.append(labelSiteKey);
        divFormGroupSiteKey.append(inputSiteKey);

        divWrapper.append(divPrepend2);
        divPrepend2.append(divFormGroupSecretKey);
        divFormGroupSecretKey.append(labelSecreteKey);
        divFormGroupSecretKey.append(inputSecretKey);

        parent.append(divInfoCaptcha);

    }
</script>