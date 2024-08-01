<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pegawai PDF</title>
</head>
<body>
<h1>Daftar Pegawai</h1>
<table border="1" style="width:100%">
    <thead>
        <tr>
            <th>No.</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telp</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ;?>
        @foreach ($pegawai as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row['nip'] }}</td>
                <td>{{ $row['nama']}}</td>
                <td>{{ $row['email']}}</td>
                <td>{{ $row['telp']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>