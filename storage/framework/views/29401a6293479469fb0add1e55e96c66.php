
<?php $__env->startSection('content'); ?>
    <div class="row gy-4">
        <h1>Daftar Janji Temu</h1>
    </div>

    <div class="row gy-4">
        <div class="table-responsive">
            <table class="table table-striped">
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
                                                    <h5 class="modal-title text-secondary">Edit Status Janji Temu</h5>
                                                    <button class="btn btn-close" data-bs-dismiss="modal">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('edit-janjitemu-dosen', $janji->id)); ?>"
                                                        method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('put'); ?>
                                                        <!-- Status -->
                                                        <div class="col-12 mb-15">
                                                            <label for="status" class="text-secondary">Status</label>
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
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('role.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FOCUS TA\focus-ta\resources\views/role/dosen/janji-temu.blade.php ENDPATH**/ ?>