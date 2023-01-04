<?php

/* @var $cineInfo string */

$title = "Information Ciné";
$description = "";

?>

<div class="cinema-title">
    <h2 class="cinema-name" id="name">Chargement...</h2>
    <h2 class="cinema-adress" id="address">Chargement...</h2>
</div>


<div class="cinema-information-container">
    <h3>Informations</h3>
    <div class="cinema-information">
        <span class="cinema-information-title">Propriétaire</span>
        <span class="cinema-information-value" id="proprietaire">Chargement...</span>
    </div>
    <div class="cinema-information">
        <span class="cinema-information-title">Ecrans</span>
        <span class="cinema-information-value" id="screen">Chargement...</span>
    </div>
    <div class="cinema-information">
        <span class="cinema-information-title">Fauteils</span>
        <span class="cinema-information-value" id="seat">Chargement...</span>
    </div>
    <div class="cinema-information">
        <span class="cinema-information-title">Films programmés</span>
        <span class="cinema-information-value" id="movies-prog">Chargement...</span>
    </div>
    <div class="cinema-information">
        <span class="cinema-information-title">Films inédit</span>
        <span class="cinema-information-value" id="movies-new">Chargement...</span>
    </div>
    <div class="cinema-information">
        <span class="cinema-information-title">Multiplexe</span>
        <span class="cinema-information-value" id="is-multiplex">Chargement...</span>
    </div>

</div>

<div class="map-container-cineinfo">
    <h3>Carte</h3>
    <div id="map"></div>
</div>

<script>
    function replaceValue(idValue, value) {
        const documentElement = document.getElementById(idValue);
        if(documentElement) {
            documentElement.innerHTML = value;
        }
    }

    const startLoc = [46.65, 2.68];
    const startZoom = 6;

    const map = L.map('map', {zoomControl: false});
    map.setView(startLoc, startZoom);
    map.scrollWheelZoom.disable();
    map.doubleClickZoom.disable();
    map.dragging.disable();
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    const link = `https://data.culture.gouv.fr/api/records/1.0/search/?dataset=etablissements-cinematographiques&q=recordid%3D<?= $cineInfo ?>&rows=10&facet=region_administrative&facet=genre&facet=multiplexe&facet=zone_de_la_commune`

    fetch(link).then(data => data.json()).then(json => {
        console.log(json)
        if(json?.records[0]?.fields) {
            const cine = json.records[0];
            L.marker(cine.fields.geolocalisation).addTo(map);

            const {nom, adresse, commune, proprietaire, ecrans, fauteuils, nombre_de_films_programmes, nombre_de_films_inedits, multiplexe} = cine.fields;

            replaceValue("name", nom)
            replaceValue("address", `${adresse}, <br>${commune}`)
            replaceValue("proprietaire", proprietaire)
            replaceValue("screen", ecrans)
            replaceValue("seat", fauteuils)
            replaceValue("movies-prog", nombre_de_films_programmes)
            replaceValue("movies-new", nombre_de_films_inedits)
            replaceValue("is-multiplex", multiplexe)
            return;
        }

        replaceValue("name", "Cinéma inexistant")
        replaceValue("address", ``)
        replaceValue("proprietaire", "NaN")
        replaceValue("screen", "NaN")
        replaceValue("seat", "NaN")
        replaceValue("movies-prog", "NaN")
        replaceValue("movies-new", "NaN")
        replaceValue("is-multiplex", "NaN")
    })
</script>