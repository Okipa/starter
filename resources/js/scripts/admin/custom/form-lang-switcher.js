const switcher = {
    langSwitcherLinks: $('#form-lang-switcher a'),
    localizedComponentContainers: $('.component-container[data-locale]'),
    selectLang: (locale) => {
        console.log(locale);
        const defaultSelectedTab = $('#form-lang-switcher a[data-locale=' + locale + ']');
        switcher.selectTab(defaultSelectedTab);
        switcher.handleLocalizedComponentsDisplay(locale);
    },
    selectTab: ($tab) => {
        switcher.langSwitcherLinks = $('#form-lang-switcher a');
        switcher.langSwitcherLinks.removeClass('active');
        switcher.langSwitcherLinks.attr('aria-selected', false);
        $tab.addClass('active');
        $($tab).attr('aria-selected', true);
    },
    handleLocalizedComponentsDisplay: (locale) => {
        switcher.localizedComponentContainers.hide();
        switcher.localizedComponentContainers.filter('[data-locale=' + locale + ']').show();
    },
    triggerTabClickListening: () => {
        $('#form-lang-switcher a').click((e) => {
            e.preventDefault();
            switcher.selectLang($(e.target).data('locale'));
        });
    },
    initialize: () => {
        $('.card').before(app.multilingual.template.formLangSwitcher);
        switcher.selectLang(app.locale);
        switcher.triggerTabClickListening();
    }
};

if (switcher.localizedComponentContainers.length) {
    switcher.initialize();
}

