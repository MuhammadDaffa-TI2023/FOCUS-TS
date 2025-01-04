
<?php $__env->startSection('content'); ?>
    <div class="row gy-4">
        <h1>Daftar Janji Temu</h1>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahjanjitemu">
                Buat Janji Temu
            </button>
        </div>
    </div>

    <div class="row gy-4">
        <div class="table-responsive">
            <table class="table table-striped">
                
                <div class="modal fade" id="tambahjanjitemu" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Janji Temu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo e(route('add-janjitemu-mhs')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('post'); ?>
                                    <div class="row mbn-15 mt-2">
                                        <!-- Input Tanggal -->
                                        <div class="col-12 mb-15">
                                            <label for="tanggal" class="text-secondary">Tanggal</label>
                                            <input type="date" class="form-control bg-secondary text-white"
                                                name="tanggal" required>
                                        </div>

                                        <!-- Input Jam -->
                                        <div class="col-12 mb-15">
                                            <label for="jam" class="text-secondary">Jam</label>
                                            <input type="time" class="form-control bg-secondary text-white"
                                                name="jam" required>
                                        </div>

                                        <!-- Pilihan Dosen -->
                                        <div class="col-12 mb-15">
                                            <label for="dosen" class="text-secondary">Dosen</label>
                                            <select class="form-control bg-secondary text-white" name="dosen_id" required>
                                                <option hidden>Pilih Dosen</option>
                                                <?php $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($d->id); ?>"><?php echo e($d->nama); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <input type="hidden" name="mahasiswa_id">

                                        <input type="hidden" name="status" value="Proses">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Mahasiswa</th>
                            <th scope="col">Dosen</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $janjitemu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $janji): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-secondary"><?php echo e($loop->iteration); ?></td>
                                <td class="text-secondary"><?php echo e($janji->jam); ?> <?php echo e($janji->tanggal); ?></td>
                                <td class="text-secondary"><?php echo e($janji->mahasiswa->nama); ?></td>
                                <td class="text-secondary"><?php echo e($janji->dosen->nama); ?></td>
                                <td>
                                    <?php if($janji->status == 'Proses'): ?>
                                        <span class="badge text-bg-warning">Proses</span>
                                    <?php elseif($janji->status == 'Setuju'): ?>
                                        <span class="badge text-bg-success">Setuju</span>
                                    <?php elseif($janji->status == 'Tolak'): ?>
                                        <span class="badge text-bg-danger">Tolak</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editjanji<?php echo e($janji->id); ?>">Edit</button>
                                    
                                    <div class="modal fade" id="editjanji<?php echo e($janji->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-secondary">Edit Janji Temu</h5>
                                                    <button class="btn btn-close" data-bs-dismiss="modal">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('edit-janjitemu-mhs', $janji->id)); ?>"
                                                        method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('put'); ?>
                                                        <div class="row mbn-15 mt-2">
                                                            <!-- Input Tanggal -->
                                                            <div class="col-12 mb-15">
                                                                <label for="tanggal" class="text-secondary">Tanggal</label>
                                                                <input type="date"
                                                                    class="form-control bg-secondary text-white"
                                                                    name="tanggal" required
                                                                    value="<?php echo e(old('tanggal', $janji->tanggal)); ?>">
                                                            </div>

                                                            <!-- Input Jam -->
                                                            <div class="col-12 mb-15">
                                                                <label for="jam" class="text-secondary">Jam</label>
                                                                <input type="time"
                                                                    class="form-control bg-secondary text-white"
                                                                    name="jam" required
                                                                    value="<?php echo e(old('jam', $janji->jam)); ?>">
                                                            </div>

                                                            <!-- Pilih Dosen -->
                                                            <div class="col-12 mb-15">
                                                                <label for="dosen" class="text-secondary">Dosen</label>
                                                                <select class="form-control bg-secondary text-white"
                                                                    name="dosen_id" required>
                                                                    <option hidden>Pilih Dosen</option>
                                                                    <?php $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($d->id); ?>"
                                                                            <?php echo e($janji->dosen_id == $d->id ? 'selected' : ''); ?>>
                                                                            <?php echo e($d->nama); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>

                                                            <!-- Mahasiswa ID (Disembunyikan, otomatis diambil) -->
                                                            <input type="hidden" name="mahasiswa_id">

                                                            <!-- Status (Disembunyikan jika mahasiswa tidak boleh mengedit status) -->
                                                            <?php if(Auth::user()->role == 'admin' || Auth::user()->role == 'dosen'): ?>
                                                                <div class="col-12 mb-15">
                                                                    <label for="status"
                                                                        class="text-secondary">Status</label>
                                                                    <select class="form-control bg-secondary text-white"
                                                                        name="status" required>
                                                                        <option hidden>Pilih Status</option>
                                                                        <option value="Proses"
                                                                            <?php echo e($janji->status == 'Proses' ? 'selected' : ''); ?>>
                                                                            Proses</option>
                                                                        <option value="Setuju"
                                                                            <?php echo e($janji->status == 'Setuju' ? 'selected' : ''); ?>>
                                                                            Setuju</option>
                                                                        <option value="Tolak"
                                                                            <?php echo e($janji->status == 'Tolak' ? 'selected' : ''); ?>>
                                                                            Tolak</option>
                                                                    </select>
                                                                </div>
                                                            <?php else: ?>
                                                                <input type="hidden" name="status"
                                                                    value="<?php echo e($janji->status); ?>">
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deletejanjitemu<?php echo e($janji->id); ?>">Hapus</button>
                                    
                                    <div class="modal fade" id="deletejanjitemu<?php echo e($janji->id); ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-white ">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">HAPUS JANJI TEMU</h5>
                                                    <button class="btn btn-close" data-bs-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body text-secondary">
                                                    <p>Anda Yakin Ingin Menghapus janjitemu Ini?</p>
                                                </div>
                                                <form action="<?php echo e(route('delete-janjitemu-mhs', $janji->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('delete'); ?>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary "
                                                            data-bs-dismiss="modal">Hapus</button>
                                                    </div>
                                                </form>
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

<?php echo $__env->make('role.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FOCUS TA\focus-ta\resources\views/role/mahasiswa/janji-temu.blade.php ENDPATH**/ ?>