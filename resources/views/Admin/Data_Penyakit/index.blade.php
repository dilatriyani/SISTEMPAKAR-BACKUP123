@extends('Admin.Partials.index')
@section('container')
    <main id="main" class="main">
        <div>
            <h1>Data Penyakit</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item active">Data Penyakit</li>
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


            <div class="card p-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama Penyakit</th>
                            <th scope="col">Deskripsi Penyakit</th>
                            <th scope="col">Solusi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_penyakit as $index => $item)
                            <tr>
                                <td scope="row">{{ $index + $data_penyakit->firstitem() }}</td>
                                <td>{{ $item->kd_penyakit }}</td>
                                <td>{{ $item->nama_penyakit }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{!! $item->solusi !!}</td>
                                <td style="size: 30px;" class="row">
                                    <div class="col-md-4 text-end">
                                        <a href="#exampleModalEdit{{ $item->id }}" data-bs-toggle="modal"
                                            class="btn btn-primary fw-bold rounded-pill px-4 shadow float-end"><i
                                                class='bx bx-edit'></i></a>

                                    </div>

                                    <div class="col-md-4 text-start">
                                        <form onsubmit="return confirm('Apakah anda yakin ?');"
                                            action="{{ route('Data_Penyakit.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">
                                                <a href="/Penyakit/{{ $item->id }}" method="post"
                                                    onsubmit="return confirm('Apakah anda yakin ?');"><i
                                                        class="bx bxs-trash" style=color:white></i>
                                                </a>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $data_penyakit->links() }}
            </div>
        </div>
        @include('Admin.Data_Penyakit.edit')


        {{-- modal tambah data_penyakit --}}
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
                    <form action="{{ url('/Admin/Data_Penyakit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-1">
                                <label for="kd_penyakit">Kode Penyakit</label>
                                <input type="text" class="form-control" name="kd_penyakit" id="kd_penyakit"
                                    placeholder="Input Kode Penyakit" @error('kd_penyakit') is-invalid @enderror
                                    value="{{ old('kd_penyakit') }}">
                                @error('kd_penyakit')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label for="nama_penyakit">Nama Penyakit</label>
                                <input type="text" class="form-control" name="nama_penyakit" id="nama_penyakit"
                                    placeholder="" @error('nama_penyakit') is-invalid @enderror
                                    value="{{ old('nama_penyakit') }}">
                                @error('nama_penyakit')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-1">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
                            </div>

                            <div class="form-group mb-1">
                                <label for="solusi">Solusi</label>
                                <textarea name="solusi" id="solusi" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer d-md-block">
                            <button type="submit" class="btn btn-primary waves-effect waves-light"
                            onclick="disable1(this);">
                            <span id="buttonText">Simpan</span>
                        </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end --}}


        <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
        {{-- <script>
            $(function() {
                CKEDITOR.replace('deskripsi');
            })
        </script> --}}
        <script>
            CKEDITOR.replace('solusi');
            CKEDITOR.replace('deskripsi');
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </main>
@endsection

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

{{--
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript">
    function editpenyakit(id) {
        $.ajax({
            url: "{{ url('/Admin/Data_Penyakit/edit') }}",
            type: "GET",
            data: {
                id: id
            },
            success: function(data) {
                $("#modal-content-edit").html(data);
                return true;
            }
        });
    }
</script> --}}
