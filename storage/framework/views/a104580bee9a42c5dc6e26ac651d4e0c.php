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
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-auto">
              <h1>About <br> Us?<br></h1>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="<?php echo e(route('beranda')); ?>">Home</a></li>
            <li class="current">About Us<br></li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->
    

   <!-- About Section -->
      <section id="about" class="about section">
        <div class="container">
          <div class="row gy-4">

            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
              <img src="<?php echo e(asset('assets2/img/about.jpg')); ?>" class="img-fluid" style="border-radius: 10%;" alt="">
            </div>
  
            <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
              <h3 class="fw-bold">Background</h3>
              <p class="fst-italic">
                Dalam dunia akademik khususnya perkuliahan, tugas akhir sering kali menjadi tantangan terbesar bagi mahasiswa tingkat akhir. Banyak mahasiswa merasa kesulitan mengelola waktu, melacak progres, dan mengingat tenggat waktu yang padat. Melihat permasalahan ini, lahirlah ide untuk menciptakan Focus TA, sebuah platform digital berbasis website yang dirancang khusus untuk membantu mahasiswa semester akhir dalam mengatur dan menyelesaikan tugas akhir mereka.

                Focus TA adalah platform yang dirancang khusus untuk membantu mahasiswa dalam mengelola proses Tugas Akhir dengan lebih mudah dan efisien. Kami memahami bahwa menyelesaikan Tugas Akhir adalah perjalanan yang penuh tantangan, mulai dari pengajuan judul, jadwal bimbingan, revisi, hingga persiapan sidang. Dengan platform ini, kami berharap dapat mengurangi beban dan pikiran, serta meningkatkan produktivitas mahasiswa dalam menyelesaikan perjalanan akademiknya.
              </p>
            
            </div>
  
          </div>
          <div class="row gy-4 mt-3">

            <div class="col-lg-6 order-1 order-lg-2 content" data-aos="fade-up" data-aos-delay="200">
              <h3 class="fw-bold">Initial Ideas</h3>
              <p class="fst-italic">
                Inspirasi muncul dari pengalaman pribadi mahasiswa yang kesulitan mengingat berbagai jadwal penting, seperti bimbingan dengan dosen, pengumpulan dokumen, dan sidang. Sebuah diskusi sederhana dengan rekan-rekan sesama mahasiswa membuktikan bahwa masalah ini dialami hampir oleh semua mahasiswa tingkat akhir. Hal ini memunculkan ide untuk menciptakan alat bantu berbasis teknologi.
              </p>
            </div>
  
            <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
              <h3 class="fw-bold">Vision</h3>
              <p class="fst-italic">
                Focus TA tidak hanya bertujuan menjadi pengingat, tetapi juga partner produktivitas bagi mahasiswa. Dengan rencana pengembangan lebih lanjut, Focus TA diharapkan dapat berkembang menjadi platform yang mendukung mahasiswa hingga tahap karier profesional.
              </p>
            
            </div>
  
          </div>
        </div>
      </section>
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
  <script src="<?php echo e(asset('assets2/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets2/vendor/php-email-form/validate.js')); ?>"></script>
  <script src="<?php echo e(asset('assets2/vendor/aos/aos.js')); ?>"></script>
  <script src="<?php echo e(asset("assets2/vendor/glightbox/js/glightbox.min.js")); ?>"></script>
  <script src="<?php echo e(asset('assets2/vendor/purecounter/purecounter_vanilla.js')); ?>"></script>
  <script src="<?php echo e(asset('assets2/vendor/swiper/swiper-bundle.min.js')); ?>"></script>
  <!-- Main JS File -->
  <script src="<?php echo e(asset('assets2/js/main.js')); ?>"></script>

</body>

</html><?php /**PATH D:\KERJAAN\joki-rpl\focus-ta\resources\views/about.blade.php ENDPATH**/ ?>