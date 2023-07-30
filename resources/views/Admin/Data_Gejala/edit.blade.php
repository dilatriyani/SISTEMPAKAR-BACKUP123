@foreach ($data_gejala as $item)
<div class="modal fade" id="exampleModalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header hader">
                <h3 class="modal-title" id="exampleModalLabel{{ $item->id }}">
                    Edit Data Gejala
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/Admin/Data_Gejala', $item->id ) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                {{ csrf_field() }}
                <div class="modal-body" id="modal-content-edit">
                    <div class="form-group">
                        <label>Nama Gejala</label>
                        <input type="text" name="nama_gejala" class="form-control @error('nama_gejala') is-invalid @enderror"
                            value="{{ $item->nama_gejala }}" required id="ubah">
                        @error('nama_gejala')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Kode Gejala</label>
                        <input type="text" name="kd_gejala" class="form-control @error('kd_gejala') is-invalid @enderror"
                            value="{{ $item->kd_gejala }}" required>
                        @error('kd_gejala')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer d-md-block">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    <button type="button" class="btn btn-danger btn-sm">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<script>
    CKEDITOR.replace('ubah');
</script>


{{-- <input type="hidden" name="id" value="{{ $edit->id }}">

<div class="form-group">
    <label>Nama Gejala</label>
    <input type="text" name="nama_gejala" class="form-control @error('nama_gejala') is-invalid @enderror" value="{{ $edit->nama_gejala }}" required>
    @error('nama_gejala')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Kode Gejala</label>
    <input type="text" name="kd_gejala" class="form-control @error('kd_gejala') is-invalid @enderror" value="{{ $edit->kd_gejala }}" required>
    @error('kd_gejala')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Kode Penyakit</label>
    <input type="text" name="kd_penyakit" class="form-control @error('kd_penyakit') is-invalid @enderror" value="{{ $edit->kd_penyakit }}" required>
    @error('kd_penyakit')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<script>
    CKEDITOR.replace('ubah');
</script> --}}
