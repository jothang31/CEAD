/*
|======================================
| CEAD PROJECT
| CURRENT VERSION: 1.1
|
|
| LAST MODIFIED: 14/05/07
| DEVELOPER: ANGELO CRUZ 
|======================================
*/


// Initialization
$(function() {
  // Set stop pre-loader element
  $(".home-loader").removeClass("active");
  // We give animation to home button and event's driver
  // $("#btn-home").on("click", function() {
  //   $(this).parents(".switch").toggleClass("active"); 
  //   $(this).parent().removeClass("right");
  //   ShowNavMenu($(this))
  // });
  // Set out bootstrap's tooltip
  $('[data-toggle="tooltip"]').tooltip();
  $('input[type=date]').datepicker({format:'dd/mm/yyyy'});
});