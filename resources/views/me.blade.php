@extends('layout')

@section('title')
  Personal
@endsection

@section('main-list')
  <div class="main-list center">
    <a href="#" class="main-list-item">PERSONAL</a>
    <a href="/" class="main-list-item">INICIO</a>
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
  <script src="{{ asset('assets/custom/js/me.js') }}"></script>
@endsection