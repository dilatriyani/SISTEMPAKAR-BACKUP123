@extends('Pengguna.Partials.index')
@section('container')

<section id="services" class="services sections-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>Informasi Penyakit</h2>
        <p>Aperiam dolorum et et wuia molestias qui eveniet numquam nihil porro incidunt dolores placeat sunt id nobis omnis tiledo stran delop</p>
      </div>

      <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
        @forelse($artikels as $artikel)
        <div class="col-lg-4 col-md-6">
          <div class="service-item  position-relative">
            <div class="">
              <img src="{{ asset('storage/'.$artikel['image']) }}" alt="image" width="50px">
            </div><br>
            <h3>{{ $artikel['judul'] }}</h3>
            <a href="/Pengguna/Layouts/detail/{{ $artikel['id'] }}" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <!-- End Service Item -->
        @empty
          <p>Data Kosong</p>
        @endforelse

        <!-- End Service Item -->
      </div>

    </div>
  </section><!-- End Our Services Section -->

@endsection
