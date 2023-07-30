@extends('Pengguna.Partials.index')
@section('container')
    <section id="faq" class="faq">
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="container" data-aos="fade-up">
            <div class="row gy-4 ">
                <div class="col-lg-4">
                    <div class="content px-xl-5">
                        <h5>Jawablah <strong>Pertanyaan</strong> disamping</h5>
                        <p>
                        <div class="card " style="width: 18rem; hight: 30rem; ">
                            <div class="card-body">
                                <h5 class="card-header mb-3">Data diri</h5>

                                <div class="row">
                                    <div class="col-md-4">Nama :
                                    </div>
                                    <div class="col-md-8"> {{ $user_name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">Umur :
                                    </div>
                                    <div class="col-md-8"> {{ $user_age }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4"> Alamat :
                                    </div>
                                    <div class="col-md-8"> {{ $user_address }}
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
                            <div class="card text-center shadow p-3 mb-5 bg-body rounded ">

                                <div class="card-body">
                                    <form method="POST" action="/Pengguna/Diagnosa/Hasil">
                                        @csrf
                                        <h3 class=" m-3 p-3">Apakah anda merasakan {{ $gejala->nama_gejala }} ?</h3>
                                        <input type="hidden" id="id_gejala" name="id_gejala" value="{{ $gejala->id }}">

                                        <button name="answer" value="1" class="btn btn-secondary  col-md-2 mb-2">Ya</button>
                                        <button name="answer" value="0" class="btn btn-secondary col-md-2 mb-2">Tidak</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div><!-- # Faq item-->
                </div>

            </div>

        </div>

    </section><!-- End Frequently Asked Questions Section -->
@endsection
