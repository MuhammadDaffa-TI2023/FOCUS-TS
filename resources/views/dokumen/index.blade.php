@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-secondary font-monospace">DASHBOARD WEBSITE</h1>
        </div>
    </div>
    <div class="row">
        {{-- Daftar dokumen --}}
        <div class="col-md-12 mb-30">
            <div class="box bg-white shadow ">
                <div class="box-head">
                    <h4 class="title text-secondary">Daftar dokumen</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tambahdokumen">Tambah</button>
                    {{-- modal tambah --}}
                    <div class="modal fade " id="tambahdokumen">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-secondary">Tambah dokumen</h5>
                                    <button class="close" data-bs-dismiss="modal"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('add-dokumen') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
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
                                                    @foreach ($dosen as $d)
                                                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                                    @endforeach
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
                                @foreach ($dokumen as $p)
                                    <tr class="text-white">
                                        <td class="text-secondary">{{ $loop->iteration }}</td>
                                        <td class="text-secondary">{{ optional($p->user)->name ?? 'belum ada user' }}</td>
                                        <td class="text-secondary">{{ $p->keterangan }}</td>
                                        <td class="text-secondary">{{ $p->keterangan_dosen }}</td>
                                        <td class="text-secondary">{{ $p->dosen->nama }}</td>
                                        <td class="text-secondary">
                                            @if ($p->status == 'Proses')
                                                <span class="badge text-bg-warning">Proses</span>
                                            @elseif($p->status == 'Setuju')
                                                <span class="badge text-bg-success">Setuju</span>
                                            @elseif($p->status == 'Revisi')
                                                <span class="badge text-bg-danger">Revisi</span>
                                            @endif
                                        </td>
                                        {{-- {{ dd($p->file) }} --}}
                                        <td class="text-secondary"><a href="{{ asset('storage/' . $p->file) }}"
                                                target="_blank">Lihat Dokumen</a></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editdokumen{{ $p->id }}">Edit</button>
                                            {{-- modal edit --}}
                                            <div class="modal fade " id="editdokumen{{ $p->id }}">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-white">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-secondary">Edit dokumen</h5>
                                                            <button class="close" data-bs-dismiss="modal"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('edit-dokumen', $p->id) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('put')
                                                                <div class="row mbn-15 mt-2">
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                            class="text-secondary">Pemilik Dokumen</label>
                                                                        <textarea class="form-control bg-secondary text-white" name="keterangan" placeholder="keterangan dokumen" required>{{ $p->keterangan }}</textarea>
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for="status"
                                                                            class="form-label">Status</label>
                                                                        <select name="status"
                                                                            class="form-control bg-secondary text-white">
                                                                            <option value="Proses"
                                                                                {{ $p->status == 'Proses' ? 'selected' : '' }}>
                                                                                Proses</option>
                                                                            <option value="Setuju"
                                                                                {{ $p->status == 'Setuju' ? 'selected' : '' }}>
                                                                                Setuju</option>
                                                                            <option value="Revisi"
                                                                                {{ $p->status == 'Revisi' ? 'selected' : '' }}>
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
                                                                            @foreach ($dosen as $d)
                                                                                <option value="{{ $d->id }}"
                                                                                    {{ $d->id == $p->dosen_id ? 'selected' : '' }}>
                                                                                    {{ $d->nama }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                            class="text-secondary">Dokumen</label>
                                                                        <input type="file" name="file"
                                                                            id="file"
                                                                            class="form-control bg-secondary text-white">
                                                                        @if ($p->file)
                                                                            <p class="p-3 bg-secondary text-white">File
                                                                                saat ini: <a
                                                                                    href="{{ asset('storage/' . $p->file) }}"
                                                                                    target="_blank">Lihat Dokumen</a></p>
                                                                        @endif
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
                                                data-bs-target="#deletedokumen{{ $p->id }}">Hapus</button>
                                            {{-- modal hapus --}}
                                            <div class="modal fade" id="deletedokumen{{ $p->id }}">
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
                                                        <form action="{{ route('delete-dokumen', $p->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
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
                                @endforeach
                            </tbody><!-- Table Body End -->

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
