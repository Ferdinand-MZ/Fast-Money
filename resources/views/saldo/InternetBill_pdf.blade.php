<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Layanan Internet/TV Kabel</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #fff;
            margin: 20px;
        }

        h1 {
            text-align: center;
            font-size: 20px;
            margin: 0;
        }

        table {
            width: 100%;
            margin-top: 10px;
            
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h3>Struk Transaksi Layanan Internet/TV Kabel</h3>

    <table>
        @foreach ($internetBill as $data)
        <tr>
            <th>Nama</th>
            <td>{{ $data->fullname}}</td>
        </tr>
        <tr>
            <th>customer ID</th>
            <td>{{ $data->customer_id}}</td>
        </tr>
        <tr>
            <th>Nama Penyedia</th>
            <td>{{ $data->nama_penyedia}}</td>
        </tr>
        <tr>
            <th>Harga Bayar</th>
            <td>{{ $data->harga}}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ $data->created_at}}</td>
        </tr>
        @endforeach
    </table>

    <!-- Add additional information, totals, or footer here -->

</body>
</html>