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

  // Evento para quitar selección
  $('#userLocalList').children('li').on('click', function () {

  	$(this).children('.check').toggleClass('checked');

  });

 // Evento que recupera el subgrupo de un grupo
 $('#selectGroup').on('change', getSubgroupsRequest);

 // Evento que guarda la estrucutura selecionada
 $('#buttonSave').on('click', saveStructureRequest);

 // Evento para buscar los usuarios en la lista local
 // $('#patherLocalSearch').on('input', getUserMatchLocal);

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
  var pattern = $.trim($(this).val());
  var target = $(this).attr('data-target');

  // Ocultamos la lista
  $('#' + target).css('display', 'none');

  // Realizamos la petición si almenos hay un caracter
  if (pattern) {

    $.get(
      rout,
      {'string':pattern, 'dataTarget':target},
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

    // Si no se proporciona el nombre de la imagen del usuario
    if (!matches[i].avatar) {

      matches[i].avatar = 'avatar.png';

    }

    var element =  "<li class='item item-avatar' id='" + matches[i].code + "'>" 
                   + "<img src='../../assets/custom/images/pictures/users/" + matches[i].avatar + "'class='avatar circle' alt=''>"
                   + "<div class='property'>"
                     + "<span class='name'>" + matches[i].name + "</span>"
                   + "</div>"
                 + "</li>";

    // Agregamos los nuevos elementos
    $('#' + target).append(element);
    
  }

    // Agregamos el evento click para, posteriormente, solicitar la informacion completa
    // del usuario seleccionado
    $('#' + target).children().each(function () {$(this).on('click', getUserStructureRequest)});

    // Mostramos la lista
    $('#' + target).css('display', 'block');

}

function getUserStructureRequest () {

  var code = $(this).attr('id');

  // Ocultamos la lista
  $(this).parent().css('display', 'none');

  // Agregamos la descripción
  var target = $(this).parent().attr('data-target');

  $('#' + target).find('img').attr('src', $(this).find('img').attr('src'));
  $('#' + target).find('.name').html($(this).find('.name').html());
  $('#' + target).attr('code', $(this).attr('id'));

  // Ocultamos el miembro actual al tiempo que mostramos el oculto
  $('#userLocalList').children('.undisplay').removeClass('undisplay');
  $('#userLocalList').children('#' + code).addClass('undisplay');

  // Quitamos selección de miembros anteriores
  $('#userLocalList').find('.checked').removeClass('checked');


  var rout = $(this).parent().attr('request-rout');

  // Realizamos la petición
  $.post(
    rout,
    {'_token':$('meta[name=_token]').attr('content'), 'code':code},
    getUserStructureResponse
  );

}

function getUserStructureResponse (response) {

  var data = response;

  var group = data.group;
  var users = data.users;

  if (group[0]) {

  	if (!group[0].parentCode) {

  		$('#selectGroup').val(group[0].code);
  		$('#selectSubgroup').val(0);
  		$('#selectSubgroup').attr('preselect', null);

  	} else {

    	$('#selectGroup').val(group[0].parentCode);
   		$('#selectSubgroup').attr('preselect', group[0].code);

  	}

    $('#selectGroup').trigger('change');

  } else {

		$('#selectGroup').val(0);
		$('#selectSubgroup').val(0);
		$('#selectSubgroup').attr('preselect', null);

  }

  for (var i in users) {

  	var code = users[i].code;

  	$('#userLocalList').children('#' + code).children('.check').addClass('checked');

  }

}

function getSubgroupsRequest () {

	var group = $(this).val();
	var target = $(this).attr('data-target');
	var rout = $(this).attr('request-rout');

	$.get(
		rout,
		{'group':group, 'target':target},
		getSubgroupsResponse
	);

}

function getSubgroupsResponse (response) {

	var data = response;

	var target = data.target;
	var subgroups = data.subgroups;

	// Eliminamos todas las opciones
	$('#' + target).html('');

	// Agrgamos la opcion en blanco
	$('#' + target).append("<option val='0'></option>");

	for (var i in subgroups) {

		var element = "<option value='" + subgroups[i].code + "'>" + subgroups[i].subcode + "</option>";

		// Agregamos el elemento
		$('#' + target).append(element);

	}

	// Seleccionamos el subgrupo si el usuario pertenece a uno
	if ($('#' + target).attr('preselect')) {

		$('#' + target).val($('#' + target).attr('preselect'));

		$('#' + target).attr('preselect', null);

	}

}

function saveStructureRequest () {

	var user = $('#user').attr('code');
	var group = $('#selectGroup').val();
	var subgroup = $('#selectSubgroup').val();
	var rout = $('#user').attr('request-rout');
	var token = $('meta[name=_token]').attr('content');

	var users = [];

	$('#userLocalList').children('li').children('.checked').each(function() {

		var code = $(this).parent().attr('id');

		users.push({'code':code});

	});

  // Convertimos el arreglo a json
	users = JSON.stringify(users);

	$.post(
		rout,
		{
			'_token':token,
      'user':user,
			'group':group,
			'subgroup':subgroup,
			'users':users
		},
		saveStructureResponse
	);

}

function saveStructureResponse (response) {

	var data = response;

  // Agregamos la imagen avatar por defecto
  $('#avatar').attr('src', '../../assets/custom/images/pictures/users/avatar.png');

  // Cambiamos el nombre y el código
  $('#name').html('Nombre');
  $('#user').attr('code', '');

  // Seleccionamos el primer grupo
  $('#selectGroup').val(0);
  $('#selectGroup').trigger('change');

  // Mostramos el elemento oculto
  $('#userLocalList').children('.undisplay').removeClass('undisplay');

  // Eliminamos la selección
  $('.item-avatar').children('.checked').removeClass('checked');

}

function getUserMatchLocal() {

  var pattern = $(this).val().toLowerCase();
  var target = $(this).attr('data-target');
  var matches = [];

  $('#' + target).children('.item').each(function() {

    var name = $(this).find('.name').html().toLowerCase();

    // Verificamos el patron de nombre coninside alguno de los 
    // nombres del usuario
    if (name.search(pattern) >= 0) {

      // Lo agregamos al arreglo de oinsidencias
      matches.push($(this));

    }

  });

  // Obtenemos el primer elemento de la lista para
  // insertar el elemento que coincide antes de este
  var itemReference = $('#' + target).children('.item').first();

  for (var i in matches) {

      $(matches[i]).insertBefore(itemReference);

  }

}