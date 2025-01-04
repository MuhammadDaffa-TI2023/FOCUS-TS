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
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <img src="<?php echo e(asset('assets2/img/hero-bg.jpg')); ?>" alt="" data-aos="fade-in">

        <div class="container">
            <h1 data-aos="fade-up" data-aos-delay="100">
                Selamat Datang, <?php echo e(Auth::user()->name ?? 'di Focus TA!'); ?>

            </h1>
            <p class="fs-5">Nikmati pengalaman baru dalam menyelesaikan Tugas Akhir bersama kami. <br>
                Mulai rencanakan, kelola, dan wujudkan mimpi akademikmu di sini!</p>
              <?php if(auth()->guard()->guest()): ?>
              <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                  <a href=<?php echo e(route('login')); ?> class="btn-get-started">Login</a>
                </div>
              <?php endif; ?>
        </div>
    </section><!-- /Hero Section -->

   <!-- About Section -->
      <section id="about" class="about section">
        <div class="container">
          <div class="row gy-4">

            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
              <img src="<?php echo e(asset('assets2/img/about.jpg')); ?>" class="img-fluid" alt="">
            </div>
  
            <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
              <h3>Dukung Belajar Bersama Teaching Assistant (TA)</h3>
              <p class="fst-italic">
                Mengembangkan potensi akademik dengan pendampingan yang terarah dan efektif.
              </p>
              <ul>
                <li><i class="bi bi-check-circle"></i> <span>Pendampingan intensif untuk meningkatkan pemahaman materi kuliah.</span></li>
                <li><i class="bi bi-check-circle"></i> <span> Sesi diskusi dan konsultasi yang fleksibel dan responsif.</span></li>
                <li><i class="bi bi-check-circle"></i> <span>Bimbingan dalam mengatasi tantangan akademik secara efektif._</span></li>
              </ul>
              <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
  
          </div>
        </div>
      </section>
    <!-- /About Section -->
       <!-- Counts Section -->
    <section id="counts" class="section counts light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end=<?php echo e($jumlahMahasiswa); ?> data-purecounter-duration="1" class="purecounter"></span>
              <p>Mahasiswa</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-4 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end=<?php echo e($jumlahMateri); ?> data-purecounter-duration="1" class="purecounter"></span>
              <p>Materi</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-4 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end=<?php echo e($jumlahMentor->count()); ?> data-purecounter-duration="1" class="purecounter"></span>
              <p>Mentor</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Counts Section -->

    <!-- Trainers Index Section -->
    <section id="trainers-index" class="section trainers-index">

      <div class="container">

        <div class="row">
          <?php $__currentLoopData = $jumlahMentor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mentor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <img src="<?php echo e(asset('storage/' . $mentor->gambar)); ?>" class="img-fluid" alt="">
              <div class="member-content">
                <h4><?php echo e($mentor->nama); ?></h4>
                <span><?php echo e($mentor->bidang); ?></span>
                <p>
                  <?php echo e($mentor->email); ?>

                </p>
              </div>
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

</html><?php /**PATH D:\KERJAAN\joki-rpl\focus-ta\resources\views/beranda.blade.php ENDPATH**/ ?>