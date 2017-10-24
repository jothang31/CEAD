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
  // We give animation to home button and event's driver
  $("#btn-home").on("click", function() {
    $(this).parents(".switch").toggleClass("active"); 
    $(this).parent().removeClass("right");
    ShowNavMenu($(this));
    $('body').toggleClass('unscroll');
  });
});

// Function for throw the modal and floating main button
function ShowNavMenu(element) {
  var switchElement = $(element).parents(".switch");
  
  // If main button is active then show menu's modal else show out
  if ($(switchElement).hasClass("active")) {
    
    $(".overlay").css("display", "block");
    $("#main-modal").css("display", "block");
  } else {

    $(".overlay").css("display", "none");
    $("#main-modal").css("display", "none");
  }
}