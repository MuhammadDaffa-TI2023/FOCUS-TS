
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-secondary font-monospace">DASHBOARD WEBSITE</h1>
        </div>
    </div>
    <div class="row">
        
        <div class="col-md-12 mb-30">
            <div class="box bg-white shadow ">
                <div class="box-head">
                    <h4 class="title text-secondary">Daftar Fakultas</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tambahfakultas">Tambah</button>
                    
                    <div class="modal fade " id="tambahfakultas">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-secondary">Tambah Fakultas</h5>
                                    <button class="close" data-bs-dismiss="modal"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo e(route('add-fakultas')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('post'); ?>
                                        <div class="row mbn-15 mt-2">
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Nama</label>
                                                <input type="text" class="form-control bg-secondary text-white" name="nama" placeholder="Nama fakultas" required>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="button button-warning"
                                        data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" class="button button-success">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive ">
                        <table class="table table-vertical-middle table-selectable ">

                            <!-- Table Head Start -->
                            <thead>
                                <tr class="text-white">
                                    <th class="text-secondary">No</th>
                                    <th><span class="text-secondary">Nama</span></th>
                                    <th><span class="text-secondary">Aksi</span></th>
                                    <th></th>
                                </tr>
                            </thead><!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>
                                <?php $__currentLoopData = $fakultas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-white">
                                        <td class="text-secondary"><?php echo e($loop->iteration); ?></td>
                                        <td class="text-secondary"><?php echo e($p->nama); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editfakultas<?php echo e($p->id); ?>">Edit</button>
                                            
                                            <div class="modal fade " id="editfakultas<?php echo e($p->id); ?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-white">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-secondary">Edit fakultas</h5>
                                                            <button class="close" data-bs-dismiss="modal"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?php echo e(route('edit-fakultas', $p->id)); ?>" method="post">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('put'); ?>
                                                                <div class="row mbn-15 mt-2">
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                            class="text-secondary">Nama</label>
                                                                        <input type="text"
                                                                            class="form-control bg-secondary text-white"
                                                                            name="nama" placeholder="Nama fakultas" required
                                                                            value="<?php echo e(old('nama', $p->nama)); ?>">
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="button button-warning"
                                                                data-bs-dismiss="modal">Kembali</button>
                                                            <button type="submit"
                                                                class="button button-success">Edit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="button button-danger" data-bs-toggle="modal"
                                                data-bs-target="#deletefakultas<?php echo e($p->id); ?>">Hapus</button>
                                            
                                    <div class="modal fade" id="deletefakultas<?php echo e($p->id); ?>">
                                        <div class="modal-dialog">
                                           <div class="modal-content bg-white ">
                                             <div class="modal-header">
                                                 <h5 class="modal-title">HAPUS fakultas</h5>
                                                 <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                              </div>
                                              <div class="modal-body text-secondary">
                                                 <p>Anda Yakin Ingin Menghapus fakultas Ini?</p>
                                              </div>
                                              <form action="<?php echo e(route('delete-fakultas', $p->id)); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('delete'); ?>
                                                <div class="modal-footer">
                                                    <button type="button" class="button button-danger" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="button button-primary">Hapus</button>
                                                </div>
                                             </form>
                                           </div>
                                        </div>
                                    </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody><!-- Table Body End -->

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KERJAAN\joki-rpl\focus-ta\resources\views/fakultas/index.blade.php ENDPATH**/ ?>