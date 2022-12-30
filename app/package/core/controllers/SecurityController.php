<?php

namespace CMW\Controller\Core;

use CMW\Controller\Core\CoreController;
use CMW\Controller\Users\UsersController;
use CMW\Manager\Lang\LangManager;
use CMW\Model\Core\CoreModel;
use CMW\Router\Link;
use CMW\Utils\Response;
use CMW\Utils\Utils;
use CMW\Utils\View;

/**
 * Class: @SecurityController
 * @package Core
 * @author CraftMyWebsite Team <contact@craftmywebsite.fr>
 * @version 1.0
 */
class SecurityController extends CoreController
{

    #[Link(path: "/", method: Link::GET, scope: "/cmw-admin")]
    #[Link("/security", Link::GET, [], "/cmw-admin")]
    public function adminSecurity(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "core.security.configuration");

        View::createAdminView("core", "security")
            ->addScriptAfter("app/package/core/views/resources/js/security.js")
            ->addVariableList(["captcha" => self::getCaptchaType()])
            ->view();
    }

    #[Link("/security/edit/captcha", Link::POST, [], "/cmw-admin")]
    public function adminSecurityEditCaptchaPost(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "core.security.configuration");

        $captcha = filter_input(INPUT_POST, "captcha");

        switch ($captcha){
            case "captcha-hcaptcha":
                CoreModel::updateOption("captcha", "hcaptcha");
                Utils::getEnv()->setOrEditValue("HCAPTCHA_SITE_KEY", filter_input(INPUT_POST, "captcha_hcaptcha_site_key"));
                Utils::getEnv()->setOrEditValue("HCAPTCHA_SECRET_KEY", filter_input(INPUT_POST, "captcha_hcaptcha_secret_key"));
                break;
            case "captcha-recaptcha":
                CoreModel::updateOption("captcha", "recaptcha");
                Utils::getEnv()->setOrEditValue("RECAPTCHA_SITE_KEY", filter_input(INPUT_POST, "captcha_recaptcha_site_key"));
                Utils::getEnv()->setOrEditValue("RECAPTCHA_SECRET_KEY", filter_input(INPUT_POST, "captcha_recaptcha_secret_key"));
                break;
            default:
                CoreModel::updateOption("captcha", "none");
                break;
        }

        Response::sendAlert("success", LangManager::translate("core.toaster.success"),
            LangManager::translate("core.toaster.config.success"));

        header("Location: ../../security");
    }

    /**
     * @return string
     * @Desc Get captcha name (none / hcaptcha / recaptcha)
     */
    public static function getCaptchaType(): string
    {
        return CoreModel::getOptionValue("captcha");
    }

    /**
     * @return void
     * @Desc Get the captcha config value. Theme Side.
     */
    public static function getPublicData(): void
    {

        switch (self::getCaptchaType()){
            case "hcaptcha":
                self::getPublicHCaptchaData();
                break;
            case "recaptcha":
                self::getPublicReCaptchaData();
                break;
            default:
                break;
        }

    }

    private static function getPublicHCaptchaData(): void
    {
        echo "<script src='https://js.hcaptcha.com/1/api.js' async defer></script>";
        echo '<div class="h-captcha" data-sitekey="' . Utils::getEnv()->getValue("HCAPTCHA_SITE_KEY") .'" 
                    data-theme="light" data-error-callback="onError"></div>';
    }

    private static function getPublicReCaptchaData(): void
    {
        echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
        echo '<div class="g-recaptcha" data-sitekey="'. Utils::getEnv()->getValue("RECAPTCHA_SITE_KEY") .'"></div>';

    }


    public static function checkCaptcha(): bool
    {
        return match (self::getCaptchaType()) {
            "hcaptcha" => self::validateHCaptha(),
            "recaptcha" => self::validateReCaptha(),
            default => true,
        };
    }

    private static function validateHCaptha(): bool
    {
        $data = array(
            'secret' => Utils::getEnv()->getValue("HCAPTCHA_SECRET_KEY"),
            'response' => $_POST['h-captcha-response']
        );
        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);

        return json_decode($response, false, 512, JSON_THROW_ON_ERROR)->success;
    }

    private static function validateReCaptha(): bool
    {
        $recaptcha = $_POST['g-recaptcha-response'];

        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' .
            Utils::getEnv()->getValue("RECAPTCHA_SECRET_KEY") . '&response=' . $recaptcha;

        $response = file_get_contents($url);

       return json_decode($response, false, 512, JSON_THROW_ON_ERROR)->success;
    }




}
