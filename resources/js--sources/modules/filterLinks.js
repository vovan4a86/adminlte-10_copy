import $ from 'jquery';

export const filterAsideNav = () => {
  const $link = $('[data-link]');
  const cleanPath = window.location.origin + window.location.pathname;

  $link.filter('[href="' + cleanPath + '"]').addClass('is-active');
};

filterAsideNav();
