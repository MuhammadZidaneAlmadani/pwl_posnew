@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Level Pengguna</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/level') }}">
                @csrf
                <div class="form-group">
                    <label>Level Kode</label>
                    <input type="text" class="form-control" id="level_kode" name="level_kode"
                        value="{{ old('level_kode') }}" required>
                    @error('level_kode')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Level Nama</label>
                    <input type="text" class="form-control" id="level_nama" name="level_nama"
                        value="{{ old('level_nama') }}" required>
                    @error('level_nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ url('level') }}">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
