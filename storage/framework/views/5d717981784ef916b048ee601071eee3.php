
<ul>
    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->hasRole('admin')): ?>
            <li><a href="<?php echo e(route('dashboard-admin')); ?>">Dashboard Admin</a></li>
        <?php elseif(auth()->user()->hasRole('mahasiswa')): ?>
            <li><a href="<?php echo e(route('dashboard-mahasiswa')); ?>">Dashboard Mahasiswa</a></li>
        <?php elseif(auth()->user()->hasRole('mentor')): ?>
            <li><a href="<?php echo e(route('dashboard-mentor')); ?>">Dashboard Mentor</a></li>
        <?php elseif(auth()->user()->hasRole('dosen')): ?>
            <li><a href="<?php echo e(route('dashboard-dosen')); ?>">Dashboard Dosen</a></li>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(auth()->guard()->guest()): ?>
        <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
        <li>sadas</li>
    <?php endif; ?>
</ul><?php /**PATH D:\KERJAAN\joki-rpl\focus-ta\resources\views/role/layout/navbar2.blade.php ENDPATH**/ ?>