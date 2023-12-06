<h1> Daftar Transaksi Token Listrik</h1>

<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th style="text-align: center; vertical-align: middle;">Nama Lengkap</th>
    <th style="text-align: center; vertical-align: middle;">Meter Number</th>
    <th style="text-align: center; vertical-align: middle;">Token Listrik</th>
    <th style="text-align: center; vertical-align: middle;">Harga</th>
    <th style="text-align: center; vertical-align: middle;">Tanggal</th>
</tr>

@foreach ($electricBill as $products)
<tr>
    <td style="text-align: center; vertical-align: middle;">{{ $products->fullname }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $products->meter_number }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $products->token_listrik }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $products->harga }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $products->created_at }}</td>
</tr>
@endforeach

       </table>