<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Shuttle</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #e0e0e0; }
    </style>
</head>
<body>
    <h2>Laporan Data Armada Shuttle</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Armada</th>
                <th>Kapasitas</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_armada }}</td>
                <td>{{ $item->kapasitas }}</td>
                <td>{{ $item->status_aktif ? 'Aktif' : 'Tidak Aktif' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>