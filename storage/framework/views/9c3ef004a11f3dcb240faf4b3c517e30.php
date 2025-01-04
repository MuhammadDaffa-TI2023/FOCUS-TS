
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
                    <h4 class="title text-secondary">Daftar mahasiswa</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tambahmahasiswa">Tambah</button>
                    
                    <div class="modal fade " id="tambahmahasiswa">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-secondary">Tambah mahasiswa</h5>
                                    <button class="close" data-bs-dismiss="modal"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo e(route('add-mahasiswa')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('post'); ?>
                                        <div class="row mbn-15 mt-2">
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Nama</label>
                                                <input type="text" class="form-control bg-secondary text-white" name="nama" placeholder="Nama mahasiswa" required>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Nim</label>
                                                <input type="text" class="form-control bg-secondary text-white" name="nim" placeholder="Nim mahasiswa" required>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Email</label>
                                                <input type="email" class="form-control bg-secondary text-white" name="email" placeholder="Email" required>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Prodi</label>
                                                <select class="form-control bg-secondary text-white" name="prodi_id" required>
                                                    <option class="" hidden>Pilih Prodi</option>
                                                    <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($p->id); ?>"><?php echo e($p->nama); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
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
                                    <th><span class="text-secondary">Nim</span></th>
                                    <th><span class="text-secondary">Prodi</span></th>
                                    <th><span class="text-secondary">Aksi</span></th>
                                    <th></th>
                                </tr>
                            </thead><!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>
                                <?php $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-white">
                                        <td class="text-secondary"><?php echo e($loop->iteration); ?></td>
                                        <td class="text-secondary"><?php echo e($mhs->nama); ?></td>
                                        <td class="text-secondary"><?php echo e($mhs->nim); ?></td>
                                        <td class="text-secondary"><?php echo e($mhs->prodi->nama); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editmahasiswa<?php echo e($mhs->id); ?>">Edit</button>
                                            
                                            <div class="modal fade " id="editmahasiswa<?php echo e($mhs->id); ?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-white">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-secondary">Edit mahasiswa</h5>
                                                            <button class="close" data-bs-dismiss="modal"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?php echo e(route('edit-mahasiswa', $mhs->id)); ?>" method="post">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('put'); ?>
                                                                <div class="row mbn-15 mt-2">
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                            class="text-secondary">Nama</label>
                                                                        <input type="text"
                                                                            class="form-control bg-secondary text-white"
                                                                            name="nama" placeholder="Nama mahasiswa" required
                                                                            value="<?php echo e(old('nama', $mhs->nama)); ?>">
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                        class="text-secondary">Nim</label>
                                                                        <input type="text" class="form-control bg-secondary text-white" name="nim" placeholder="NIM Mahasiswa" required value="<?php echo e(old('nim', $mhs->nim)); ?>">
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                        class="text-secondary">Email</label>
                                                                        <input type="email" class="form-control bg-secondary text-white" name="email" placeholder="Email Mahasiswa" required value="<?php echo e(old('email', $mhs->email)); ?>">
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                        class="text-secondary">Prodi</label>
                                                                        <select class="form-control bg-secondary text-white" name="prodi_id" required>
                                                                            <option hidden>Pilih Prodi</option>
                                                                            <?php $__currentLoopData = $prodi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($p->id); ?>" <?php echo e($p->id == $mhs->prodi_id ? 'selected' : ''); ?>><?php echo e($p->nama); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
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
                                                data-bs-target="#deletemahasiswa<?php echo e($mhs->id); ?>">Hapus</button>
                                            
                                            <div class="modal fade" id="deletemahasiswa<?php echo e($mhs->id); ?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content bg-white ">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">HAPUS mahasiswa</h5>
                                                        <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body text-secondary">
                                                        <p>Anda Yakin Ingin Menghapus mahasiswa Ini?</p>
                                                    </div>
                                                    <form action="<?php echo e(route('delete-mahasiswa', $mhs->id)); ?>" method="post">
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

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KERJAAN\joki-rpl\focus-ta\resources\views/mahasiswa/index.blade.php ENDPATH**/ ?>