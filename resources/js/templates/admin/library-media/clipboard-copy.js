import {each, get} from 'lodash';
import axios from 'axios';
import Axios from '../../../vendor/Axios';
import SweetAlert from '../../../vendor/SweetAlert';

Axios.configure(axios);

const copyToClipboard = (string) => {
    const el = document.createElement('textarea');
    el.value = string;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
};

each(document.querySelectorAll('.clipboard-copy'), (element) => {
    element.addEventListener('click', (e) => {
        e.preventDefault();
        const libraryMediaId = element.dataset.libraryMediaId;
        const type = element.dataset.type;
        // Remove the line below if your app is not multilingual.
        const locale = element.closest('.component-container').querySelector('.component').dataset.locale;
        let route = app.libraryMedia.clipboardCopy.route;
        route = route.replace('__ID__', libraryMediaId);
        route = route.replace('__TYPE__', type);
        // Remove the line below if your app is not multilingual.
        route = route.replace('__LOCALE__', locale || '');
        axios.get(route)
            .then((response) => {
                copyToClipboard(response.data.clipboardContent);
                SweetAlert.toastSuccess(response.data.message);
            })
            .catch((error) => {
                const errorMessage = get(error, 'response.data.message');
                errorMessage ? SweetAlert.toastError(errorMessage) : SweetAlert.toastError();
            });
    });
});
