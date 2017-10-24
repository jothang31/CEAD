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
    ShowNavMenu($(this));
    $('body').toggleClass('unscroll');
  });

  $('form').on('submit', function (event) {saveFormData(event, this)});

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

          // Generamos el evento change para que cargue las zonas
          $('#' + target).trigger('change');  

        }
      );

    // Then needs load zones
    } else {

      $.get(
        '../../zone/get', 
        {
          'municipality' : $(this).find(':selected').val(),
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

  $('.label-button').find('input').on('change', function () {

    var target = $(this).attr('data-target');

    $('#' + target).toggleClass('undisplay');

  });

  $('#userAvatar').on('click', uploadAvatar);
  $('input[type=file]').on('change', function () {changeAvatar(this, $(this))});

});

// Function for throw the modal and floating main button
function ShowNavMenu(element) {
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
function saveFormData (event, element) {

  event.preventDefault();

  var route = $(event.target).attr('action');

  $.ajax({
    url: route,
    type: 'POST',
    data: new FormData(element),
    processData: false,
    contentType: false,
    success: saveFormDataResponse
  });
}

function saveFormDataResponse(response) {

  var data = response;
  var form = data.form;

  // Se guardaron los datos, asi que limpiamos!
  $('#' + form).find(
      'input[type=text],'
    + 'input[type=password],'
    + 'input[type=date],' 
    + 'input[type=mail],'
    + 'input[type=file]'
  ).each(function () {$(this).val('')});

  // Colocamos la imagen por defecto
  $('#userAvatar').attr('src', '../../assets/custom/images/pictures/users/avatar.png');

}

function uploadAvatar () {

  var target = $(this).attr('data-target');

  $('#' + target).attr('data-target', $(this).attr('id'));

  $('#' + target).trigger('click');

}

function changeAvatar (input, element) {

  var target = $(element).attr('data-target');

  // Comprobamos si se cargo algun archivo
  if (input.files && input.files[0]) {

    // Creamos el objeto FileReader
    var reader = new FileReader();

    // Funcion que atendera la lectura
    reader.onload = function(e) {

      $('#' + target).attr('src', e.target.result);

    }

    // Levantamos la lectura del archivo
    reader.readAsDataURL(input.files[0]);
  }

}