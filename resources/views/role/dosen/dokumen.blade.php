@extends('role.layout.app')
@section('content')
    <div class="row gy-4">
        <h1>Daftar Dokumen</h1>
    </div>

    <div class="row gy-4">
        <div class="table-responsive">
            <table class="table table-striped">
                
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Keterangan Mahasiswa</th>
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
                                        data-bs-target="#editdokumen{{ $d->id }}">Beri Feedback</button>
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
                                                    <form action="{{ route('edit-dokumen-dosen', $d->id) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row mbn-15 mt-2">
                                                            <div class="col-12 mb-15">
                                                                <label for="" class="text-secondary">Keterangan Dosen</label>
                                                                <textarea class="form-control bg-secondary text-white" name="keterangan_dosen" 
                                                                >{{ old('keterangan_dosen', $d->keterangan_dosen) }}
                                                                </textarea>
                                                            </div>
                                                            <div class="col-12 mb-15">
                                                                <label for="status" class="text-secondary">Status</label>
                                                                <select name="status" class="form-control bg-secondary text-white">
                                                                    <option value="Proses" {{ $d->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                                                    <option value="Setuju" {{ $d->status == 'Setuju' ? 'selected' : '' }}>Setuju</option>
                                                                    <option value="Revisi" {{ $d->status == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                                                                </select>
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
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
            </table>
        </div>
    </div>
@endsection
