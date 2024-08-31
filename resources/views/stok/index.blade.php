@extends('layouts.template')

@section('content')
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title">{{ $page->title }}</h3>
      <div class="card-tools">
        <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">Tambah</a>
      </div>
    </div>
    <div class="card-body">
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      <div class="row">
        <div class="col-md-12">
          <div class="form-group row">
            <label class="col-1 control-label col-form-label">Filter:</label>
            <div class="col-3">
              <select class="form-control" id="barang_id" name="barang_id">
                <option value="">- Semua -</option>
                @foreach($barang as $item)
                  <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                @endforeach
              </select>
              <small class="form-text text-muted">Barang</small>
            </div>
          </div>
        </div>
      </div>
      <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
        <thead>
          <tr>
            <th>ID</th>
            <th>Barang Nama</th>
            <th>User Nama</th>
            <th>Tanggal Stok</th>
            <th>Jumlah Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
@endsection

@push('css')

@endpush

@push('js')
  <script>
    $(document).ready(function() {
      var dataStok = $('#table_stok').DataTable({
          serverSide: true,     // serverSide: true, jika ingin menggunakan server side processing
          ajax: {
              "url": "{{ url('stok/list') }}",
              "dataType": "json",
              "type": "POST",
              "data": function (d) {
                d.barang_id = $('#barang_id').val();
                d.user_id = $('#user_id').val();  // filter berdasarkan barang_id
              }
          },
          columns: [
            {
              data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
              className: "text-center",
              orderable: false,
              searchable: false
            },{
              data: "barang.barang_nama",
              className: "",
              orderable: true,    // kolom ini bisa diurutkan
              searchable: true    // kolom ini bisa dicari
            },{
              data: "user.nama",
              className: "",
              orderable: true,    // kolom ini bisa diurutkan
              searchable: true    // kolom ini bisa dicari
            },{
              data: "stok_tanggal",
              className: "",
              orderable: true,    // kolom ini bisa diurutkan
              searchable: true    // kolom ini bisa dicari
            },{
              data: "stok_jumlah",
              className: "",
              orderable: true,    // kolom ini bisa diurutkan
              searchable: true    // kolom ini bisa dicari
            },{
              data: "aksi",
              className: "",
              orderable: false,    // kolom ini tidak bisa diurutkan
              searchable: false    // kolom ini tidak bisa dicari
            }
          ]
      });

      // Reload data when the filter changes
      $('#barang_id').on('change', function() {
        dataStok.ajax.reload();
      });

    });
  </script>
@endpush
