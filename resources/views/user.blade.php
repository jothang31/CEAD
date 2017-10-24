@extends('layout')

@section('meta')
  <meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('title')
  Usuarios
@endsection

@section('main-list')
  <div class="main-list center">
    <a href="/" class="main-list-item actived">INICIO</a>
    <a href="region" class="main-list-item actived">REGIONES</a>
    <a href="institution/structure" class="main-list-item actived">ORGANIZACION</a>
    <a href="../logout" class="main-list-item">SALIR</a>
  </div>
@endsection

@section('main-section')
  <div class="parallax-container parallax-default">
    <div class="full-container container-flex flex-end flex-center">
      <div class="search-container">
        <input type="text" id="patherSearch" data-target="userList" request-rout="../../user/get/match" placeholder="Search...">
        <ul class="list-container absolute" id="userList" request-rout="../../user/get">
          <li class="item item-avatar">
            <img src="{{ asset('assets/custom/images/pictures/default/avatar.png') }}" class="avatar circle" alt="">
            <div class="property">
              <span class="name">Carlos Menjivar</span>
            </div>
          </li>
          <li class="item item-avatar">
            <img src="{{ asset('assets/custom/images/pictures/default/avatar.png') }}" class="avatar circle" alt="">
            <div class="property">
              <span class="name">Angelo Cruz</span>
            </div>
          </li>
          <li class="item item-avatar">
            <img src="{{ asset('assets/custom/images/pictures/default/avatar.png') }}" class="avatar circle" alt="">
            <div class="property">
              <span class="name">Abiezer Caceres</span>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="handling-container">
      <div class="middle-container">
        <div class="container-fluid">
          <header class="container-flex flex-middle">
            <div>
              <div class="avatar-container">
                <img src="{{ asset('assets/custom/images/pictures/default/avatar.png') }}" class="avatar circle" id="avatar" alt="">
              </div>
            </div>
            <ul class="nav margin-left-m">
              <li>
                <h3 id="name"></h3>
              </li>
              <li>
                <label>Usuario:</label>
                <span id="user"></span>
              </li>
              <li>
                <label>Correo:</label>
                <span id="mail"></span>
              </li>
              <li>
                <label>Celular:</label>
                <span id="cellPhone"></span>
              </li>
              <li>
                <label>Nacimiento</label>
                <span id="bornDate"></span>
              </li>
              <li>
                <label>Sexo</label>
                <span id="gender"></span>
                <label>Estado</label>
                <span id="maritalStatus"></span>
              </li>
            </ul>
          </header>
          <section>
            <article id="residentContainer">
              <header class="title-center">
                <h5 class="title">Residencia</h5>
              </header>
              <ul class="nav">
                <li>
                  <label>Dirección:</label>
                  <span id="residentAddress"></span>
                  <span id="residentZone"></span>
                  <span id="residentMunicipality"></span>
                  <span id="residentCountryDepartment"></span>
                </li>
                <li>
                  <label>Correo</label>
                  <span id="residentMail"></span>
                </li>
                <li>
                  <label>Telófono</label>
                  <span id="residentPhone"></span>
                </li>
              </ul>
            </article>
            <article id="workContainer">
              <header class="title-center">
                <h5 class="title">Trabajo</h5>
              </header>
              <ul class="nav">
                <li>
                  <label>Dirección:</label>
                  <span id="workAddress"></span>
                  <span id="workZone"></span>
                  <span id="workMunicipality"></span>
                  <span id="workCountryDepartment"></span>
                </li>
                <li>
                  <label>Correo</label>
                  <span id="workMail"></span>
                </li>
                <li>
                  <label>Celular</label>
                  <span id="workCellPhone"></span>
                </li>
                <li>
                  <label>Telófono</label>
                  <span id="workPhone"></span>
                </li>
              </ul>
            </article>
            <article id="studyContainer">
              <header class="title-center">
                <h5 class="title">Estudio</h5>
              </header>
              <ul class="nav">
                <li>
                  <label>Dirección:</label>
                  <span id="studyAddress"></span>
                  <span id="studyZone"></span>
                  <span id="studyMunicipality"></span>
                  <span id="studyCountryDepartment"></span>
                </li>
                <li>
                  <span id="studyMail"></span>
                </li>
              </ul>
            </article>      
          </section>
          <footer class="countainer-fluid">
            <div class="row form-group">
              <div class="col-xs-12 text-right">
                <a href="user/update" class="btn btn-primary">Editar</a>
              </div>
            </div>
          </footer>
        </div>
      </div>
      <div>
        <a class="add circle tooltip-color-001" href="user/new"  data-toggle="tooltip" data-placement="bottom" title="Nuevo">
          <span class="glyphicon glyphicon-plus"></span>
        </a>
      </div>
  </div>
@endsection

@section('custom-js')
  <script src="{{ asset('assets/custom/js/user.js') }}"></script>
@endsection