@extends('Admin.Partials.index')
@section('container')
    <main id="main" class="main">
        <div>
            <h1>Data Gejala</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                    <li class="breadcrumb-item active">Data Gejala</li>
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
                            <th scope="col">Gejala</th>
                            <th scope="col">Kode Gejala</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_gejala as $index => $item)
                            <tr>
                                <td scope="row">{{ $index + $data_gejala->firstitem() }}</td>
                                <td>{{ $item->nama_gejala }}</td>
                                <td>{{ $item->kd_gejala }}</td>
                                <td style="size: 30px;" class="row">
                                    <div class="col-md-4 text-end">
                                        <a href="#exampleModalEdit{{ $item->id }}" data-bs-toggle="modal"
                                            class="btn btn-primary fw-bold rounded-pill px-4 shadow float-end"><i
                                                class='bx bx-edit'></i></a>
 
                                    </div>

                                    <div class="col-md-4 text-start">
                                        <form onsubmit="return confirm('Apakah anda yakin ?');"
                                            action="{{ route('Data_Gejala.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">
                                                <a href="/Gejala/{{ $item->id }}" method="post"
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
                {{ $data_gejala->links() }}
            </div>
        </div>
        @include('Admin.Data_Gejala.edit')


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
                    <form action="{{ url('/Admin/Data_Gejala') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-1">
                                <label for="nama_gejala">Tambahkan Gejala</label>
                                <textarea type="text" class="form-control" name="nama_gejala"  placeholder=""
                                    @error('nama_gejala') is-invalid @enderror value="{{ old('nama_gejala') }}"></textarea>
                                @error('nama_gejala')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-1">
                                <label for="gejala">Kode gejala</label>
                                <input type="text" class="form-control" name="kd_gejala" id="kd_gelaja" placeholder=""
                                    @error('kd_gejala') is-invalid @enderror value="{{ old('kd_gejala') }}">
                                @error('kd_gejala')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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

        {{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

        <script>
            CKEDITOR.replace('nama_gejala');
        </script>
        --}}

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
 