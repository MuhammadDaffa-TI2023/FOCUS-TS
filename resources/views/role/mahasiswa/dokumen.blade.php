@extends('role.layout.app')
@section('content')
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
                {{-- modal tambah --}}
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
                                <form action="{{ route('add-dokumen-mhs') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <div class="row mbn-15 mt-2">
                                        <div class="col-12 mb-15">
                                            <label for="" class="text-secondary">Keterangan Dokumen</label>
                                            <textarea class="form-control bg-secondary text-white" name="keterangan" placeholder="keterangan dokumen" required></textarea>
                                        </div>
                                        <div class="col-12 mb-15">
                                            <label for="" class="text-secondary">dosen</label>
                                            <select class="form-control bg-secondary text-white" name="dosen_id" required>
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
                                        @role('admin|dosen')
                                            <div class="col-12 mb-15">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" class="form-control bg-secondary text-white">
                                                    <option value="Proses" selected>Proses</option>
                                                    <option value="Setuju">Setuju</option>
                                                    <option value="Revisi">Revisi</option>
                                                </select>
                                            </div>
                                        @endrole
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
                        @foreach ($dokumen as $d)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $d->user->name }}</td>
                                <td>{{ $d->keterangan }}</td>
                                <td>{{ $d->keterangan_dosen }}</td>
                                <td>
                                    @if ($d->status == 'Proses')
                                        <span class="badge text-bg-warning">Proses</span>
                                    @elseif($d->status == 'Setuju')
                                        <span class="badge text-bg-success">Setuju</span>
                                    @elseif($d->status == 'Revisi')
                                        <span class="badge text-bg-danger">Revisi</span>
                                    @endif
                                </td>
                                <td><a href="{{ asset('storage/' . $d->file) }}" target="_blank">Lihat Dokumen</a></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editdokumen{{ $d->id }}">Edit</button>
                                    {{-- modal edit --}}
                                    <div class="modal fade " id="editdokumen{{ $d->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-secondary">Edit dokumen</h5>
                                                    <button class="btn btn-close" data-bs-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('edit-dokumen-mhs', $d->id) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row mbn-15 mt-2">
                                                            <div class="col-12 mb-15">
                                                                <label for="" class="text-secondary">Keterangan Dokumen</label>
                                                                <textarea class="form-control bg-secondary text-white" name="keterangan" placeholder="keterangan dokumen" required
                                                                  >{{$d->keterangan }}</textarea>
                                                            </div>
                                                            <div class="col-12 mb-15">
                                                                <label for=""
                                                                class="text-secondary">Dosen</label>
                                                                <select class="form-control bg-secondary text-white" name="dosen_id" required>
                                                                    <option hidden>Pilih dosen</option>
                                                                    @foreach ($dosen as $dsn)
                                                                        <option value="{{ $dsn->id }}" {{ $dsn->id == $d->dosen_id ? 'selected' : '' }}>{{ $dsn->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-12 mb-15">
                                                                <label for=""
                                                                    class="text-secondary">Dokumen</label>
                                                                    <input type="file" name="file" id="file" class="form-control bg-secondary text-white">
                                                                    @if ($d->file)
                                                                        <p class="p-3 bg-secondary text-white">File saat ini: <a href="{{ asset('storage/' . $d->file) }}" target="_blank">Lihat Dokumen</a></p>
                                                                    @endif
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
                                        data-bs-target="#deletedokumen{{ $d->id }}">Hapus</button>
                                    {{-- modal hapus --}}
                                    <div class="modal fade" id="deletedokumen{{ $d->id }}">
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
                                                <form action="{{ route('delete-dokumen-mhs', $d->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
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
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
@endsection
