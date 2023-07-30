@extends('Admin.Partials.index')
@section('container')
<main id="main" class="main">
<div>
    <h1>Data Diagnosa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
            <li class="breadcrumb-item active">Data Diagnosa</li>
        </ol>
    </nav>

    <div class="card p-3">
        <table id="diagnosaTable" class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Waktu Diagnosa</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Diagnosa</th>
                    <th scope="col">Persentase</th>
                    <th scope="col">Solusi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayat_diagnosa as $index => $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->umur }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->penyakit }}</td>
                    <td>{{ $item->persentase }}</td>
                    <td>{{ $item->solusi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</main>

<!-- Include necessary CSS and JavaScript files for DataTables and Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<!-- Initialize DataTable on the table with id "diagnosaTable" -->
<script>
$(document).ready(function() {
    $('#diagnosaTable').DataTable({
        dom: 'Bfrtip', // B: Buttons
        buttons: ['pdf'] // Add the PDF export button
    });
});
</script>
@endsection
