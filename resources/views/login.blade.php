<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>Login</title>
</head>
<body class="colorfull">
  <!--  HEADER  -->
  <header>
  </header>
  <!--  /. HEADER  -->
  <!--  MAIN CONTENT  -->
  <main>
    <div class="login-container">
      <div class="login">
        <header class="cead-logo">
          <img src="{{ asset('assets/custom/images/pictures/default/ceadlogo.png') }}" alt="Cead Main Page">
        </header>
        <form method="post" action="login" id="formUser">
          {{ csrf_field() }}
          <input type="text" name="name" value="{{ $userId }}" placeholder="Nombre">
          <input type="password" name="password" value="" placeholder="Contraseña">
          <button class="btn btn-primary fulled" id="buttonSingin">Ingresar</button>
          @if($message)
            <div style="color: #ee6e73; width: 100%; text-align: center;">
              {{ $message }}
            </div>
          @endif
        </form>
      </div>
    </div>
  </main>
  <!--  /MAIN CONTENT  -->
  <!--  FOOTER  -->
  <footer>
  </footer>
  <!--  /FOOTER  -->
  <!--  EXTRA COMPONENTS  -->
  <div class="overlay"></div>
  <!--  /EXTRA COMPONENTS  -->
  <!-- REQUIRED FILES -->
  <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/custom/css/ceadstyles.css') }}">
  <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/bootstrap/js/bootstrap.js') }}"></script>
  <script src ="{{ asset('assets/custom/js/login.js')}} "></script>
  <!-- /REQUIRED FILES   -->
</body>
</html>