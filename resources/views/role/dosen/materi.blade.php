@extends('role.layout.app')
@section('content')
    <div class="row gy-4">
        <h1>Daftar Materi</h1>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahdokumen">
                Tambah Dokumen Materi
            </button>
            {{-- modal tambah --}}
            <div class="modal fade" id="tambahdokumen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Dokumen</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('add-materi-dosen') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('post')
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
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                            @endforeach
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
                    @foreach ($materi as $m)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $m->nama }}</td>
                            <td>{{ $m->kategori->nama }}</td>
                            <td>
                                @foreach ($m->user->getRoleNames() as $role)
                                    {{ ucfirst($role) }}
                                @endforeach
                            </td>
                            <td>{{ $m->tanggal }}</td>
                            <td><a href="{{ asset('storage/' . $m->file) }}" target="_blank">Lihat Materi</a></td>
                            <td>
                                @if ($m->user_id === Auth::id())
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editdokumen{{ $m->id }}">Edit</button>
                                @endif
                                {{-- modal edit --}}
                                <div class="modal fade " id="editdokumen{{ $m->id }}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-secondary">Edit dokumen</h5>
                                                <button class="btn btn-close" data-bs-dismiss="modal"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('edit-materi-dosen', $m->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="row mbn-15 mt-2">
                                                        <div class="col-12 mb-15">
                                                            <label for="" class="text-secondary">Nama Materi</label>
                                                            <input type="text" 
                                                            class="form-control bg-secondary text-white" 
                                                            name="nama" 
                                                            value="{{old('nama', $m->nama)}}"
                                                            placeholder="Nama Materi" 
                                                            required>
                                                        </div>
                                                        <div class="col-12 mb-15">
                                                            <label for="" class="text-secondary">Kategori</label>
                                                            <select class="form-control bg-secondary text-white"
                                                                name="kategori_id" required>
                                                                <option hidden>Pilih kategori</option>
                                                                @foreach ($kategori as $k)
                                                                    <option value="{{ $k->id }}"
                                                                        {{ $k->id == $m->kategori_id ? 'selected' : '' }}>
                                                                        {{ $k->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-12 mb-15">
                                                            <label for="" class="text-secondary">Dokumen</label>
                                                            <input type="file" name="file" id="file"
                                                                class="form-control bg-secondary text-white">
                                                            @if ($m->file)
                                                                <p class="p-3 bg-secondary text-white">File saat ini: <a
                                                                        href="{{ asset('storage/' . $m->file) }}"
                                                                        target="_blank">Lihat Dokumen</a></p>
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
                                @if ($m->user_id === Auth::id())
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletedokumen{{ $m->id }}">
                                        Hapus
                                    </button>
                                    {{-- modal hapus --}}
                                    <div class="modal fade" id="deletedokumen{{ $m->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Hapus dokumen</h5>
                                                    <button class="btn btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body text-secondary">
                                                    <p>Anda yakin ingin menghapus dokumen ini?</p>
                                                </div>
                                                <form action="{{ route('delete-materi-dosen', $m->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
