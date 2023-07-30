@extends('Admin.Partials.index')
@section('container')
    <main id="main" class="main">
        <div>
            <h1>Data Rules</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Rules</a></li>
                    <li class="breadcrumb-item active">Data Rules</li>
                </ol>
            </nav>

            <div class="p-2 ">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalTambah"> + Tambah</button>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Penyakit</th>
                        <th>Kode Gejala</th>
                        <!-- Tambahkan kolom untuk field lainnya sesuai kebutuhan -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rules as $index => $rule)
                        <tr>
                            <td scope="row">{{ $index + $rules->firstitem() }}</td>
                            <td>{{ $rule->data_penyakit->nama_penyakit }}</td>
                            <td>
                                @php
                                    $gejalaIds = explode(',', $rule->daftar_gejala);
                                    $gejalaItems = [];
                                    foreach ($gejalas as $gejalaItem) {
                                        if (in_array($gejalaItem->id, $gejalaIds)) {
                                            $gejalaItems[] = $gejalaItem;
                                        }
                                    }
                                @endphp

                                @foreach ($gejalaItems as $gejalaItem)
                                    {{ $gejalaItem->kd_gejala }}
                                @endforeach
                            </td>
                            <td>
                                <div style="size: 30px;" class="row">
                                    <div class="col-md-3 text-start">
                                        <a href="#exampleModalEdit{{ $rule->id }}" data-bs-toggle="modal"
                                            class="btn btn-primary fw-bold rounded-pill px-3 shadow float-end"><i
                                                class='bx bx-edit'></i></a>
                                    </div>
                                    <div class="col-md-3 text-start">
                                        <form onsubmit="return confirm('Apakah anda yakin ?');"
                                            action="{{ route('Rule.destroy', $rule->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger fw-bold rounded-pill px-3 shadow float-end" type="submit">
                                                <a href="/Penyakit/{{ $rule->id }}" method="post"
                                                    onsubmit="return confirm('Apakah anda yakin ?');"><i
                                                        class="bx bxs-trash" style=color:white></i>
                                                </a>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $rules->links() }}
        </div>
        @include('Admin.Rule.edit')

        {{-- modal tambah data gejala --}}
        <div class="modal fade" id="exampleModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" style="width: 125%">
                <div class="modal-content p-3" style="width: 125%">
                    <div class="modal-header hader">
                        <h3 class="modal-title" id="exampleModalLabel">
                            Tambah Data Gejala
                        </h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('Admin/Rule') }}" method="POST">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group mb-1">
                                <label for="kode_penyakit" class="form-label mb-2">Pilih Kode Penyakit</label>
                                <select class="form-select mb-3" aria-label="Kode Penyakit" name="id_penyakit"
                                    id="kode_penyakit" onchange="updateNamaPenyakit(this)">
                                    <option value="">Pilih kode penyakit</option>
                                    @foreach ($data_penyakits as $item)
                                        <option value="{{ $item->id }}" data-nama="{{ $item->nama_penyakit }}">
                                            {{ $item->kd_penyakit }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-1">
                                <label for="nama_penyakit" class="mb-2">Nama Penyakit</label>
                                <input type="text" id="nama_penyakit" name="nama_penyakit" class="form-control" readonly>
                            </div>
                            <div>
                                <script>
                                    function updateNamaPenyakit(select) {
                                        var selectedOption = select.options[select.selectedIndex];
                                        var namaPenyakitInput = document.getElementById('nama_penyakit');
                                        namaPenyakitInput.value = selectedOption.getAttribute('data-nama');
                                    }
                                </script>
                            </div>

                            <div class="form mb-1">
                                <label for="daftar_gejala">Pilih Kode Gejala</label>
                                @foreach ($gejalas as $item)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="daftar_gejala[]"
                                            value="{{ $item->id }}" id="gejala_{{ $item->id }}">
                                        <label for="gejala_{{ $item->id }}" class="form-check-label">
                                            {{ $item->nama_gejala }} [ {{ $item->kd_gejala }} ]
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                            <div class="modal-footer d-md-block">
                                <div class="modal-footer d-md-block">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"
                                        onclick="disable1(this);">
                                        <span id="buttonText">Simpan</span>
                                    </button>
                                </div>
                    </form>
                </div>
            </div>



            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var kodePenyakit = document.getElementById('kode_penyakit');
                    var namaPenyakit = document.getElementById('nama_penyakit');
                    var penyakitData = {
                        !!json_encode($data_penyakits) !!
                    };

                    kodePenyakit.addEventListener('change', function() {
                        var selectedId = kodePenyakit.value;
                        var selectedPenyakit = penyakitData.find(function(penyakit) {
                            return penyakit.id == selectedId;
                        });

                        namaPenyakit.value = selectedPenyakit ? selectedPenyakit.nama_penyakit : '';
                    });
                });
            </script>

            <script>
                function disable1(button) {
                    button.disabled = true;
                    var buttonText = document.getElementById("buttonText");
                    buttonText.textContent = "Tunggu...";

                    setTimeout(function() {
                        button.form.submit();
                    }, 500);
                }
            </script>

    </main>
@endsection
