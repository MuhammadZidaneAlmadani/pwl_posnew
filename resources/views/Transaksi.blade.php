<!DOCTYPE html>
<html>
    <head>
        <title>Data Stok</title>
    </head>
    <body>
        <h1>Transaksi</h1>
        <table border="1" cellpadding="2" cellspacing="0">
            <tr>
                <th>penjualan_Id</th>
                <th>User_Id</th>
                <th>pembeli</th>
                <th>penjualan_kode</th>
                <th>penjualan_tanggal</th>

            </tr>
            @foreach ($data as $d)
            <tr>
                <td>{{ $d->penjualan_id }}</td>
                <td>{{ $d->user_id }}</td>
                <td>{{ $d->pembeli }}</td>
                <td>{{ $d->penjualan_kode }}</td>
                <td>{{ $d->penjualan_tanggal }}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>