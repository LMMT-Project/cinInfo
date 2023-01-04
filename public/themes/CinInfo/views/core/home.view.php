<?php use CMW\Controller\Users\UsersController;
use CMW\Manager\Lang\LangManager;
use CMW\Model\Core\CoreModel;
use CMW\Model\Users\UsersModel;

$title = "Accueil";
$description = "page d'accueil de CraftMyWebsite"; ?>


<!-- Masthead-->
<div class="map-container">
    <div class="basemap" id="map"></div>
    <div class="control-map-buttons">
        <button class="btn btn-primary w-100" id="centerMapBtn">Centrer</button>
        <button class="btn btn-primary w-100" id="goOnMeMapBtn">Moi</button>
    </div>
</div>

<div id="result-list">
</div>


<script src="<?= getenv("PATH_SUBFOLDER") ?>public/themes/CinInfo/resources/assets/js/main.js"></script>