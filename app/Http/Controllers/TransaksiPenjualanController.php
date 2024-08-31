<?php
namespace App\Http\Controllers;

use App\Models\PenjualanModel;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransaksiPenjualanController extends Controller
{
    // Menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list'  => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar Transaksi Penjualan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'penjualan'; // set menu yang sedang aktif

        $user = UserModel::all(); // ambil data level untuk filter level

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $penjualans = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
                    ->with('user');

        // Filter data user berdasarkan level_id
        if ($request->user_id) {
            $penjualans->where('user_id', $request->user_id);
        }

        return DataTables::of($penjualans)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($penjualan) {  // menambahkan kolom aksi
                $btn  = '<a href="'.url('/penjualan/' . $penjualan->penjualan_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/penjualan/' . $penjualan->penjualan_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'. url('/user/'.$penjualan->penjualan_id).'">'
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
            'title' => 'Tambah Penjualan',
            'list'  => ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Penjualan baru'
        ];

        $user = UserModel::all(); // ambil data level untuk ditampilkan di form
        $activeMenu = 'penjualan'; // set menu yang sedang aktif

        return view('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data user baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'pembeli'     => 'required|string|max:100',
            'penjualan_kode' => 'required|min:5',
            'penjualan_tanggal' => 'required|date'
        ]);

        PenjualanModel::create([
            'user_id'     => $request->user_id,
            'pembeli' =>  $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);

        return redirect('/penjualan')->with('success', 'Data user berhasil disimpan');
    }

        // Menampilkan detail user
        public function show(string $id)
        {
            $penjualan = PenjualanModel::with('user')->find($id);

            $breadcrumb = (object) [
                'title' => 'Detail Penjualan',
                'list'  => ['Home', 'Penjualan', 'Detail']
            ];

            $page = (object) [
                'title' => 'Detail penjualan'
            ];

            $activeMenu = 'penjualan'; // set menu yang sedang aktif

            return view('penjualan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'activeMenu' => $activeMenu]);
       }

    // Menampilkan halaman form edit user
    public function edit(string $id)
    {
        $penjualan = PenjualanModel::find($id);
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list'  => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit penjualan'
        ];

        $activeMenu = 'penjualan'; // set menu yang sedang aktif

        return view('penjualan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

        // Menyimpan perubahan data user
        public function update(Request $request, string $id)
        {
            $request->validate([
                'user_id' => 'required|integer',
                'pembeli'     => 'required|string|max:100',
                'penjualan_kode' => 'required|min:5',
                'penjualan_tanggal' => 'required|date'
            ]);

            PenjualanModel::find($id)->update([
                'user_id'     => $request->user_id,
                'pembeli' =>  $request-> pembeli,
                'penjualan_kode' => $request->penjualan_kode,
                'penjualan_tanggal' => $request->penjualan_tanggal,
            ]);

            return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah');
        }

            // Menghapus data user
    public function destroy(string $id)
    {
        $check = PenjualanModel::find($id);
        if (!$check) {      // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/user')->with('error', 'Data penjualan tidak ditemukan');
        }

        try{
            PenjualanModel::destroy($id);   // Hapus data level

            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){

            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/penjualan')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
