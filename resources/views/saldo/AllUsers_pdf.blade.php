<h1> Daftar User</h1>

<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
    <th style="text-align: center; vertical-align: middle;">Username</th>
    <th style="text-align: center; vertical-align: middle;">Nama Lengkap</th>
    <th style="text-align: center; vertical-align: middle;">Email</th>
    <th style="text-align: center; vertical-align: middle;">Tanggal Lahir</th>
    <th style="text-align: center; vertical-align: middle;">Nomer Telepon</th>
    <th style="text-align: center; vertical-align: middle;">Saldo</th>
    <th style="text-align: center; vertical-align: middle;">Tanggal</th>
</tr>

@foreach ($users as $products)
<tr>
    <td style="text-align: center; vertical-align: middle;">{{ $products->username }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $products->fullname }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $products->email }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $products->tgl_lahir }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $products->no_telp }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $products->saldo }}</td>
    <td style="text-align: center; vertical-align: middle;">{{ $products->created_at }}</td>
</tr>
@endforeach

       </table>