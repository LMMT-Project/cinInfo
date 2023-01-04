// ========== VAR ========== //
let allMarkers = [];
let markers = L.markerClusterGroup();
let allCinemas = [];

let resultList = document.getElementById("result-list");

let cineIconOpen = L.icon({
    iconUrl: "public/themes/CinInfo/resources/assets/icons/cine-icon-open.png",
    iconSize: [50, 50],
    iconAnchor: [25, 25],
    popupAnchor: [0, -25]
});
let cineIconClose = L.icon({
    iconUrl: "public/themes/CinInfo/resources/assets/icons/cine-icon-close.png",
    iconSize: [50, 50],
    iconAnchor: [25, 25],
    popupAnchor: [0, -25]
});
let userIcon = L.icon({
    iconUrl: "public/themes/CinInfo/resources/assets/icons/user-icon.png",
    iconSize: [80, 80],
    iconAnchor: [40, 40],
    popupAnchor: [0, -40]
});

let userPosition;

function successGetUserPosition(position) {
    userPosition = [position.coords.latitude, position.coords.longitude];
    let marker = L.marker(userPosition, {icon: userIcon})
        .bindPopup(`<p style="font-weight: bold;">VOUS ÊTES ICI !</p>`);
    marker.addEventListener("click", () => {
        map.setView(userPosition, 18);
    });
    marker.addEventListener("mouseover", () => {
        marker.openPopup();
    });
    marker.addEventListener("mouseout", () => {
        marker.closePopup();
    });
    marker.addTo(map);

    document.getElementById("goOnMeMapBtn").addEventListener("click", () => {
        map.setView(userPosition, 18);
    });
    document.getElementById("goOnMeMapBtn").addEventListener("mouseover", () => {
        marker.openPopup();
    });
    document.getElementById("goOnMeMapBtn").addEventListener("mouseout", () => {
        marker.closePopup();
    });
}

function errorGetUserPosition(error) {
    console.log(error);
}

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successGetUserPosition, errorGetUserPosition);
}


// ========== MAP SETUP ========== //
const startLoc = [46.65, 2.68];
const startZoom = 6;

const map = L.map('map', {
    minZoom: 6,
    maxZoom: 19,
});
map.setView(startLoc, startZoom);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

document.getElementById("centerMapBtn").addEventListener("click", () => {
    map.setView(startLoc, startZoom);
});


// ========== JSON ========== //

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
}

function createCineCard(cinema) {
    let cineCardHTML = `
        <div class="cine-card" id="${capitalizeFirstLetter(cinema.recordid)}">
                <h4 class="cine-card-info-value" style="text-align: center">${capitalizeFirstLetter(cinema.fields.nom)}</h4>
                <p class="cine-card-info-value"><i class="fa-solid fa-location-pin" style="color: rgba(0, 0, 0, .25)"></i> ${capitalizeFirstLetter(cinema.fields.adresse)}</p>
                <p class="cine-card-info-value"><i class="fa-solid fa-flag" style="color: rgba(0, 0, 0, .25)"></i> ${cinema.fields.commune}</p>
            <a href="/infoCine/${cinema.recordid}" style="color: blue; text-decoration: underline;"><i class="fa-solid fa-circle-info" style="color: rgba(0, 0, 255, .25)"></i> Plus d'informations</a>
        </div>
    `;

    return cineCardHTML;
}

function updateResultList() {
    resultList.innerHTML = "";

    getCinemaVisible().forEach((cinema) => {
        resultList.innerHTML += createCineCard(cinema);
    });

    getCinemaVisible().forEach((cinema) => {
        let lat = cinema.fields.geolocalisation[0];
        let lng = cinema.fields.geolocalisation[1];

        let cineCard = document.getElementById(`${cinema.recordid}`);
        let marker = getMarkerByLatLng(lat, lng);

        if (cineCard) {
            cineCard.addEventListener("click", (event) => {
                map.setView(cinema.fields.geolocalisation, 16);
            });
            cineCard.addEventListener("mouseover", (event) => {
                marker.setIcon(cineIconClose);
                marker.openPopup();
            });
            cineCard.addEventListener("mouseout", (event) => {
                marker.setIcon(cineIconOpen);
                marker.closePopup();
            });
        }
    });
}

function getMarkerByLatLng(lat, lng) {
    return allMarkers.find((marker) => {
        return marker._latlng.lat === lat && marker._latlng.lng === lng;
    });
}

function getMarkerVisible() {
    var features = [];
    map.eachLayer((layer) => {
        if (layer instanceof L.Marker) {
            console.log(layer);
            if (map.getBounds().contains(layer.getLatLng())) {
                features.push(layer);
            }
        }
    });
    return features;
}

function getCinemaByLatLng(lat, lng) {
    return allCinemas.find((cinema) => {
        return cinema.fields.geolocalisation[0] === lat && cinema.fields.geolocalisation[1] === lng;
    });
}

function getCinemaVisible() {
    var features = [];
    map.eachLayer((layer) => {
        if (layer instanceof L.Marker) {
            if (map.getBounds().contains(layer.getLatLng())) {
                let cinema = getCinemaByLatLng(layer._latlng.lat, layer._latlng.lng);
                if (typeof cinema !== 'undefined') {
                    features.push(cinema);
                }
            }
        }
    });
    return features;
}

async function loadMap() {
    const url = "https://data.culture.gouv.fr/api/records/1.0/search/?dataset=etablissements-cinematographiques&q=&rows=-1";
    const res = await fetch(url);
    const data = await res.json();

    data.records.forEach(cinema => {
        allCinemas.push(cinema);
        let marker = L.marker(cinema.fields.geolocalisation, {icon: cineIconOpen})
            .bindPopup(`
                            <p style="margin: 0;"><span style="font-weight: bold;">Nom :</span> ${cinema.fields.nom}</p>
                            <p style="margin: 0;"><span style="font-weight: bold;">Adresse :</span> ${cinema.fields.adresse}</p>
                            <p style="margin: 0;"><span style="font-weight: bold;">Commune :</span> ${cinema.fields.commune}</p>
                            <p style="margin: 0;"><span style="font-weight: bold;">Code postal :</span> ${cinema.fields.code_insee}</p>
                            <a href="/infoCine/${cinema.recordid}" style="color: blue; text-decoration: underline;">Plus d'information</a>
                            `);
        marker.addEventListener("click", () => {
            map.setView(cinema.fields.geolocalisation, 18);
        });
        marker.addEventListener("mouseover", (event) => {
            marker.setIcon(cineIconClose);
        });
        marker.addEventListener("mouseout", (event) => {
            marker.setIcon(cineIconOpen);
        });
        allMarkers.push(marker);
        markers.addLayer(marker);
    });

    map.addLayer(markers);
}

map.addEventListener("moveend", updateResultList);
loadMap();

// ==========  ========== //
