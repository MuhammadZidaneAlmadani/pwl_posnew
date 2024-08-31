<!DOCTYPE html>
<html>
    <head>
        <title>Data Stok</title>
    </head>
    <body>
        <h1>Stok Barang</h1>
        <table border="1" cellpadding="2" cellspacing="0">
            <tr>
                <th>Stok_Id</th>
                <th>Barang_Id</th>
                <th>User_Id</th>
                <th>Stok_Tanggal</th>
                <th>Stok_Jumlah</th>

            </tr>
            @foreach ($data as $d)
            <tr>
                <td>{{ $d->stok_id }}</td>
                <td>{{ $d->barang_id }}</td>
                <td>{{ $d->user_id }}</td>
                <td>{{ $d->stok_tanggal }}</td>
                <td>{{ $d->stok_jumlah }}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>