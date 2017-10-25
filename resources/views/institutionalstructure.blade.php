@extends('layout')

@section('meta')
  <meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('title')
  Organizacion
@endsection

@section('main-list')
  <div class="main-list center">
    <a href="/" class="main-list-item actived">INICIO</a>
        <a href="../user" class="main-list-item actived">USUARIOS</a>
        <a href="../region" class="main-list-item actived">REGIONES</a>
    <a href="../../logout" class="main-list-item">SALIR</a>
  </div>
@endsection

@section('main-section')
  <div class="parallax-container parallax-default">
    <div class="full-container container-flex flex-end flex-center">
      <div class="search-container">
        <input type="text" id="patherSearch" data-target="userList" request-rout="../../user/get/match" placeholder="Buscar...">
        <ul class="list-container absolute" id="userList" data-target="user" request-rout="structure/get">
        </ul>
      </div>
    </div>
  </div>
  <div class="handling-container">
    <div class="middle-container">
    	<div class="container-fluid" style="height: 600px">
    	  <header class="header-button">
			    <button id="buttonSave">Guardar</button>
        </header>
        <div class="container-inline" id="user" code="" request-rout="structure/save">
        	<div class="avatar-container avatar-small">
         		<img src="{{ asset('assets/custom/images/pictures/default/avatar.png') }}" class="avatar circle" id="avatar" alt="">
        	</div>
          <ul class="nav margin-left-m">
            <li>
              <h3 class="name" id="name">Nombre</h3>
            </li>
          </ul>
          <div class="button-group">
            <div style="position: relative;">
              <select cass="tooltip-color-001" id="selectGroup" data-target='selectSubgroup' request-rout="structure/subgroup" data-toggle="tooltip" data-placement="top" title="Red">
                <option value="0"></option>
                @foreach($groups as $group)

                  <option value="{{ $group->code }}">{{ $group->subcode }}</option>

                @endforeach
              </select>                
            </div>
          	<select cass="tooltip-color-001" id="selectSubgroup" data-toggle="tooltip" data-placement="top" title="Subred">
          		<option value=""></option>
          	</select>
          </div>
        </div>
      	<ul class="list-container" id="userLocalList">
          
        </ul>
    	</div>
    </div>
  </div>
@endsection

@section('custom-js')
  <script src="{{ asset('assets/custom/js/institutionalstructure.js') }}"></script>
@endsection