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
});
