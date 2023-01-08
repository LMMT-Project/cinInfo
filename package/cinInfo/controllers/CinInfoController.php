<?php

namespace CMW\Controller\CinInfo;

use CMW\Controller\Users\UsersController;
use CMW\Router\Link;
use CMW\Router\Route;
use CMW\Router\Router;
use CMW\Utils\Redirect;
use CMW\Utils\View;

class CinInfoController extends \CMW\Controller\Core\CoreController
{

    #[Link(path: "/", method: Link::GET, weight: 5)]
    public function basePage(): void
    {
        Redirect::redirect(UsersController::isUserLogged() ? "/home-page" : "/login");
    }

    #[Link(path: "/infoCine/:cine", method: Link::GET)]
    public function infoCine(string $cine): void
    {
        if(!UsersController::isUserLogged()) {
            UsersController::redirectToHome();
        }

        $view = new View("cinInfo", "infoCine");
        $view->addVariable("cineInfo", $cine)
            ->view();
    }

}