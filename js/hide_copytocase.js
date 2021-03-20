CRM.$(function($) {
  $(document).ajaxComplete(function (event, xhr, settings) {
    $("a:contains('Copy To Case')").remove();
  });
});
