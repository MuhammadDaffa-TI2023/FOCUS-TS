@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-secondary font-monospace">DASHBOARD WEBSITE</h1>
        </div>
    </div>
    <div class="row">
        {{-- Daftar materi --}}
        <div class="col-md-12 mb-30">
            <div class="box bg-white shadow ">
                <div class="box-head">
                    <h4 class="title text-secondary">Daftar materi</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tambahmateri">Tambah</button>
                    {{-- modal tambah --}}
                    <div class="modal fade " id="tambahmateri">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-secondary">Tambah materi</h5>
                                    <button class="close" data-bs-dismiss="modal"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('add-materi') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <div class="row mbn-15 mt-2">
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Nama materi</label>
                                                <textarea class="form-control bg-secondary text-white" name="nama" placeholder="nama materi" required></textarea>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Kategori Materi</label>
                                                <select class="form-control bg-secondary text-white" name="kategori_id" required>
                                                    <option class="" hidden>Pilih Kategori</option>
                                                    @foreach ($kategori as $k)
                                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="formFile" class="form-label">Materi (Gambar/Docx/Pdf)</label>
                                                <input name="file" class="form-control  bg-secondary text-white" type="file" id="formFile" accept=".jpg,.jpeg,.png,.pdf,.docx">
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
                                    <th><span class="text-secondary">Nama Materi</span></th>
                                    <th><span class="text-secondary">Kategori</span></th>
                                    <th><span class="text-secondary">Pengunggah</span></th>
                                    <th><span class="text-secondary">Tanggal Unggah</span></th>
                                    <th><span class="text-secondary">Materi</span></th>
                                    <th><span class="text-secondary">Aksi</span></th>
                                    <th></th>
                                </tr>
                            </thead><!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>
                                @foreach ($materi as $m)
                                    <tr class="text-white">
                                        <td class="text-secondary">{{ $loop->iteration }}</td>
                                        <td class="text-secondary">{{ $m->nama }}</td>
                                        <td class="text-secondary">{{ $m->kategori->nama }}</td>
                                        <td class="text-secondary">
                                            @foreach ($m->user->getRoleNames() as $role)
                                            {{ ucfirst($role) }}
                                            @endforeach
                                        </td>
                                        <td class="text-secondary">{{ $m->tanggal }}</td>
                                        <td class="text-secondary"><a href="{{ asset('storage/' . $m->file) }}" target="_blank">Lihat Materi</a></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editmateri{{ $m->id }}">Edit</button>
                                            {{-- modal edit --}}
                                            <div class="modal fade " id="editmateri{{ $m->id }}">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-white">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-secondary">Edit materi</h5>
                                                            <button class="close" data-bs-dismiss="modal"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('edit-materi', $m->id) }}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('put')
                                                                <div class="row mbn-15 mt-2">
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                            class="text-secondary">Nama Materi</label>
                                                                        <input type="text"
                                                                            class="form-control bg-secondary text-white"
                                                                            name="nama" placeholder="Nama mahasiswa" required
                                                                            value="{{ old('nama', $m->nama) }}">
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                        class="text-secondary">kategori</label>
                                                                        <select class="form-control bg-secondary text-white" name="kategori_id" required>
                                                                            <option hidden>Pilih kategori</option>
                                                                            @foreach ($kategori as $k)
                                                                                <option value="{{ $k->id }}" {{ $k->id == $m->kategori_id ? 'selected' : '' }}>{{ $k->nama }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                            class="text-secondary">materi</label>
                                                                            <input type="file" name="file" id="file" class="form-control bg-secondary text-white">
                                                                            @if ($m->file)
                                                                                <p class="p-3 bg-secondary text-white">File saat ini: <a href="{{ asset('storage/' . $m->file) }}" target="_blank">Lihat materi</a></p>
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
                                                data-bs-target="#deletemateri{{ $m->id }}">Hapus</button>
                                            {{-- modal hapus --}}
                                            <div class="modal fade" id="deletemateri{{ $m->id }}">
                                                <div class="modal-dialog">
                                                <div class="modal-content bg-white ">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">HAPUS materi</h5>
                                                        <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body text-secondary">
                                                        <p>Anda Yakin Ingin Menghapus materi Ini?</p>
                                                    </div>
                                                    <form action="{{ route('delete-materi', $m->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
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
                                @endforeach
                            </tbody><!-- Table Body End -->

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
