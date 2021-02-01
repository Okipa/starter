// For more information: https://github.com/lukasoppermann/html5sortable

import {each, get} from 'lodash';
import axios from 'axios';
import sortable from 'html5sortable/dist/html5sortable.es';
import Axios from './Axios';
import SweetAlert from './SweetAlert';

Axios.configure(axios);

/**
 * @param {HTMLElement} sortableElement
 * @returns {HTMLElement}
 */
const getDraggableContainer = (sortableElement) => {
    // By default, the `data-sortable` HTML element will be considered as the draggable container.
    // Declaring `data-draggable-container` will override this behaviour by targeting a custom draggable container.
    const draggableContainer = sortableElement.dataset.draggableContainer;
    return draggableContainer
        ? sortableElement.querySelector(draggableContainer)
        : sortableElement;
};

export default class Html5Sortable {

    static init() {
        const sortableElements = document.querySelectorAll('[data-sortable]');
        each(sortableElements, (element) => {
            const draggableContainer = getDraggableContainer(element);
            const draggableItems = element.dataset.draggableItems;
            sortable(draggableContainer, {items: draggableItems})[0].addEventListener('sortupdate', () => {
                const sortableElements = draggableContainer.querySelectorAll(draggableItems);
                let orderedIds = [];
                each(sortableElements, (element) => {
                    orderedIds.push(element.getElementsByClassName('id')[0].textContent);
                });
                axios.post(element.dataset.reorderUrl, {'ordered_ids': orderedIds})
                    .then((response) => {
                        each(sortableElements, (element, key) => {
                            element.getElementsByClassName('position')[0].textContent = key + 1;
                        });
                        SweetAlert.toastSuccess(response.data.message);
                    })
                    .catch((error) => {
                        const errorMessage = get(error, 'response.data.message');
                        errorMessage ? SweetAlert.toastError(errorMessage) : SweetAlert.toastError();
                    });
            });
        });
    }

}
