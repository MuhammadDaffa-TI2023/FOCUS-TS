<ul>
    @role('mahasiswa')
    <li><a href="{{route('mahasiswa')}}">Home<br></a></li>
    <li><a href="{{route('mahasiswa-dokumen')}}">Dokumen</a></li>
    <li><a href="{{route('mahasiswa-janjitemu')}}">Janji Temu</a></li>
    <li><a href="{{route('mahasiswa-materi')}}">Materi</a></li>
    @endrole
    @role('dosen')
    <li><a href="{{route('dosen')}}">Home<br></a></li>
    <li><a href="{{route('dosen-dokumen')}}">Dokumen</a></li>
    <li><a href="{{route('dosen-janjitemu')}}">Janji Temu</a></li>
    <li><a href="{{route('dosen-materi')}}">Materi</a></li>
    @endrole
    @role('mentor')
    <li><a href="{{route('mentor')}}">Home<br></a></li>
    <li><a href="{{route('mentor-materi')}}">materi</a></li>
    @endrole
    <li>
      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-link" style=" border: none; background: none; color: black; cursor: pointer; text-decoration: none;">
              {{ __('Log Out') }}
          </button>
      </form>
  </li>
  </ul>