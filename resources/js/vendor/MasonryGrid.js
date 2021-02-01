// For more information: https://github.com/desandro/masonry

import Masonry from 'masonry-layout';
import {each} from 'lodash';

export default class MasonryGrid {

    static init() {
        each(document.querySelectorAll('[data-masonry]'), (element) => {
            new Masonry(element, {
                horizontalOrder: true,
                percentPosition: true
            });
        });
    }

}
