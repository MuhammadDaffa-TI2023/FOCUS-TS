
<?php $__env->startSection('content'); ?>
    <div class="row gy-4">
        <h1>Daftar Materi</h1>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahdokumen">
                Tambah Dokumen Materi
            </button>
            
            <div class="modal fade" id="tambahdokumen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Dokumen</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo e(route('add-materi-dosen')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('post'); ?>
                                <div class="row mbn-15 mt-2">
                                    <div class="col-12 mb-15">
                                        <label for="" class="text-secondary">Nama Materi</label>
                                        <input type="text" class="form-control bg-secondary text-white" name="nama"
                                            placeholder="Nama Materi" required>
                                    </div>
                                    <div class="col-12 mb-15">
                                        <label for="" class="text-secondary">Kategori</label>
                                        <select class="form-control bg-secondary text-white" name="kategori_id" required>
                                            <option class="" hidden>Pilih Kategori</option>
                                            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-15">
                                        <label for="formFile" class="form-label">Dokumen (Gambar/Docx/Pdf) Max
                                            5MB</label>
                                        <input name="file" class="form-control  bg-secondary text-white" type="file"
                                            id="formFile" accept=".jpg,.jpeg,.png,.pdf,.docx">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                        <th scope="col">Aksi</th>
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
                            <td>
                                <?php if($m->user_id === Auth::id()): ?>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editdokumen<?php echo e($m->id); ?>">Edit</button>
                                <?php endif; ?>
                                
                                <div class="modal fade " id="editdokumen<?php echo e($m->id); ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-secondary">Edit dokumen</h5>
                                                <button class="btn btn-close" data-bs-dismiss="modal"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo e(route('edit-materi-dosen', $m->id)); ?>" method="post"
                                                    enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('put'); ?>
                                                    <div class="row mbn-15 mt-2">
                                                        <div class="col-12 mb-15">
                                                            <label for="" class="text-secondary">Nama Materi</label>
                                                            <input type="text" 
                                                            class="form-control bg-secondary text-white" 
                                                            name="nama" 
                                                            value="<?php echo e(old('nama', $m->nama)); ?>"
                                                            placeholder="Nama Materi" 
                                                            required>
                                                        </div>
                                                        <div class="col-12 mb-15">
                                                            <label for="" class="text-secondary">Kategori</label>
                                                            <select class="form-control bg-secondary text-white"
                                                                name="kategori_id" required>
                                                                <option hidden>Pilih kategori</option>
                                                                <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($k->id); ?>"
                                                                        <?php echo e($k->id == $m->kategori_id ? 'selected' : ''); ?>>
                                                                        <?php echo e($k->nama); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 mb-15">
                                                            <label for="" class="text-secondary">Dokumen</label>
                                                            <input type="file" name="file" id="file"
                                                                class="form-control bg-secondary text-white">
                                                            <?php if($m->file): ?>
                                                                <p class="p-3 bg-secondary text-white">File saat ini: <a
                                                                        href="<?php echo e(asset('storage/' . $m->file)); ?>"
                                                                        target="_blank">Lihat Dokumen</a></p>
                                                            <?php endif; ?>
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
                                <?php if($m->user_id === Auth::id()): ?>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletedokumen<?php echo e($m->id); ?>">
                                        Hapus
                                    </button>
                                    
                                    <div class="modal fade" id="deletedokumen<?php echo e($m->id); ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Hapus dokumen</h5>
                                                    <button class="btn btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body text-secondary">
                                                    <p>Anda yakin ingin menghapus dokumen ini?</p>
                                                </div>
                                                <form action="<?php echo e(route('delete-materi-dosen', $m->id)); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('delete'); ?>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('role.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FOCUS TA\focus-ta\resources\views/role/dosen/materi.blade.php ENDPATH**/ ?>