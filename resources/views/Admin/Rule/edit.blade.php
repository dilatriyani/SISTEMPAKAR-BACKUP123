@foreach ($rules as $rule)
    <div class="modal fade" id="exampleModalEdit{{ $rule->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $rule->id }}"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 50%">
            <div class="modal-content">
                <div class="modal-header hader">
                    <h3 class="modal-title" id="exampleModalLabel{{ $rule->id }}">
                        Edit Data Gejala
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/Admin/Rule', $rule->id) }}" method="POST" >
                    @csrf
                    @method('PUT')
                    <div class="modal-body" id="modal-content-edit">

                        <div class="form-group mb-1">
                            <label for="kd_penyakit" class="form-label mb-2">Pilih Kode Penyakit</label>
                            <select class="form-select mb-3" aria-label="id_penyakit" name="id_penyakit"
                                id="id_penyakit">
                                @foreach ($data_penyakits as $item)
                                    <option value="{{ $item->id }}" @if($item->id == $rule->kd_penyakit) selected @endif>
                                        {{ $item->nama_penyakit }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form mb-1">
                            <label for="daftar_gejala">Pilih Kode Gejala</label>
                            @foreach ($gejalas as $gejala)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="daftar_gejala[]"
                                        value="{{ $gejala->id }}" id="gejala_{{ $gejala->id }}" @if (in_array($gejala->id, explode(',', $rule->daftar_gejala))) checked @endif>
                                    <label for="gejala_{{ $gejala->id }}" class="form-check-label">
                                        {{ $gejala->nama_gejala }} [ {{ $gejala->kd_gejala }} ]
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer d-md-block">
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
