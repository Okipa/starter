import 'jquery-ui-sortable';

window.reorganizables = ($reorganizableContainer, sortableItemsSelector, reorganizingRoute) => {
    $reorganizableContainer.sortable({
        cursor: 'move',
        update: () => {
            const reorganizedList = $reorganizableContainer.find(sortableItemsSelector);
            const orderedIds = [];
            _.each(reorganizedList, (item) => {
                orderedIds.push($(item).find('.id').text());
            });
            axios.post(reorganizingRoute, {ordered_ids: orderedIds}).then((response) => {
                _.each(reorganizedList, (item, key) => {
                    $(item).find('.position').text(key + 1);
                });
                notify.toast.fire({
                    type: 'success',
                    title: response.data.message
                });
            }).catch((error) => {
                if (error.response) {
                    notify.toast.fire({
                        type: 'error',
                        title: error.response.data.message
                    });
                }
            });
        }
    });
};

