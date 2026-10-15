<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Shuttle</title>
</head>
<body>
    <h1>Detail Armada Shuttle</h1>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Nama Armada</th>
            <td>{{ $shuttle->nama_armada }}</td>
        </tr>
        <tr>
            <th>Kapasitas</th>
            <td>{{ $shuttle->kapasitas }} orang</td>
        </tr>
        <tr>
            <th>Rute Operasional</th>
            <td>{{ $shuttle->rute_operasional ?? '-' }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $shuttle->status_aktif ? 'Aktif' : 'Tidak Aktif' }}</td>
        </tr>
    </table>

    <br>
    <a href="{{ route('shuttles.edit', $shuttle->id) }}">Edit</a> |
    <a href="{{ route('shuttles.index') }}">&larr; Kembali ke Daftar</a>
</body>
</html>