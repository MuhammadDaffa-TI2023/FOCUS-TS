
<?php $__env->startSection('content'); ?>
    <div class="row gy-4">
        <h1>Daftar Dokumen</h1>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahdokumen">
                Tambah Dokumen
            </button>
        </div>
    </div>

    <div class="row gy-4">
        <div class="table-responsive">
            <table class="table table-striped">
                
                <div class="modal fade" id="tambahdokumen" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Dokumen</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo e(route('add-dokumen-mhs')); ?>" method="post" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('post'); ?>
                                    <div class="row mbn-15 mt-2">
                                        <div class="col-12 mb-15">
                                            <label for="" class="text-secondary">Keterangan Dokumen</label>
                                            <textarea class="form-control bg-secondary text-white" name="keterangan" placeholder="keterangan dokumen" required></textarea>
                                        </div>
                                        <div class="col-12 mb-15">
                                            <label for="" class="text-secondary">dosen</label>
                                            <select class="form-control bg-secondary text-white" name="dosen_id" required>
                                                <option class="" hidden>Pilih Dosen</option>
                                                <?php $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($d->id); ?>"><?php echo e($d->nama); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-15">
                                            <label for="formFile" class="form-label">Dokumen (Gambar/Docx/Pdf) Max
                                                5MB</label>
                                            <input name="file" class="form-control  bg-secondary text-white"
                                                type="file" id="formFile" accept=".jpg,.jpeg,.png,.pdf,.docx">
                                        </div>
                                        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin|dosen')): ?>
                                            <div class="col-12 mb-15">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" class="form-control bg-secondary text-white">
                                                    <option value="Proses" selected>Proses</option>
                                                    <option value="Setuju">Setuju</option>
                                                    <option value="Revisi">Revisi</option>
                                                </select>
                                            </div>
                                        <?php endif; ?>
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
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Keterangan</th>
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
                                        data-bs-target="#editdokumen<?php echo e($d->id); ?>">Edit</button>
                                    
                                    <div class="modal fade " id="editdokumen<?php echo e($d->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-secondary">Edit dokumen</h5>
                                                    <button class="btn btn-close" data-bs-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('edit-dokumen-mhs', $d->id)); ?>" method="post"
                                                        enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('put'); ?>
                                                        <div class="row mbn-15 mt-2">
                                                            <div class="col-12 mb-15">
                                                                <label for="" class="text-secondary">Keterangan Dokumen</label>
                                                                <textarea class="form-control bg-secondary text-white" name="keterangan" placeholder="keterangan dokumen" required
                                                                  ><?php echo e($d->keterangan); ?></textarea>
                                                            </div>
                                                            <div class="col-12 mb-15">
                                                                <label for=""
                                                                class="text-secondary">Dosen</label>
                                                                <select class="form-control bg-secondary text-white" name="dosen_id" required>
                                                                    <option hidden>Pilih dosen</option>
                                                                    <?php $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dsn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($dsn->id); ?>" <?php echo e($dsn->id == $d->dosen_id ? 'selected' : ''); ?>><?php echo e($dsn->nama); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-12 mb-15">
                                                                <label for=""
                                                                    class="text-secondary">Dokumen</label>
                                                                    <input type="file" name="file" id="file" class="form-control bg-secondary text-white">
                                                                    <?php if($d->file): ?>
                                                                        <p class="p-3 bg-secondary text-white">File saat ini: <a href="<?php echo e(asset('storage/' . $d->file)); ?>" target="_blank">Lihat Dokumen</a></p>
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
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deletedokumen<?php echo e($d->id); ?>">Hapus</button>
                                    
                                    <div class="modal fade" id="deletedokumen<?php echo e($d->id); ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-white ">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">HAPUS dokumen</h5>
                                                    <button class="btn btn-close" data-bs-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body text-secondary">
                                                    <p>Anda Yakin Ingin Menghapus dokumen Ini?</p>
                                                </div>
                                                <form action="<?php echo e(route('delete-dokumen-mhs', $d->id)); ?>" method="post">
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

<?php echo $__env->make('role.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KERJAAN\joki-rpl\focus-ta\resources\views/role/mahasiswa/dokumen.blade.php ENDPATH**/ ?>