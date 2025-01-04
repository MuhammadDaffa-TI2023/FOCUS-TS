@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-secondary font-monospace">Data User</h1>
        </div>
    </div>
    <div class="row">
        {{-- Daftar user --}}
        <div class="col-md-12 mb-30">
            <div class="box bg-white shadow ">
                <div class="box-head d-flex justify-content-between align-items-center">
                    <h4 class="title text-secondary">Daftar User</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahuser">Tambah Data</button>
                </div>
                {{-- Modal Tambah --}}
                <div class="modal fade" id="tambahuser">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content bg-white">
                            <div class="modal-header">
                                <h5 class="modal-title text-secondary">Tambah User</h5>
                                <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('add-user') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label text-secondary">Username</label>
                                        <input type="text" class="form-control bg-secondary text-white" id="username" name="username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label text-secondary">Email</label>
                                        <input type="email" class="form-control bg-secondary text-white" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label text-secondary">Password</label>
                                        <input type="password" class="form-control bg-secondary text-white" id="password" name="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label text-secondary">Role</label>
                                        <select class="form-control bg-secondary text-white" name="role[]" required>
                                            <option hidden>Pilih Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="mahasiswa">Mahasiswa</option>
                                            <option value="mentor">Mentor</option>
                                            <option value="dosen">Dosen</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Table --}}
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-vertical-middle table-selectable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            @foreach ($user->getRoleNames() as $role)
                                              {{ ucfirst($role) }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editUser{{ $user->id }}">Edit</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteUser{{ $user->id }}">Hapus</button>
                                        </td>
                                    </tr>

                                    {{-- Modal Edit --}}
                                    <div class="modal fade" id="editUser{{ $user->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-secondary">Edit User</h5>
                                                    <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('edit-user', $user->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label text-secondary">Username</label>
                                                            <input type="text" class="form-control bg-secondary text-white" name="username" value="{{ old('name', $user->name) }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label text-secondary">Email</label>
                                                            <input type="email" class="form-control bg-secondary text-white" name="email" value="{{ $user->email }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label text-secondary">Password</label>
                                                            <input type="password" class="form-control bg-secondary text-white" name="password" value="{{ $user->password }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="role" class="form-label text-secondary">Role</label>
                                                            <select class="form-control bg-secondary text-white" name="role[]" required>
                                                                <option value="admin" {{ in_array('admin', $user->getRoleNames()->toArray()) ? 'selected' : '' }}>Admin</option>
                                                                <option value="mahasiswa" {{ in_array('mahasiswa', $user->getRoleNames()->toArray()) ? 'selected' : '' }}>Mahasiswa</option>
                                                                <option value="mentor" {{ in_array('mentor', $user->getRoleNames()->toArray()) ? 'selected' : '' }}>Mentor</option>
                                                                <option value="dosen" {{ in_array('dosen', $user->getRoleNames()->toArray()) ? 'selected' : '' }}>Dosen</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal Hapus --}}
                                    <div class="modal fade" id="deleteUser{{ $user->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger">Hapus User</h5>
                                                    <button class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus user ini?</p>
                                                </div>
                                                <form action="{{ route('delete-user', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
