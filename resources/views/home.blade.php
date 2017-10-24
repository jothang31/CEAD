@extends('layout')

@section('title')
  Inicio
@endsection

@section('avatar')
  <label class="avatar-nav">
    <a id="achr-avatar" class="tooltip-color-001" href="{{ asset('me') }}" data-toggle="tooltip" data-placement="bottom" title="{{ $userId }}">
      <div class="avatar circle">
        @if($userAvatar)
          <img src="assets/custom/images/pictures/users/{{$userAvatar}}" alt="User Picture">
        @else
          <img src="assets/custom/images/pictures/users/default.png" alt="User Picture">
        @endif
      </div>
    </a>
  </label>
@endsection

@section('main-list')
  <div class="main-list center">
    <a href="/" class="main-list-item actived">INICIO</a>
    @if($userProfile == 1)
      <a href="admin/user" class="main-list-item actived">USUARIOS</a>
      <a href="admin/region" class="main-list-item actived">REGIONES</a>
      <a href="admin/institution/structure" class="main-list-item actived">ORGANIZACION</a>
    @endif
    <a href="logout" class="main-list-item">SALIR</a>
  </div>
@endsection

@section('main-section')
    <div class="parallax-container parallax-principal">
      <div class="parallax-message">
        <span>Donde tu vida cambia!</span>
      </div>
    </div>
@endsection

@section('custom-js')
  <script src="{{ asset('assets/custom/js/home.js') }}"></script>
@endsection