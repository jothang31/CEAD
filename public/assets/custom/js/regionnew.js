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

// Inicializacion
$(function() {

  // We give animation to home button and event's driver
  $("#btn-home").on("click", function() {
    $(this).parents(".switch").toggleClass("active"); 
    $(this).parent().removeClass("right");
    showNavMenu($(this));
    $('body').toggleClass('unscroll');
  });

  $('form').on('submit', saveFormData);

  /*
  |-----------------------------------
  | Load Events Section
  |-----------------------------------
  */

  // Add change event to all select input with data-target attribute
  $('select[data-target]').on('change', function(){

    // If element trigger id match with country then load municipalities
    if ($(this).attr('id').match(/\w*Country\w*/g)) {

      $.get(
        '../../municipality/get', 
        {
          'department' : $(this).find(':selected').val(),
          'target' : $(this).attr('data-target')
        },
        function(response) {

          var data = response;

          var target = data.target;
          var municipalities = data.municipalities;

          $('#' + target).html('');

          for(var i in municipalities) {

            $('#' + target).append("<option value='" + municipalities[i].code + "'>" + municipalities[i].name + '</option>');

          }

        }
      );

    // Then needs load zones
    } else {

      $.get(
        '../../zone/get', 
        {
          'department' : $(this).find(':selected').val(),
          'target' : $(this).attr('data-target')
        },
        function(response) {

          var data = response;

          var target = data.target;
          var zones = data.zones;

          $('#' + target).html('');

          for(var i in zones) {

            $('#' + target).append("<option value='" + zones[i].code + "'>" + zones[i].name + '</option>');

          }

        }
      );

    }

  });
  /*
  |-----------------------------------
  | /. Load Events Section
  |-----------------------------------
  */

});

// Function for throw the modal and floating main button
function showNavMenu (element) {
  var switchElement = $(element).parents('.switch');
  
  // If main button is active then show menu's modal else show out
  if ($(switchElement).hasClass('active')) {
    
    $('.overlay').css('display', 'block');
    $('#main-modal').css('display', 'block');
  } else {

    $('.overlay').css('display', 'none');
    $('#main-modal').css('display', 'none');
  }
}

// Función que atiende el envio de formularios 
function saveFormData (event) {

  event.preventDefault();

  var route = $(event.target).attr('action');

  $.get(
    route,
    $(this).serialize(),
    saveFormDataResponse
  );
}

function saveFormDataResponse(response) {

  var data = response;
  var target = data.target;
  var form = data.form;

  // Se guardaron los datos, asi que limpiamos!
  $('#' + form).find('input[type=text]').each(function () {$(this).val('')});

  // Agregamos el nuevo elemento a la lista de departamentos
  $('#' + target).prepend("<option value='" + data.code + "'>" + data.name + "</option>");

  // Seleccionamos la opcion recien ingresada
  $('#' + target).val(data.code);

  if (data.targetCountryDepartment) {

    $('#' + data.targetCountryDepartment).val(data.countryDepartment);

  }
}