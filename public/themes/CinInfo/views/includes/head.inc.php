<?php

use CMW\Utils\Utils;
use CMW\Utils\View;

/* @var \CMW\Controller\Core\CoreController $core */
/* @var string $title */
/* @var string $description */
/* @var array $includes */

?>
    <!DOCTYPE html>
    <html lang="<?= Utils::getEnv()->getValue('LOCALE') ?>>">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <?= $core->cmwHead($title, $description) ?>

        <!-- LEAFLET -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- MARKERCLUSTER -->
        <link rel="stylesheet" href="<?= getenv("PATH_SUBFOLDER") ?>public/themes/CinInfo/resources/assets/vendors/markercluster/MarkerCluster.css">
        <link rel="stylesheet" href="<?= getenv("PATH_SUBFOLDER") ?>public/themes/CinInfo/resources/assets/vendors/markercluster/MarkerCluster.Default.css">
        <script src="<?= getenv("PATH_SUBFOLDER") ?>public/themes/CinInfo/resources/assets/vendors/markercluster/leaflet.markercluster-src.js"></script>
        <script src="<?= getenv("PATH_SUBFOLDER") ?>public/themes/CinInfo/resources/assets/vendors/markercluster/MarkerCluster.js"></script>


        <!-- Favicon-->
        <link rel="icon" type="image/x-icon"
              href="<?= getenv("PATH_SUBFOLDER") ?>public/themes/CinInfo/assets/favicon.ico"/>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?= getenv("PATH_SUBFOLDER") ?>public/themes/CinInfo/resources/assets/css/main.css"
              rel="stylesheet"/>
        <?php
        View::loadInclude($includes, "beforeScript", "styles");
        ?>
    </head>
    <body id="page-top">