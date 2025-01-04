<img src="{{ asset('assets2/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

<div class="container">
    <h1 data-aos="fade-up" data-aos-delay="100">
        Selamat Datang, {{ Auth::user()->name ?? 'Tamu' }}
    </h1>
    <p class="fs-5">Semangat, Waktunya Bimbingan Tugas Akhir!</p>
</div>
