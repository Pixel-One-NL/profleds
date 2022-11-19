import Alpine from 'alpinejs';
import '../css/tailwind.css';
import '../scss/menu.scss';

window.Alpine = Alpine;
Alpine.start();

jQuery(document).ready(function ($) {
  // Mobile menu submenu toggle
  $('.open-sub-menu').on('click', function (e) {
    e.preventDefault();

    if (!$(this).hasClass('sub-menu-depth-1')) {
      $(this).toggleClass('open');
      $(this)
        .parent()
        .parent()
        .find('.pone-sub-menu')
        .first()
        .toggleClass('open');
    } else {
      console.log('sub-menu-depth-1');
      $(this).toggleClass('open');
      $(this)
        .parent()
        .parent()
        .find('.pone-sub-menu')
        .last()
        .toggleClass('open');
    }
  });
});
