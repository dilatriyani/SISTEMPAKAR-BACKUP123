@foreach ($data_penyakit as $item)
<div class="modal fade" id="exampleModalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 80%">
        <div class="modal-content" style="width: 80%">
            <div class="modal-header hader">
                <h3 class="modal-title" id="exampleModalLabel{{ $item->id }}">
                    Edit Data Penyakit
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/Admin/Data_Penyakit', $item->id) }}" method="POST" >
                @method('PUT')
                {{ csrf_field() }}
                <div class="modal-body" id="modal-content-edit">
                    <div class="form-group">
                        <label>Kode Penyakit</label>
                        <input type="text" name="kd_penyakit" class="form-control @error('kd_penyakit') is-invalid @enderror" value="{{ $item->kd_penyakit }}" required>
                        @error('kd_penyakit')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama Penyakit</label>
                        <input type="text" name="nama_penyakit" class="form-control @error('nama_penyakit') is-invalid @enderror" value="{{ $item->nama_penyakit }}" required>
                        @error('nama_penyakit')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi" id="edit" class="form-control @error('deskripsi') is-invalid @enderror" value="{{ $item->deskripsi }}" required>
                        @error('deskripsi')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Solusi</label>
                        <input type="text" name="solusi" id="edit" class="form-control @error('solusi') is-invalid @enderror" value="{{ $item->solusi }}" required>
                        @error('solusi')
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
<script>
    CKEDITOR.replace('edit');
</script>
