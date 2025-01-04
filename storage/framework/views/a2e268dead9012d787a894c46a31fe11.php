
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
                    <h4 class="title text-secondary">Daftar dokumen</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tambahdokumen">Tambah</button>
                    
                    <div class="modal fade " id="tambahdokumen">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-secondary">Tambah dokumen</h5>
                                    <button class="close" data-bs-dismiss="modal"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo e(route('add-dokumen')); ?>" method="post" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('post'); ?>
                                        <div class="row mbn-15 mt-2">
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Keterangan Mahasiswa</label>
                                                <textarea class="form-control bg-secondary text-white" name="keterangan" placeholder="keterangan dokumen" required></textarea>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" class="form-control bg-secondary text-white">
                                                    <option value="Proses" selected>Proses</option>
                                                    <option value="Setuju">Setuju</option>
                                                    <option value="Revisi">Revisi</option>
                                                </select>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">dosen</label>
                                                <select class="form-control bg-secondary text-white" name="dosen_id"
                                                    required>
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
                                    <th><span class="text-secondary">Pemilik Dokumen</span></th>
                                    <th><span class="text-secondary">Keterangan</span></th>
                                    <th><span class="text-secondary">Keterangan_dosen</span></th>
                                    <th><span class="text-secondary">Dosen</span></th>
                                    <th><span class="text-secondary">Status</span></th>
                                    <th><span class="text-secondary">Dokumen</span></th>
                                    <th><span class="text-secondary">Aksi</span></th>
                                    <th></th>
                                </tr>
                            </thead><!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>
                                <?php $__currentLoopData = $dokumen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-white">
                                        <td class="text-secondary"><?php echo e($loop->iteration); ?></td>
                                        <td class="text-secondary"><?php echo e(optional($p->user)->name ?? 'belum ada user'); ?></td>
                                        <td class="text-secondary"><?php echo e($p->keterangan); ?></td>
                                        <td class="text-secondary"><?php echo e($p->keterangan_dosen); ?></td>
                                        <td class="text-secondary"><?php echo e($p->dosen->nama); ?></td>
                                        <td class="text-secondary">
                                            <?php if($p->status == 'Proses'): ?>
                                                <span class="badge text-bg-warning">Proses</span>
                                            <?php elseif($p->status == 'Setuju'): ?>
                                                <span class="badge text-bg-success">Setuju</span>
                                            <?php elseif($p->status == 'Revisi'): ?>
                                                <span class="badge text-bg-danger">Revisi</span>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td class="text-secondary"><a href="<?php echo e(asset('storage/' . $p->file)); ?>"
                                                target="_blank">Lihat Dokumen</a></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editdokumen<?php echo e($p->id); ?>">Edit</button>
                                            
                                            <div class="modal fade " id="editdokumen<?php echo e($p->id); ?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-white">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-secondary">Edit dokumen</h5>
                                                            <button class="close" data-bs-dismiss="modal"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?php echo e(route('edit-dokumen', $p->id)); ?>"
                                                                method="post" enctype="multipart/form-data">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('put'); ?>
                                                                <div class="row mbn-15 mt-2">
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                            class="text-secondary">Pemilik Dokumen</label>
                                                                        <textarea class="form-control bg-secondary text-white" name="keterangan" placeholder="keterangan dokumen" required><?php echo e($p->keterangan); ?></textarea>
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for="status"
                                                                            class="form-label">Status</label>
                                                                        <select name="status"
                                                                            class="form-control bg-secondary text-white">
                                                                            <option value="Proses"
                                                                                <?php echo e($p->status == 'Proses' ? 'selected' : ''); ?>>
                                                                                Proses</option>
                                                                            <option value="Setuju"
                                                                                <?php echo e($p->status == 'Setuju' ? 'selected' : ''); ?>>
                                                                                Setuju</option>
                                                                            <option value="Revisi"
                                                                                <?php echo e($p->status == 'Revisi' ? 'selected' : ''); ?>>
                                                                                Revisi</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                            class="text-secondary">Dosen</label>
                                                                        <select
                                                                            class="form-control bg-secondary text-white"
                                                                            name="dosen_id" required>
                                                                            <option hidden>Pilih dosen</option>
                                                                            <?php $__currentLoopData = $dosen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($d->id); ?>"
                                                                                    <?php echo e($d->id == $p->dosen_id ? 'selected' : ''); ?>>
                                                                                    <?php echo e($d->nama); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                            class="text-secondary">Dokumen</label>
                                                                        <input type="file" name="file"
                                                                            id="file"
                                                                            class="form-control bg-secondary text-white">
                                                                        <?php if($p->file): ?>
                                                                            <p class="p-3 bg-secondary text-white">File
                                                                                saat ini: <a
                                                                                    href="<?php echo e(asset('storage/' . $p->file)); ?>"
                                                                                    target="_blank">Lihat Dokumen</a></p>
                                                                        <?php endif; ?>
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
                                                data-bs-target="#deletedokumen<?php echo e($p->id); ?>">Hapus</button>
                                            
                                            <div class="modal fade" id="deletedokumen<?php echo e($p->id); ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-white ">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">HAPUS dokumen</h5>
                                                            <button class="close" data-bs-dismiss="modal"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body text-secondary">
                                                            <p>Anda Yakin Ingin Menghapus dokumen Ini?</p>
                                                        </div>
                                                        <form action="<?php echo e(route('delete-dokumen', $p->id)); ?>"
                                                            method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('delete'); ?>
                                                            <div class="modal-footer">
                                                                <button type="button" class="button button-danger"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="button button-primary">Hapus</button>
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

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KERJAAN\joki-rpl\focus-ta\resources\views/dokumen/index.blade.php ENDPATH**/ ?>