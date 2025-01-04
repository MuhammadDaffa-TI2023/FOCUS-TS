<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <?php if (\Illuminate\Support\Facades\Blade::check('role', 'mahasiswa')): ?>
  <title>DASHBOARD | MAHASISWA</title>
  <?php endif; ?>
  <?php if (\Illuminate\Support\Facades\Blade::check('role', 'dosen')): ?>
  <title>DASHBOARD | DOSEN</title>
  <?php endif; ?>
  <?php if(auth()->guard()->guest()): ?>
  <title>FOCUS TA</title>
  <?php endif; ?>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?php echo e(asset('assets2/img/logofocus.png')); ?>" rel="icon">
  <link href="<?php echo e(asset('assets2/img/logofocus.png')); ?>" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo e(asset('assets2/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets2/vendor/bootstrap-icons/bootstrap-icons.css')); ?>" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?php echo e(asset('assets2/css/main.css')); ?>" rel="stylesheet">

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

      <a href="<?php echo e(route('beranda')); ?>" class="logo d-flex align-items-center me-auto">
         <img src="<?php echo e(asset('assets2/img/logofocus.png')); ?>" alt=""> 
        
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <?php if(auth()->guard()->guest()): ?>
          <li><a href="<?php echo e(route('beranda')); ?>">Home<br></a></li>
          <li><a href="<?php echo e(route('beranda-about')); ?>">About<br></a></li>
          <li><a href="<?php echo e(route('beranda-mentor')); ?>">Mentor<br></a></li>
          <?php endif; ?>
          <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
          <li><a href="<?php echo e(route('beranda')); ?>">Home<br></a></li>
          <li><a href="<?php echo e(route('beranda-about')); ?>">About<br></a></li>
          <li><a href="<?php echo e(route('beranda-mentor')); ?>">Mentor<br></a></li>
          <li><a href="<?php echo e(route('dashboard-admin')); ?>">Dashboard<br></a></li>
          <?php endif; ?>
          <?php if (\Illuminate\Support\Facades\Blade::check('role', 'mahasiswa')): ?>
          <li><a href="<?php echo e(route('beranda')); ?>">Home<br></a></li>
          <li><a href="<?php echo e(route('beranda-about')); ?>">About<br></a></li>
          <li><a href="<?php echo e(route('beranda-mentor')); ?>">Mentor<br></a></li>
          <li><a href="<?php echo e(route('mahasiswa')); ?>">Dashboard<br></a></li>
          <?php endif; ?>
          <?php if (\Illuminate\Support\Facades\Blade::check('role', 'mentor')): ?>
          <li><a href="<?php echo e(route('beranda')); ?>">Home<br></a></li>
          <li><a href="<?php echo e(route('beranda-about')); ?>">About<br></a></li>
          <li><a href="<?php echo e(route('beranda-mentor')); ?>">Mentor<br></a></li>
          <li><a href="<?php echo e(route('mentor')); ?>">Dashboard<br></a></li>
          <?php endif; ?>
          <?php if (\Illuminate\Support\Facades\Blade::check('role', 'dosen')): ?>
          <li><a href="<?php echo e(route('beranda')); ?>">Home<br></a></li>
          <li><a href="<?php echo e(route('beranda-about')); ?>">About<br></a></li>
          <li><a href="<?php echo e(route('beranda-mentor')); ?>">Mentor<br></a></li>
          <li><a href="<?php echo e(route('dosen')); ?>">Dashboard<br></a></li>
          <?php endif; ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">
   <!-- Page Title -->
   <div class="page-title mentor" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Mentor</h1>
            <p class="mb-0">Mentor bukan hanya tentang menyelesaikan target, tetapi juga tentang menjaga semangat dan keyakinanmu tetap menyala. Saat tantangan datang, mentor ada untuk mendengarkan, memotivasi, dan mengingatkan bahwa mimpi kelulusanmu semakin dekat.</p>
          </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="<?php echo e(route('beranda')); ?>">Home</a></li>
          <li class="current">Mentor</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Page Title -->

    <!-- Trainers Index Section -->
    <section id="trainers-index" class="section trainers">

      <div class="container">

        <div class="row">
          <?php $__currentLoopData = $jumlahMentor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mentor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
            <div class="member-img">
              <img src="<?php echo e(asset('storage/' . $mentor->gambar)); ?>" class="img-fluid" alt="">
            </div>
            <div class="member-info text-center">
              <h4><?php echo e($mentor->nama); ?></h4>
              <span><?php echo e($mentor->bidang); ?></span>
            </div>
          </div><!-- End Team Member -->
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

      </div>

    </section><!-- /Trainers Index Section -->

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
  <script src="<?php echo e(asset('assets2/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets2/vendor/php-email-form/validate.js')); ?>"></script>
  <script src="<?php echo e(asset('assets2/vendor/aos/aos.js')); ?>"></script>
  <script src="<?php echo e(asset("assets2/vendor/glightbox/js/glightbox.min.js")); ?>"></script>
  <script src="<?php echo e(asset('assets2/vendor/purecounter/purecounter_vanilla.js')); ?>"></script>
  <script src="<?php echo e(asset('assets2/vendor/swiper/swiper-bundle.min.js')); ?>"></script>
  <!-- Main JS File -->
  <script src="<?php echo e(asset('assets2/js/main.js')); ?>"></script>

</body>

</html><?php /**PATH D:\KERJAAN\joki-rpl\focus-ta\resources\views/mentor.blade.php ENDPATH**/ ?>