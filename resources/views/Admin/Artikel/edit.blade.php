@foreach ($artikel as $item)
<div class="modal fade" id="exampleModalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 80%">
        <div class="modal-content" style="width: 80%">
            <div class="modal-header hader">
                <h3 class="modal-title" id="exampleModalLabel{{ $item->id }}">
                    Edit Data Penyakit
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/Admin/Artikel', $item->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body" id="modal-content-edit">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ $item->judul }}" required>
                        @error('judul')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Isi</label>
                        <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" required>{!! $item->isi !!} </textarea>
                        @error('isi')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-1">
                        <label for="image">Gambar</label>
                        @if (isset($item->image))
                            <div>
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar" style="max-width: 200px; margin-bottom: 10px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="image_new" id="image">
                        @error('image_new')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer d-md-block">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                 
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script>
    CKEDITOR.replace('isi');
</script>
