<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Shuttle</title>
</head>
<body>
    <h1>Daftar Armada Shuttle</h1>

    <a href="{{ route('shuttles.create') }}">+ Tambah Shuttle Baru</a>

    <form action="{{ route('shuttles.index') }}" method="GET" style="margin-top: 15px;">
        <input type="text" name="search" placeholder="Cari nama armada..." value="{{ request('search') }}">
        <button type="submit">Cari</button>
    </form>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 15px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Armada</th>
                <th>Kapasitas</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shuttles as $index => $shuttle)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $shuttle->nama_armada }}</td>
                    <td>{{ $shuttle->kapasitas }}</td>
                    <td>{{ $shuttle->status_aktif ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>
                        <a href="{{ route('shuttles.show', $shuttle->id) }}">Detail</a>
                        <a href="{{ route('shuttles.edit', $shuttle->id) }}">Edit</a>

                        <form action="{{ route('shuttles.destroy', $shuttle->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data armada ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>