import $ from 'jquery';
import '../plugins/select2.min';

$(document).ready(function () {
  $('.js-select').select2({
    minimumResultsForSearch: -1,
    dropdownCssClass: 'select__dropdown'
  });
});
