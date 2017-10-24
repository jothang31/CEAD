<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  @yield('meta')
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('assets/custom/css/ceadfaststyles.css') }}">
</head>
<body>
  <!--  HEADER  -->
  <header>
    <!--  CEAD OFFICIAL PAGE IMAGE  -->
    <div class="logo">
      <a href="{{ asset('http://cead.org.hn/') }}">
        <img src="{{ asset('assets/custom/images/pictures/default/ceadlogo.png') }}" alt="Cead Main Page">
      </a>
    </div>
    <!--  /CEAD OFFICIAL PAGE IMAGE  -->
    <!--  AVATAR USER PICTURE  -->
    @yield('avatar')
    <!--  /. AVATAR USER PICTURE  -->
    <!--  TOGGLE MAIN BUTTON  -->
    <div class="switch-container">
      <div class="switch round">
        <div class="switch-label">
          <span>@yield('title')</span>
          <span>cerrar</span>
        </div>
        <label class="slider right tooltip-color-001"  data-toggle="tooltip" data-placement="bottom" title="Menu">
          <button id="btn-home"></button>
          <div class="slider-button">
            <div class="home-loader active"></div>
            <div class="slider-icon">
              <div class="first-line"></div>
              <div class="second-line"></div>
              <div class="third-line"></div>
            </div>
          </div>
        </label>
      </div>
    </div>
    <!--  /. TOGGLE MAIN BUTTON  -->
  </header>
  <!--  /. HEADER  -->
  <!--  NAVIGATION  -->
  <nav>
    <div class="modal" id="main-modal">
      <header>
        <!--    ...      -->
      </header>
      <section class="modal-content">
        @yield('main-list')
      </section>
      <footer>
        CEAD | Todos los derechos reservados
      </footer>
    </div>
  </nav>
  <!--  /NAVIGATION  -->
  <!--  MAIN CONTENT  -->
  <main role="main">
    @yield('main-section')
  </main>
  <!--  /MAIN CONTENT  -->
  <!--  ASIDE  -->
  <aside>
  </aside>
  <!--  /ASIDE  -->
  <!--  FOOTER  -->
  <footer>
    <div class="footer container-fluid">
      CEAD
    </div>
  </footer>
  <!--  /FOOTER  -->
  <!--  EXTRA COMPONENTS  -->
  <div class="overlay"></div>
  <!--  /EXTRA COMPONENTS  -->
  <!-- REQUIRED FILES -->
  <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/custom/css/ceadstyles.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/datepicker/css/bootstrap-datepicker.css')}}">
  <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/bootstrap/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/datepicker/js/bootstrap-datepicker.js') }}"></script>
  @yield('custom-js')
  <script src="{{ asset('assets/custom/js/layout.js') }}"></script>
  <!-- /REQUIRED FILES   -->
</body>
</html>