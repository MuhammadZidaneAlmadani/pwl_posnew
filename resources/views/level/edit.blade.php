@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Level Pengguna</h3>
        </div>
        <div class="card-body">
        @empty($level) {{-- empty ini adalah fungsi blade yang berfungsi untuk mengecek data kosong atau tidak --}}
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
            <a href="{{ url('level') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
            <form method="POST" action="{{ url('/level/'.$level->level_id) }}">
            @csrf
            {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->
            <div class="form-group]">
                <label>Level Kode</label>
                <input type="text" class="form-control" id="level_kode" name="level_kode"
    value="{{ old('level_kode', $level->level_kode) }}" required>
                @error('level_kode')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Level Nama</label>
                <input type="text" class="form-control" id="level_nama" name="level_nama"
    value="{{ old('level_nama', $level->level_nama) }}" required>
                @error('level_nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                <a class="btn btn-sm btn-default ml-1" href="{{url('level')}}">Kembali</a>
            </div>
        </form>
        @endempty
        </div>
    </div>
    <@endsection

    @push('css')
    @endpush

    @push('js')
    @endpush
