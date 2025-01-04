
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
                    <h4 class="title text-secondary">Daftar Janji Temu</h4>
                    <div class="row">
                        <div class="col-md-7">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tambahjanjii">Tambah</button>
                        </div>
                        <div class="col-md-5">
                            <div class="search-bar">
                                <form action="<?php echo e(route('search-janjiTemu')); ?>" method="GET">
                                <div class="input-group rounded">
                                    <input type="search" class="form-control bg-secondary text-white rounded" name="search"
                                        id="search-bar" placeholder="Cari Mahasiswa atau Dosen" aria-label="Search"
                                        aria-describedby="search-addon" />
                                    <button type="submit" class="input-group-text border-0">
                                        <i class="zmdi zmdi-search zmdi-hc-fw"></i>
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade " id="tambahjanjii">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-secondary">Buat Janji Temu</h5>
                                    <button class="close" data-bs-dismiss="modal"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo e(route('add-janjiTemu')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('post'); ?>
                                        <div class="row mbn-15 mt-2">
                                            <div class="col-12 mb-15">
                                                <label for="tanggal" class="text-secondary">Tanggal</label>
                                                <input type="date" class="form-control bg-secondary text-white " name="tanggal" required>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="jam" class="text-secondary">Jam</label>
                                                <input type="time" class="form-control bg-secondary text-white" name="jam" required>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="dosen">Dosen</label>
                                                <select class="form-control bg-secondary text-white" name="dosen_id">
                                                    <option hidden>Pilih Dosen</option>
                                                    <?php $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($d->id); ?>"><?php echo e($d->nama); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="mhs">Mahasiswa</label>
                                                <select class="form-control bg-secondary text-white" name="mahasiswa_id">
                                                    <option hidden>Pilih Mahasiswa</option>
                                                    <?php $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($mhs->id); ?>"><?php echo e($mhs->nama); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="status">Status</label>
                                                <select class="form-control bg-secondary text-white" name="status" required>
                                                    <option hidden>Pilih Status</option>
                                                    <option value="Proses">Proses</option>
                                                    <option value="Setuju">Setuju</option>
                                                    <option value="Tolak">Tolak</option>
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
                                    <th><span class="text-secondary">Waktu Janji Temu</span></th>
                                    <th><span class="text-secondary">Mahasiswa</span></th>
                                    <th><span class="text-secondary">Dosen</span></th>
                                    <th><span class="text-secondary">Status</span></th>
                                    <th><span class="text-secondary">Aksi</span></th>
                                    <th></th>
                                </tr>
                            </thead><!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>
                                <?php $__currentLoopData = $janjitemu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $janji): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-white">
                                        <td class="text-secondary"><?php echo e($loop->iteration); ?></td>
                                        <td class="text-secondary"><?php echo e($janji->jam); ?> <?php echo e($janji->tanggal); ?></td>
                                        <td class="text-secondary"><?php echo e($janji->mahasiswa->nama); ?></td>
                                        <td class="text-secondary"><?php echo e($janji->dosen->nama); ?></td>
                                        <td class="text-secondary"><?php echo e($janji->status); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editjanji<?php echo e($janji->id); ?>">Edit</button>
                                            
                                            <div class="modal fade " id="editjanji<?php echo e($janji->id); ?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-white">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-secondary">Edit janji</h5>
                                                            <button class="close" data-bs-dismiss="modal"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?php echo e(route('edit-janjiTemu', $janji->id)); ?>" method="post">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('put'); ?>
                                                                <div class="row mbn-15 mt-2">
                                                                    <div class="col-12 mb-15">
                                                                        <label for="tanggal" class="text-secondary">Tanggal</label>
                                                                        <input type="date" 
                                                                               class="form-control bg-secondary text-white" 
                                                                               name="tanggal" 
                                                                               required 
                                                                               value="<?php echo e(old('tanggal', $janji->tanggal)); ?>">
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for="jam" class="text-secondary">Jam</label>
                                                                        <input type="time" 
                                                                               class="form-control bg-secondary text-white" 
                                                                               name="jam" 
                                                                               required 
                                                                               value="<?php echo e(old('jam', $janji->jam)); ?>">
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for="dosen" class="text-secondary">Dosen</label>
                                                                        <select class="form-control bg-secondary text-white" name="dosen_id">
                                                                            <option hidden>Pilih Dosen</option>
                                                                            <?php $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($d->id); ?>" 
                                                                                        <?php echo e($janji->dosen_id == $d->id ? 'selected' : ''); ?>>
                                                                                    <?php echo e($d->nama); ?>

                                                                                </option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for="mahasiswa" class="text-secondary">Mahasiswa</label>
                                                                        <select class="form-control bg-secondary text-white" name="mahasiswa_id">
                                                                            <option hidden>Pilih Mahasiswa</option>
                                                                            <?php $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mhs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($mhs->id); ?>" 
                                                                                        <?php echo e($janji->mahasiswa_id == $mhs->id ? 'selected' : ''); ?>>
                                                                                    <?php echo e($mhs->nama); ?>

                                                                                </option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for="status" class="text-secondary">Status</label>
                                                                        <select class="form-control bg-secondary" name="status" required>
                                                                            <option hidden>Pilih Status</option>
                                                                            <option value="Proses" 
                                                                                    <?php echo e($janji->status == 'Proses' ? 'selected' : ''); ?>>Proses</option>
                                                                            <option value="Setuju" 
                                                                                    <?php echo e($janji->status == 'Setuju' ? 'selected' : ''); ?>>Setuju</option>
                                                                            <option value="Tolak" 
                                                                                    <?php echo e($janji->status == 'Tolak' ? 'selected' : ''); ?>>Tolak</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="button button-danger" data-bs-toggle="modal"
                                                data-bs-target="#deletejanji<?php echo e($janji->id); ?>">Hapus</button>
                                            
                                    <div class="modal fade" id="deletejanji<?php echo e($janji->id); ?>">
                                        <div class="modal-dialog">
                                           <div class="modal-content bg-white ">
                                             <div class="modal-header">
                                                 <h5 class="modal-title">HAPUS janji</h5>
                                                 <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                              </div>
                                              <div class="modal-body text-secondary">
                                                 <p>Anda Yakin Ingin Menghapus janji temu Ini?</p>
                                              </div>
                                              <form action="<?php echo e(route('delete-janjiTemu', $janji->id)); ?>" method="post">
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
                        <?php echo e($janjitemu->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KERJAAN\joki-rpl\focus-ta\resources\views/janjiTemu/index.blade.php ENDPATH**/ ?>