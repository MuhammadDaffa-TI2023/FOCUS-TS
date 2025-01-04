<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  @role('mahasiswa')
  <title>DASHBOARD | MAHASISWA</title>
  @endrole
  @role('dosen')
  <title>DASHBOARD | DOSEN</title>
  @endrole
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{asset('assets2/img/logofocus.png')}}" rel="icon">
  <link href="{{asset('assets2/img/logofocus.png')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets2/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets2/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('assets2/css/main.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{route('beranda')}}" class="logo d-flex align-items-center me-auto">
         <img src="{{asset('assets2/img/logofocus.png')}}" alt=""> 
        {{-- <h1 class="sitename">Mentor</h1> --}}
      </a>

      <nav id="navmenu" class="navmenu">
        @include('role.layout.navbar')
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      @include('role.layout.hero')
      @if(Route::currentRouteName() === 'beranda')
          @include('role.layout.navbar2')
        @endif
    </section><!-- /Hero Section -->

   <!-- About Section -->
    @if(Route::currentRouteName() !== 'mahasiswa' && Route::currentRouteName() !== 'dosen' && Route::currentRouteName() !== 'mentor' && Route::currentRouteName() !== 'beranda')
      <section id="about" class="about section">
        <div class="container">
          @yield('content')
        </div>
      </section>
    @endif
    <!-- /About Section -->
  </main>

  <footer id="footer" class="footer position-relative light-background">

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Focus Ta</strong> <span>2024</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets2/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Main JS File -->
  <script src="{{asset('assets2/js/main.js')}}"></script>

</body>

</html>