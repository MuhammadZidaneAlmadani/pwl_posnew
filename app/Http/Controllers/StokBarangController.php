<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StokModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BarangModel;
use App\Models\UserModel;
use Yajra\DataTables\Facades\DataTables;
class StokBarangController extends Controller
{
    // Menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok Barang',
            'list'  => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar Stok Barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'stok'; // set menu yang sedang aktif

        $barang = BarangModel::all(); // ambil data level untuk filter level
        $user = UserModel::all();

        return view('stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $stoks= StokModel::select('stok_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')->with('barang', 'user');

        return DataTables::of($stoks)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($stok) {  // menambahkan kolom aksi
                $btn  = '<a href="'.url('/stok/' . $stok->stok_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/stok/' . $stok->stok_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. url('/stok/'.$stok->stok_id).'">'
                        . csrf_field() . method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }


    // Menampilkan halaman form tambah user
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok Barang',
            'list'  => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data Barang baru'
        ];

        $activeMenu = 'Stok';
        $barang = BarangModel::all(); // ambil data level untuk filter level
        $user = UserModel::all();
        return view('stok.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data user baru
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer',
        ]);

        StokModel::create([
            'barang_id'=> $request->barang_id,
            'user_id'=> $request->user_id,
            'stok_tanggal'=> $request->stok_tanggal,
            'stok_jumlah'=> $request->stok_jumlah
        ]);

        return redirect('/stok')->with('success', 'Data stok barang berhasil disimpan');
    }

    public function show(string $id)
    {
        $stok = StokModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Stok Barang',
            'list'  => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Stok Barang'
        ];

        $activeMenu = 'stok'; // set menu yang sedang aktif

        return view('stok.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit user
 public function edit(string $id)
    {
        $stok = StokModel::find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Stok Barang',
            'list'  => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Stok Barang'
        ];

        $activeMenu = 'stok'; // set menu yang sedang aktif

        return view('stok.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'barang' => $barang, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

        // Menyimpan perubahan data user
        public function update(Request $request, string $id)
        {
            $request->validate([
                'stok_id' => 'required|integer',
                'barang_id' => 'required|integer',
                'user_id' => 'required|integer',
                'stok_tanggal' => 'required|date',
                'stok_jumlah' => 'required|integer',

            ]);

            BarangModel::find($id)->update([
                'stok_id'=> $request->stok_id,
                'barang_id'=> $request->barang_id,
                'user_id'=> $request->user_id,
                'stok_tanggal'=> $request->stok_tanggal,
                'stok_jumlah'=> $request->stok_jumlah
            ]);

            return redirect('/stok')->with('success', 'Data Barang berhasil diubah');
        }

            // Menghapus data user
    public function destroy(string $id)
    {
        $check = StokModel::find($id);
        if (!$check) {      // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try{
            StokModel::destroy($id);   // Hapus data level

            return redirect('/stok')->with('success', 'Data barang berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){

            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/stok')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
