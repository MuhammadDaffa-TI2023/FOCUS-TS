@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-secondary font-monospace">DASHBOARD WEBSITE</h1>
        </div>
    </div>
    <div class="row">
        {{-- Daftar mahasiswa --}}
        <div class="col-md-12 mb-30">
            <div class="box bg-white shadow ">
                <div class="box-head">
                    <h4 class="title text-secondary">Daftar mahasiswa</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tambahmahasiswa">Tambah</button>
                    {{-- modal tambah --}}
                    <div class="modal fade " id="tambahmahasiswa">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-secondary">Tambah mahasiswa</h5>
                                    <button class="close" data-bs-dismiss="modal"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('add-mahasiswa') }}" method="post">
                                        @csrf
                                        @method('post')
                                        <div class="row mbn-15 mt-2">
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Nama</label>
                                                <input type="text" class="form-control bg-secondary text-white" name="nama" placeholder="Nama mahasiswa" required>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Nim</label>
                                                <input type="text" class="form-control bg-secondary text-white" name="nim" placeholder="Nim mahasiswa" required>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Email</label>
                                                <input type="email" class="form-control bg-secondary text-white" name="email" placeholder="Email" required>
                                            </div>
                                            <div class="col-12 mb-15">
                                                <label for="" class="text-secondary">Prodi</label>
                                                <select class="form-control bg-secondary text-white" name="prodi_id" required>
                                                    <option class="" hidden>Pilih Prodi</option>
                                                    @foreach ($prodi as $p)
                                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
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
                                    <th><span class="text-secondary">Nim</span></th>
                                    <th><span class="text-secondary">Prodi</span></th>
                                    <th><span class="text-secondary">Aksi</span></th>
                                    <th></th>
                                </tr>
                            </thead><!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>
                                @foreach ($mahasiswa as $mhs)
                                    <tr class="text-white">
                                        <td class="text-secondary">{{ $loop->iteration }}</td>
                                        <td class="text-secondary">{{ $mhs->nama }}</td>
                                        <td class="text-secondary">{{ $mhs->nim }}</td>
                                        <td class="text-secondary">{{$mhs->prodi->nama}}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editmahasiswa{{ $mhs->id }}">Edit</button>
                                            {{-- modal edit --}}
                                            <div class="modal fade " id="editmahasiswa{{ $mhs->id }}">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-white">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-secondary">Edit mahasiswa</h5>
                                                            <button class="close" data-bs-dismiss="modal"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('edit-mahasiswa', $mhs->id) }}" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <div class="row mbn-15 mt-2">
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                            class="text-secondary">Nama</label>
                                                                        <input type="text"
                                                                            class="form-control bg-secondary text-white"
                                                                            name="nama" placeholder="Nama mahasiswa" required
                                                                            value="{{ old('nama', $mhs->nama) }}">
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                        class="text-secondary">Nim</label>
                                                                        <input type="text" class="form-control bg-secondary text-white" name="nim" placeholder="NIM Mahasiswa" required value="{{ old('nim', $mhs->nim) }}">
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                        class="text-secondary">Email</label>
                                                                        <input type="email" class="form-control bg-secondary text-white" name="email" placeholder="Email Mahasiswa" required value="{{ old('email', $mhs->email) }}">
                                                                    </div>
                                                                    <div class="col-12 mb-15">
                                                                        <label for=""
                                                                        class="text-secondary">Prodi</label>
                                                                        <select class="form-control bg-secondary text-white" name="prodi_id" required>
                                                                            <option hidden>Pilih Prodi</option>
                                                                            @foreach ($prodi as $p)
                                                                                <option value="{{ $p->id }}" {{ $p->id == $mhs->prodi_id ? 'selected' : '' }}>{{ $p->nama }}</option>
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
                                                data-bs-target="#deletemahasiswa{{ $mhs->id }}">Hapus</button>
                                            {{-- modal hapus --}}
                                            <div class="modal fade" id="deletemahasiswa{{ $mhs->id }}">
                                                <div class="modal-dialog">
                                                <div class="modal-content bg-white ">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">HAPUS mahasiswa</h5>
                                                        <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body text-secondary">
                                                        <p>Anda Yakin Ingin Menghapus mahasiswa Ini?</p>
                                                    </div>
                                                    <form action="{{ route('delete-mahasiswa', $mhs->id) }}" method="post">
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
