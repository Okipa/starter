import axios from 'axios';
import {get} from 'lodash';
import L from 'leaflet';
import GLightbox from 'glightbox';
import Axios from '../../../../vendor/Axios';

Axios.configure(axios);

const displayMap = (lat, lon) => {
    const map = L.map('contact-map').setView([lat, lon], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    const icon = L.icon({
        iconUrl: app.map_marker,
        iconSize: [30, 30], // Size of the icon.
        iconAnchor: [15, 15], // Point of the icon which will correspond to marker's location.
        popupAnchor: [0, 0] // Point from which the popup should open relative to the iconAnchor.
    });
    L.marker([lat, lon], {icon}).addTo(map)
        .bindPopup('<b>' + app.app_name + '</b><br>' + app.postal_address)
        .openPopup();
};

document.querySelector('#display-map-link').addEventListener('click', (e) => {
    e.preventDefault();
    const lightbox = GLightbox({
        elements: [{content: ' <div id="contact-map" class="h-100 bg-light"></div>'}]
    });
    axios.get('https://nominatim.openstreetmap.org/search?format=json&limit=3&q=' + app.postal_address)
        .then((response) => {
            if (get(response.data, 0)) {
                lightbox.open();
                displayMap(response.data[0].lat, response.data[0].lon);
                return;
            }
            window.dispatchEvent(new CustomEvent('toast:info', {detail: {title: app.postal_address_not_found}}));
        });
});
