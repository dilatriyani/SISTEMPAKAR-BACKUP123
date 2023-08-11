@extends('Pengguna.Partials.index')
@section('container')

    <body>
        <section id="faq" class="faq">
            <div class="container" data-aos="fade-up">
                <h3 class="text-center"><b>HASIL DIAGNOSA</b>
                    <hr>
                </h3>
                <div class="row gy-4 ">
                    <div class="col-lg-4">
                        <div class="content px-xl-5">
                            <div class="card mt-5" style="width: 18rem; hight: 30rem; ">
                                <div class="card-body">
                                    <h5 class="card-header mt-3 mb-3">Data diri</h5>

                                    <div class="row mb-2 mt-2">
                                        <div class="col-md-4">Nama :
                                        </div>
                                        <div class="col-md-8"> {{ $name }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">Umur :
                                        </div>
                                        <div class="col-md-8"> {{ $age }}
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-4"> Alamat :
                                        </div>
                                        <div class="col-md-8"> {{ $address }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="accordion accordion-flush" id="faqlist" data-aos="fade-up" data-aos-delay="100">
                            <div
                                class="col-lg-12 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                                <div class="card shadow p-3 mb-5 bg-body rounded mt-5">
                                    <div class="card-body">
                                        <div class="card-header">Hasil </div>
                                        <div class="row mb-3 mt-3">
                                            <div class="col-md-2">
                                                Penyakit
                                            </div>
                                            <div class="col-md-10">
                                                : {{ $penyakit->nama_penyakit }}, dengan kemungkinan {{ $score }} %
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Deskripsi Penyakit
                                            </div>
                                            <div class="col-md-10">
                                                : {{ $penyakit->deskripsi }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Gejala yang dialami :
                                            </div>
                                            <div class="col-md-10">
                                                @foreach ($gejala_list as $gejala)
                                                <p> - {{ $gejala }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Solusi
                                            </div>
                                            <div class="col-md-10">
                                                : {{ $penyakit->solusi }}
                                            </div>
                                        </div>
                                        <div class="mt-5 ">
                                          <a href="/" class="p-1"><button type="button " class="btn btn-secondary ">Konsultasi Lagi</button></a>
                                          <a><button id="printButton" type="button" class="btn btn-secondary">Cetak</button></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div><!-- # Faq item-->
                    </div>
                </div>

            </div>

        </section><!-- End Frequently Asked Questions Section -->
    </body>

    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            window.print();
        });
    </script>

@endsection
