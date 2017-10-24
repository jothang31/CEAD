@extends('layout')

@section('title')
  Regiones
@endsection

@section('main-list')
  <div class="main-list center">
    <a href="/" class="main-list-item actived">INICIO</a>
    <a href="user" class="main-list-item actived">USUARIOS</a>
    <a href="institution/structure" class="main-list-item actived">ORGANIZACION</a>
    <a href="../logout" class="main-list-item">SALIR</a>
  </div>
@endsection

@section('main-section')
  <div class="parallax-container parallax-default">
    <div class="full-container container-flex flex-end flex-center">
      <div class="search-container">
        <input type="text" name="patherSearch" placeholder="Search...">
        <ul class="list-container absolute">
          <li class="item item-avatar">
            <img src="{{ asset('assets/custom/images/pictures/default/location.png') }}" class="avatar circle" alt="">
            <div class="property">
              <span class="name">Francisco Morazán</span>
            </div>
          </li>
          <li class="item item-avatar">
            <img src="{{ asset('assets/custom/images/pictures/default/location.png') }}" class="avatar circle" alt="">
            <div class="property">
              <span class="name">Olancho</span>
            </div>
          </li>
          <li class="item item-avatar">
            <img src="{{ asset('assets/custom/images/pictures/default/location.png') }}" class="avatar circle" alt="">
            <div class="property">
              <span class="name">Cortes</span>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="handling-container" style="height: 400px">
    <a class="add circle tooltip-color-001" href="region/new" data-toggle="tooltip" data-placement="bottom" title="Nuevo">
      <span class="glyphicon glyphicon-plus"></span>
    </a>
  </div>
@endsection

@section('custom-js')
  <script src="{{ asset('assets/custom/js/region.js') }}"></script>
@endsection