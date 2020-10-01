$(document).on('click', (e) => {
    // a sub-menu opening close the others
    if ($(e.target).is('.nav-link[data-toggle="collapse"]')
        || $(e.target).parents('.nav-link[data-toggle="collapse"]').length === 1) {
        $('.nav-link[data-toggle="collapse"]')
            .next('.collapse.show')
            .collapse('hide');
    }
    // hide the collapsible menu when clicking on an external element
    if ($(e.target).parents('#navbar').length !== 1) {
        $('.navbar-collapse.collapse').collapse('hide');
    }
});
