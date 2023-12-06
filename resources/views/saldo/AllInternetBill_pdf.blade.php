<h1> Daftar Transaksi Layanan Internet/TV Kabel</h1>

<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th style="text-align: center; vertical-align: middle;">Nama Lengkap</th>
    <th style="text-align: center; vertical-align: middle;">Customer ID</th>
    <th style="text-align: center; vertical-align: middle;">Harga</th>
    <th style="text-align: center; vertical-align: middle;">Tanggal</th>
</tr>

@foreach ($internetBill as $products)
<tr>
    <td style="text-align: center; vertical-align: middle;">{{ $products->fullname }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $products->customer_id }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $products->harga }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $products->created_at }}</td>
</tr>
@endforeach

       </table>