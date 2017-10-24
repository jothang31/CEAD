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
    showNavMenu($(this));
    $('body').toggleClass('unscroll');
  });

  $('input[request-rout]').on('input', getUsersMatchRequest);

});

// Function for throw the modal and floating main button
function showNavMenu(element) {
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

function getUsersMatchRequest () {

  var rout = $(this).attr('request-rout');
  var string = $.trim($(this).val());
  var target = $(this).attr('data-target');

  // Ocultamos la lista
  $('#' + target).css('display', 'none');

  // Realizamos la petición si almenos hay un caracter
  if (string) {

    $.get(
      rout,
      {'string':string, 'dataTarget':target},
      getUsersMatchResponse
    );

  } else {

    $('#' + target).html('');

  }


}

function getUsersMatchResponse (response) {

  var data = response;
  var target = data.target;
  var matches = data.matches;

  // Ocultamos el contenedor de la lista
  $('#' + target).html('');

  // Iteramos por todos las coincidencias
  for (var i in matches) {

    if (!matches[i].avatar) {

      matches[i].avatar = 'avatar.png';

    }

    var element =  "<li class='item item-avatar' id='" + matches[i].code + "'>" 
                   + "<img src='../assets/custom/images/pictures/users/" + matches[i].avatar + "'class='avatar circle' alt=''>"
                   + "<div class='property'>"
                     + "<span class='name'>" + matches[i].name + "</span>"
                   + "</div>"
                 + "</li>";

    // Agregamos los nuevos elementos
    $('#' + target).append(element);

    // Agregamos el evento click para, posteriormente, solicitar la informacion completa
    // del usuario seleccionado
    $('#' + target).children().each(function () {$(this).on('click', getUserInfoRequest)});

    // Mostramos la lista
    $('#' + target).css('display', 'block');

  }

}

function getUserInfoRequest () {

  // Ocultamos la lista
  $(this).parent().css('display', 'none');

  var rout = $(this).parent().attr('request-rout');
  var code = $(this).attr('id');

  // Realizamos la petición
  $.post(
    rout,
    {'_token':$('meta[name=_token]').attr('content'), 'code':code},
    getUserInfoResponse
  );

}

function getUserInfoResponse (response) {

  var data = response;

  if (!data[0].avatar) {

    data[0].avatar = 'avatar.png';

  }

  $('#name').html(data[0].name);
  $('#avatar').attr('src', '../assets/custom/images/pictures/users/' + data[0].avatar);
  $('#user').html(data[0].userId);
  $('#mail').html(data[0].contactInfos[0].email);
  $('#cellPhone').html(data[0].contactInfos[0].phoneNumbers[0].phoneNumber);
  $('#bornDate').html(data[0].born);
  $('#gender').html(data[0].gender);
  $('#maritalStatus').html(data[0].maritalStatus);

  var contactInfos = data[0].contactInfos;

  for (var i in contactInfos) {

    if (contactInfos[i].type == 1) {

      $('#residentAddress').html(contactInfos[i].address);
      $('#residentZone').html(', ' + contactInfos[i].zone);
      $('#residentMunicipality').html(', ' + contactInfos[i].municipality);
      $('#residentCountryDepartment').html(', ' + contactInfos[i].countryDepartment);
      $('#residentMail').html(contactInfos[i].email);
      $('#residentPhone').html(contactInfos[i].phoneNumbers[1].phoneNumber);

    }

    if (contactInfos[i].type == 2) {

      $('#workAddress').html(contactInfos[i].address);
      $('#workZone').html(', ' + contactInfos[i].zone);
      $('#workMunicipality').html(', ' + contactInfos[i].municipality);
      $('#workCountryDepartment').html(', ' + contactInfos[i].countryDepartment);
      $('#workMail').html(contactInfos[i].email);
      $('#workCellPhone').html(contactInfos[i].phoneNumbers[0].phoneNumber);  
      $('#workPhone').html(contactInfos[i].phoneNumbers[1].phoneNumber);      

    }

    if (contactInfos[i].type == 3) {

      $('#studyAddress').html(contactInfos[i].address);
      $('#studyZone').html(', ' + contactInfos[i].zone);
      $('#studyMunicipality').html(', ' + contactInfos[i].municipality);
      $('#studyCountryDepartment').html(', ' + contactInfos[i].countryDepartment);
      $('#studyMail').html(contactInfos[i].email);

    }

  }
}