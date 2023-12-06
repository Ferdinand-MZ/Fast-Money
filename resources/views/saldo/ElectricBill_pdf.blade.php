<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Token Listrik</title>
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

    <h3>Struk Transaksi Token Listrik</h3>

    <table>
        @foreach ($electricBill as $data)
        <tr>
            <th>Nomer Meter</th>
            <td>{{ $data->meter_number}}</td>
        </tr>
        <tr>
            <th>Fullname</th>
            <td>{{ $data->fullname}}</td>
        </tr>
        <tr>
            <th>Harga Bayar</th>
            <td>{{ $data->harga}}</td>
        </tr>
        <tr>
            <th>Token Listrik</th>
            <td>{{ $data->token_listrik}}</td>
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