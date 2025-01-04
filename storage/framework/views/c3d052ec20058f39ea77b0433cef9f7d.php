
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-secondary font-monospace">Data User</h1>
        </div>
    </div>
    <div class="row">
        
        <div class="col-md-12 mb-30">
            <div class="box bg-white shadow ">
                <div class="box-head d-flex justify-content-between align-items-center">
                    <h4 class="title text-secondary">Daftar User</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahuser">Tambah Data</button>
                </div>
                
                <div class="modal fade" id="tambahuser">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content bg-white">
                            <div class="modal-header">
                                <h5 class="modal-title text-secondary">Tambah User</h5>
                                <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo e(route('add-user')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-3">
                                        <label for="username" class="form-label text-secondary">Username</label>
                                        <input type="text" class="form-control bg-secondary text-white" id="username" name="username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label text-secondary">Email</label>
                                        <input type="email" class="form-control bg-secondary text-white" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label text-secondary">Password</label>
                                        <input type="password" class="form-control bg-secondary text-white" id="password" name="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label text-secondary">Role</label>
                                        <select class="form-control bg-secondary text-white" name="role[]" required>
                                            <option hidden>Pilih Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="mahasiswa">Mahasiswa</option>
                                            <option value="mentor">Mentor</option>
                                            <option value="dosen">Dosen</option>
                                        </select>
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

                
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-vertical-middle table-selectable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($user->name); ?></td>
                                        <td>
                                            <?php $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <?php echo e(ucfirst($role)); ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editUser<?php echo e($user->id); ?>">Edit</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteUser<?php echo e($user->id); ?>">Hapus</button>
                                        </td>
                                    </tr>

                                    
                                    <div class="modal fade" id="editUser<?php echo e($user->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-secondary">Edit User</h5>
                                                    <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('edit-user', $user->id)); ?>" method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('put'); ?>
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label text-secondary">Username</label>
                                                            <input type="text" class="form-control bg-secondary text-white" name="username" value="<?php echo e(old('name', $user->name)); ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label text-secondary">Email</label>
                                                            <input type="email" class="form-control bg-secondary text-white" name="email" value="<?php echo e($user->email); ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label text-secondary">Password</label>
                                                            <input type="password" class="form-control bg-secondary text-white" name="password" value="<?php echo e($user->password); ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="role" class="form-label text-secondary">Role</label>
                                                            <select class="form-control bg-secondary text-white" name="role[]" required>
                                                                <option value="admin" <?php echo e(in_array('admin', $user->getRoleNames()->toArray()) ? 'selected' : ''); ?>>Admin</option>
                                                                <option value="mahasiswa" <?php echo e(in_array('mahasiswa', $user->getRoleNames()->toArray()) ? 'selected' : ''); ?>>Mahasiswa</option>
                                                                <option value="mentor" <?php echo e(in_array('mentor', $user->getRoleNames()->toArray()) ? 'selected' : ''); ?>>Mentor</option>
                                                                <option value="dosen" <?php echo e(in_array('dosen', $user->getRoleNames()->toArray()) ? 'selected' : ''); ?>>Dosen</option>
                                                            </select>
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

                                    
                                    <div class="modal fade" id="deleteUser<?php echo e($user->id); ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger">Hapus User</h5>
                                                    <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus user ini?</p>
                                                </div>
                                                <form action="<?php echo e(route('delete-user', $user->id)); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('delete'); ?>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KERJAAN\joki-rpl\focus-ta\resources\views/user/index.blade.php ENDPATH**/ ?>