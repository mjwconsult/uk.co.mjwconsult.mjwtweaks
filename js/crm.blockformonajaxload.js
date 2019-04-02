

CRM.$(function($) {
  $(document).ajaxStart(function() {
    $('div.crm-form-block').closest('form').block();
  })

  .ajaxStop(function() {
    $('div.crm-form-block').closest('form').unblock();
    });
});