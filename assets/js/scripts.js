import Alpine from 'alpinejs';

import './console-message';

import '../css/tailwind.css';
import '../scss/menu.scss';
import '../scss/debug-menu.scss';
import '../scss/inputs.scss';
import '../scss/woocommerce.scss';
import '../scss/wysiwyg.scss';
import '../scss/page.scss';

window.Alpine = Alpine;
Alpine.start();

jQuery(document).ready(function ($) {
  // Mobile menu submenu toggle
  $('.open-sub-menu').on('click', function (e) {
    e.preventDefault();

    if (!$(this).hasClass('sub-menu-depth-1')) {
      $(this).toggleClass('open');
      $(this).parent().parent().find('.pone-sub-menu').first().toggleClass('open');
    } else {
      $(this).toggleClass('open');
      $(this).parent().parent().find('.pone-sub-menu').last().toggleClass('open');
    }
  });

  function prepareSearchAndFilter() {
    // Search and filter menu toggles
    $('.searchandfilter > ul > li > ul').each(function () {
      let localStorageKey = `_pone_filters_${$(this).data('sf-field-name')}`;
      let status = localStorage.getItem(localStorageKey);
      if (!status) {
        status = 'open';
      }
      localStorage.setItem(localStorageKey, status);

      // Add the status to the li and h4
      $(this).parent().addClass(status);
      $(this).find('h4').addClass(status);
    });

    $('.searchandfilter ul li h4').on('click', function (e) {
      e.preventDefault();

      let localStorageKey = `_pone_filters_${$(this).parent().data('sf-field-name')}`;
      let status = localStorage.getItem(localStorageKey);
      if (status === 'open') {
        status = 'closed';
      } else {
        status = 'open';
      }

      localStorage.setItem(localStorageKey, status);

      if (status === 'open') {
        $(this).parent().addClass('open');
        $(this).addClass('open');

        $(this).parent().removeClass('closed');
        $(this).removeClass('closed');
      } else {
        $(this).parent().removeClass('open');
        $(this).removeClass('open');

        $(this).parent().addClass('closed');
        $(this).addClass('closed');
      }
    });

    // On load add classes to the h4 parents
    $('.searchandfilter ul li h4').each(function () {
      let localStorageKey = `_pone_filters_${$(this).parent().data('sf-field-name')}`;
      let status = localStorage.getItem(localStorageKey);
      if (status === 'open') {
        $(this).parent().addClass('open');
        $(this).addClass('open');
      } else {
        $(this).parent().addClass('closed');
        $(this).addClass('closed');
      }
    });

    // Search and filter show more or less buttons
    // When a ul li has more than 10 li's, add a show more button
    $('.searchandfilter > ul > li > ul').each(function () {
      const itemKey = `_pone_filters_${$(this).parent().data('sf-field-name')}`;
      const localStorageKey = `_pone_filters_showmore_${$(this).parent().data('sf-field-name')}`;

      if ($(this).find('li').length > 6) {
        $(this)
          .find('li')
          .each(function (index) {
            if (index > 6) {
              $(this).addClass('above-max');

              if (localStorage.getItem(localStorageKey) === 'closed') {
                $(this).addClass('hidden');
              }
            }
          });

        if (!$(this).find('li.show-more').length > 0) {
          $(this).find('li').last().after(`<li class="show-more"><button class="button" data-sf-field-name="${itemKey}">Meer tonen</button></li>`);
        }
      }
    });

    // Show more or less
    $('.searchandfilter > ul > li > ul li.show-more button').on('click', function (e) {
      e.preventDefault();

      $(this).text($(this).text() === 'Meer tonen' ? 'Minder tonen' : 'Meer tonen');
      if ($(this).text() === 'Minder tonen') {
        $(this).addClass('open');
      } else {
        $(this).removeClass('open');
      }

      const localStorageKey = `_pone_filters_showmore_${$(this).parent().parent().parent().data('sf-field-name')}`;
      let status = localStorage.getItem(localStorageKey);
      if (status === 'open') {
        status = 'closed';
      } else {
        status = 'open';
      }
      localStorage.setItem(localStorageKey, status);

      $(this)
        .parent()
        .parent()
        .find('li.above-max')
        .each(function () {
          $(this).toggleClass('hidden');
        });
    });

    // Initialize the show more or less buttons local storage
    $('.searchandfilter > ul > li > ul li.show-more button').each(function () {
      const localStorageKey = `_pone_filters_showmore_${$(this).parent().parent().parent().data('sf-field-name')}`;
      let status = localStorage.getItem(localStorageKey);
      if (!status) {
        status = 'open';
      }
      localStorage.setItem(localStorageKey, status);

      if (status === 'open') {
        $(this).text('Minder tonen');
        $(this).addClass('open');
      } else {
        $(this).text('Meer tonen');
        $(this).removeClass('open');
      }
    });
  }

  $(document).on('sf:ajaxstart', '.searchandfilter', function () {
    $('.searchandfilter > ul > li > ul li.show-more button').off('click');
  });

  prepareSearchAndFilter();
  $(document).on('sf:ajaxfinish', '.searchandfilter', function () {
    prepareSearchAndFilter();
  });
});
