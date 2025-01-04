<ul>
    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'mahasiswa')): ?>
    <li><a href="<?php echo e(route('mahasiswa')); ?>">Home<br></a></li>
    <li><a href="<?php echo e(route('mahasiswa-dokumen')); ?>">Dokumen</a></li>
    <li><a href="<?php echo e(route('mahasiswa-janjitemu')); ?>">Janji Temu</a></li>
    <li><a href="<?php echo e(route('mahasiswa-materi')); ?>">Materi</a></li>
    <?php endif; ?>
    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'dosen')): ?>
    <li><a href="<?php echo e(route('dosen')); ?>">Home<br></a></li>
    <li><a href="<?php echo e(route('dosen-dokumen')); ?>">Dokumen</a></li>
    <li><a href="<?php echo e(route('dosen-janjitemu')); ?>">Janji Temu</a></li>
    <li><a href="<?php echo e(route('dosen-materi')); ?>">Materi</a></li>
    <?php endif; ?>
    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'mentor')): ?>
    <li><a href="<?php echo e(route('mentor')); ?>">Home<br></a></li>
    <li><a href="<?php echo e(route('mentor-materi')); ?>">materi</a></li>
    <?php endif; ?>
    <li>
      <form method="POST" action="<?php echo e(route('logout')); ?>">
          <?php echo csrf_field(); ?>
          <button type="submit" class="btn btn-link" style=" border: none; background: none; color: black; cursor: pointer; text-decoration: none;">
              <?php echo e(__('Log Out')); ?>

          </button>
      </form>
  </li>
  </ul><?php /**PATH D:\KERJAAN\joki-rpl\focus-ta\resources\views/role/layout/navbar.blade.php ENDPATH**/ ?>