@extends('role.layout.app')
@section('content')
    <div class="row gy-4">
        <h1>Daftar Janji Temu</h1>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahjanjitemu">
                Buat Janji Temu
            </button>
        </div>
    </div>

    <div class="row gy-4">
        <div class="table-responsive">
            <table class="table table-striped">
                {{-- modal tambah --}}
                <div class="modal fade" id="tambahjanjitemu" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Janji Temu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('add-janjitemu-mhs') }}" method="post">
                                    @csrf
                                    @method('post')
                                    <div class="row mbn-15 mt-2">
                                        <!-- Input Tanggal -->
                                        <div class="col-12 mb-15">
                                            <label for="tanggal" class="text-secondary">Tanggal</label>
                                            <input type="date" class="form-control bg-secondary text-white"
                                                name="tanggal" required>
                                        </div>

                                        <!-- Input Jam -->
                                        <div class="col-12 mb-15">
                                            <label for="jam" class="text-secondary">Jam</label>
                                            <input type="time" class="form-control bg-secondary text-white"
                                                name="jam" required>
                                        </div>

                                        <!-- Pilihan Dosen -->
                                        <div class="col-12 mb-15">
                                            <label for="dosen" class="text-secondary">Dosen</label>
                                            <select class="form-control bg-secondary text-white" name="dosen_id" required>
                                                <option hidden>Pilih Dosen</option>
                                                @foreach ($dosen as $d)
                                                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <input type="hidden" name="mahasiswa_id">

                                        <input type="hidden" name="status" value="Proses">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Mahasiswa</th>
                            <th scope="col">Dosen</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($janjitemu as $janji)
                            <tr>
                                <td class="text-secondary">{{ $loop->iteration }}</td>
                                <td class="text-secondary">{{ $janji->jam }} {{ $janji->tanggal }}</td>
                                <td class="text-secondary">{{ $janji->mahasiswa->nama }}</td>
                                <td class="text-secondary">{{ $janji->dosen->nama }}</td>
                                <td>
                                    @if ($janji->status == 'Proses')
                                        <span class="badge text-bg-warning">Proses</span>
                                    @elseif($janji->status == 'Setuju')
                                        <span class="badge text-bg-success">Setuju</span>
                                    @elseif($janji->status == 'Tolak')
                                        <span class="badge text-bg-danger">Tolak</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editjanji{{ $janji->id }}">Edit</button>
                                    {{-- modal edit --}}
                                    <div class="modal fade" id="editjanji{{ $janji->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-secondary">Edit Janji Temu</h5>
                                                    <button class="btn btn-close" data-bs-dismiss="modal">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('edit-janjitemu-mhs', $janji->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row mbn-15 mt-2">
                                                            <!-- Input Tanggal -->
                                                            <div class="col-12 mb-15">
                                                                <label for="tanggal" class="text-secondary">Tanggal</label>
                                                                <input type="date"
                                                                    class="form-control bg-secondary text-white"
                                                                    name="tanggal" required
                                                                    value="{{ old('tanggal', $janji->tanggal) }}">
                                                            </div>

                                                            <!-- Input Jam -->
                                                            <div class="col-12 mb-15">
                                                                <label for="jam" class="text-secondary">Jam</label>
                                                                <input type="time"
                                                                    class="form-control bg-secondary text-white"
                                                                    name="jam" required
                                                                    value="{{ old('jam', $janji->jam) }}">
                                                            </div>

                                                            <!-- Pilih Dosen -->
                                                            <div class="col-12 mb-15">
                                                                <label for="dosen" class="text-secondary">Dosen</label>
                                                                <select class="form-control bg-secondary text-white"
                                                                    name="dosen_id" required>
                                                                    <option hidden>Pilih Dosen</option>
                                                                    @foreach ($dosen as $d)
                                                                        <option value="{{ $d->id }}"
                                                                            {{ $janji->dosen_id == $d->id ? 'selected' : '' }}>
                                                                            {{ $d->nama }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <!-- Mahasiswa ID (Disembunyikan, otomatis diambil) -->
                                                            <input type="hidden" name="mahasiswa_id">

                                                            <!-- Status (Disembunyikan jika mahasiswa tidak boleh mengedit status) -->
                                                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'dosen')
                                                                <div class="col-12 mb-15">
                                                                    <label for="status"
                                                                        class="text-secondary">Status</label>
                                                                    <select class="form-control bg-secondary text-white"
                                                                        name="status" required>
                                                                        <option hidden>Pilih Status</option>
                                                                        <option value="Proses"
                                                                            {{ $janji->status == 'Proses' ? 'selected' : '' }}>
                                                                            Proses</option>
                                                                        <option value="Setuju"
                                                                            {{ $janji->status == 'Setuju' ? 'selected' : '' }}>
                                                                            Setuju</option>
                                                                        <option value="Tolak"
                                                                            {{ $janji->status == 'Tolak' ? 'selected' : '' }}>
                                                                            Tolak</option>
                                                                    </select>
                                                                </div>
                                                            @else
                                                                <input type="hidden" name="status"
                                                                    value="{{ $janji->status }}">
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deletejanjitemu{{ $janji->id }}">Hapus</button>
                                    {{-- modal hapus --}}
                                    <div class="modal fade" id="deletejanjitemu{{ $janji->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-white ">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">HAPUS JANJI TEMU</h5>
                                                    <button class="btn btn-close" data-bs-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body text-secondary">
                                                    <p>Anda Yakin Ingin Menghapus janjitemu Ini?</p>
                                                </div>
                                                <form action="{{ route('delete-janjitemu-mhs', $janji->id) }}"
                                                    method="post">
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
