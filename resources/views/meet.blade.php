@extends('layout')

@section('meta')
  <meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('title')
  Reuniones
@endsection

@section('main-list')
  <div class="main-list center">
    <a href="/" class="main-list-item actived">INICIO</a>
    <a href="user" class="main-list-item actived">USUARIOS</a>
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
          <section>     
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