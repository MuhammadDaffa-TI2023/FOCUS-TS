
<?php $__env->startSection('content'); ?>
    <div class="row gy-4">
        <h1>Daftar Dokumen</h1>
    </div>

    <div class="row gy-4">
        <div class="table-responsive">
            <table class="table table-striped">
                
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Keterangan Mahasiswa</th>
                            <th scope="col">Keterangan Dosen</th>
                            <th scope="col">Status</th>
                            <th scope="col">Dokumen</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $dokumen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th><?php echo e($loop->iteration); ?></th>
                                <td><?php echo e($d->user->name); ?></td>
                                <td><?php echo e($d->keterangan); ?></td>
                                <td><?php echo e($d->keterangan_dosen); ?></td>
                                <td>
                                    <?php if($d->status == 'Proses'): ?>
                                        <span class="badge text-bg-warning">Proses</span>
                                    <?php elseif($d->status == 'Setuju'): ?>
                                        <span class="badge text-bg-success">Setuju</span>
                                    <?php elseif($d->status == 'Revisi'): ?>
                                        <span class="badge text-bg-danger">Revisi</span>
                                    <?php endif; ?>
                                </td>
                                <td><a href="<?php echo e(asset('storage/' . $d->file)); ?>" target="_blank">Lihat Dokumen</a></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editdokumen<?php echo e($d->id); ?>">Beri Feedback</button>
                                    
                                    <div class="modal fade " id="editdokumen<?php echo e($d->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-secondary">Edit dokumen</h5>
                                                    <button class="btn btn-close" data-bs-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('edit-dokumen-dosen', $d->id)); ?>" method="post"
                                                        enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('put'); ?>
                                                        <div class="row mbn-15 mt-2">
                                                            <div class="col-12 mb-15">
                                                                <label for="" class="text-secondary">Keterangan Dosen</label>
                                                                <textarea class="form-control bg-secondary text-white" name="keterangan_dosen" 
                                                                ><?php echo e(old('keterangan_dosen', $d->keterangan_dosen)); ?>

                                                                </textarea>
                                                            </div>
                                                            <div class="col-12 mb-15">
                                                                <label for="status" class="text-secondary">Status</label>
                                                                <select name="status" class="form-control bg-secondary text-white">
                                                                    <option value="Proses" <?php echo e($d->status == 'Proses' ? 'selected' : ''); ?>>Proses</option>
                                                                    <option value="Setuju" <?php echo e($d->status == 'Setuju' ? 'selected' : ''); ?>>Setuju</option>
                                                                    <option value="Revisi" <?php echo e($d->status == 'Revisi' ? 'selected' : ''); ?>>Revisi</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning"
                                                        data-bs-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-success">Edit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('role.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KERJAAN\joki-rpl\focus-ta\resources\views/role/dosen/dokumen.blade.php ENDPATH**/ ?>