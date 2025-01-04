@extends('role.layout.app')
@section('content')
<div class="row gy-4">
    <h1>Daftar Materi</h1>
    <div class="col-md-4">
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection