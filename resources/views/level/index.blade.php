@extends('layouts.template')

@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar Level Pengguna</h3>
      <div class="card-tools">
        <a href="{{ url('level/create') }}" class="btn btn-sm btn-primary mt-1">
            <i class="fas fa-plus"></i> Tambah</a>
      </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-sm table-striped table-hover" id="table_level">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode level</th>
                    <th>Nama level</th>
                    <th>Aksi</th>
                </tr>
        </thead>
        <body></body>
      </table>
    </div>
  </div>
@endsection
@push('css')

@endpush

@push('js')
  <script>
    $(document).ready(function() {
      var dataUser = $('#table_level').DataTable({
          serverSide: true,     // serverSide: true, jika ingin menggunakan server side processing
          ajax: {
              "url": "{{ url('level/list') }}",
              "dataType": "json",
              "type": "POST",
          },
          columns: [
            {
              data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()              
              className: "text-center",
              orderable: false,
              searchable: false    
            },{
              data: "level_kode",               
              className: "",
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari
            },{
              data: "level_nama",               
              className: "",
              orderable: true,    // orderable: true, jika ingin kolom ini bisa diurutkan
              searchable: true    // searchable: true, jika ingin kolom ini bisa dicari
            },{
              data: "aksi",               
              className: "",
              orderable: false,    // orderable: true, jika ingin kolom ini bisa diurutkan
              searchable: false    // searchable: true, jika ingin kolom ini bisa dicari
            }
              
          ]
      });

      $('#level_id').on('change', function() {
        dataUser.ajax.reload();
      });
      
    });
  </script>
@endpush