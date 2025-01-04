@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-secondary font-monospace">DASHBOARD WEBSITE</h1>
        </div>
    </div>
    <div class="row">
        {{-- Daftar dosen --}}
        <div class="col-md-12 mb-30">
            <div class="box bg-white shadow ">
                <div class="box-head">
                    <h4 class="title text-secondary">Daftar dosen</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tambahdosen">Tambah</button>
                    {{-- modal tambah --}}
                    <div class="modal fade " id="tambahdosen">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-secondary">Tambah dosen</h5>
                                    <button class="close" data-bs-dismiss="modal"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('add-dosen') }}" method="post">
                                        @csrf
                                        @method('post')
                                        <div class="row mbn-15 mt-2">
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Nama</label>
                                                <input type="text" class="form-control bg-secondary text-white" name="nama" placeholder="Nama dosen" required>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Email</label>
                                                <input type="email" class="form-control bg-secondary text-white" name="email" placeholder="Email" required>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">nip</label>
                                                <input type="text" class="form-control bg-secondary text-white" name="nip" placeholder="nip dosen" required>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <select class="form-control bg-secondary text-white" name="fakultas_id" required>
                                                    <option class="" hidden>Pilih Fakultas</option>
                                                    @foreach ($fakultas as $f)
                                                        <option value="{{ $f->id }}">{{ $f->nama }}</option>
                                                    @endforeach
                                                </select>
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
                                    <th><span class="text-secondary">Nama</span></th>
                                    <th><span class="text-secondary">Nip</span></th>
                                    <th><span class="text-secondary">Fakultas</span></th>
                                    <th><span class="text-secondary">Aksi</span></th>
                                    <th></th>
                                </tr>
                            </thead><!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>
                                @foreach ($dosen as $dsn)
                                    <tr class="text-white">
                                        <td class="text-secondary">{{ $loop->iteration }}</td>
                                        <td class="text-secondary">{{ $dsn->nama }}</td>
                                        <td class="text-secondary">{{ $dsn->nip }}</td>
                                        <td class="text-secondary">{{$dsn->fakultas->nama}}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editdosen{{ $dsn->id }}">Edit</button>
                                            {{-- modal edit --}}
                                            <div class="modal fade " id="editdosen{{ $dsn->id }}">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-white">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-secondary">Edit dosen</h5>
                                                            <button class="close" data-bs-dismiss="modal"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('edit-dosen', $dsn->id) }}" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <div class="row mbn-15 mt-2">
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                            class="text-secondary">Nama</label>
                                                                        <input type="text"
                                                                            class="form-control bg-secondary text-white"
                                                                            name="nama" placeholder="Nama dosen" required
                                                                            value="{{ old('nama', $dsn->nama) }}">
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                        class="text-secondary">Email</label>
                                                                        <input type="email" class="form-control bg-secondary text-white" name="email" placeholder="Email Mahasiswa" required value="{{ old('email', $dsn->email) }}">
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                        class="text-secondary">Nip</label>
                                                                        <input type="text" class="form-control bg-secondary text-white" name="nip" placeholder="nip dosen" required value="{{ old('nip', $dsn->nip) }}">
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                        class="text-secondary">Fakultas</label>
                                                                        <select class="form-control bg-secondary text-white" name="fakultas_id" required>
                                                                            <option hidden>Pilih Fakultas</option>
                                                                            @foreach ($fakultas as $f)
                                                                                <option value="{{ $f->id }}" {{ $f->id == $dsn->fakultas_id ? 'selected' : '' }}>{{ $f->nama }}</option>
                                                                            @endforeach
                                                                        </select>
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
                                                data-bs-target="#deletedosen{{ $dsn->id }}">Hapus</button>
                                            {{-- modal hapus --}}
                                            <div class="modal fade" id="deletedosen{{ $dsn->id }}">
                                                <div class="modal-dialog">
                                                <div class="modal-content bg-white ">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">HAPUS dosen</h5>
                                                        <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body text-secondary">
                                                        <p>Anda Yakin Ingin Menghapus dosen Ini?</p>
                                                    </div>
                                                    <form action="{{ route('delete-dosen', $dsn->id) }}" method="post">
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
