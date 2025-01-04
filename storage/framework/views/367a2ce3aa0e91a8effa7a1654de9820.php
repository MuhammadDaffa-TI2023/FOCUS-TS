
<?php $__env->startSection('content'); ?>
<div class="row gy-4">
    <h1>Daftar Materi</h1>
    <div class="col-md-4">
    </div>
</div>

<div class="row gy-4">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Kategori</th>
                <th scope="col">Pengunggah</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Dokumen</th>
              </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $materi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($m->nama); ?></td>
                        <td><?php echo e($m->kategori->nama); ?></td>
                        <td>
                            <?php $__currentLoopData = $m->user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e(ucfirst($role)); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td><?php echo e($m->tanggal); ?></td>
                        <td><a href="<?php echo e(asset('storage/' . $m->file)); ?>" target="_blank">Lihat Materi</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('role.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KERJAAN\joki-rpl\focus-ta\resources\views/role/mahasiswa/materi.blade.php ENDPATH**/ ?>