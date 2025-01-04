@extends('role.layout.app')
@section('content')
    <div class="row gy-4">
        <h1>Daftar Janji Temu</h1>
    </div>

    <div class="row gy-4">
        <div class="table-responsive">
            <table class="table table-striped">
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
                                    {{-- Modal Edit --}}
                                    <div class="modal fade" id="editjanji{{ $janji->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-secondary">Edit Status Janji Temu</h5>
                                                    <button class="btn btn-close" data-bs-dismiss="modal">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('edit-janjitemu-dosen', $janji->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <!-- Status -->
                                                        <div class="col-12 mb-15">
                                                            <label for="status" class="text-secondary">Status</label>
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
