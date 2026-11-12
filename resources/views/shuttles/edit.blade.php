
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Shuttle</title>
</head>
<body>
    <h1>Edit Armada Shuttle</h1>

    <form action="{{ route('shuttles.update', $shuttle->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_armada">Nama Armada:</label><br>
            <input
                type="text"
                name="nama_armada"
                id="nama_armada"
                value="{{ old('nama_armada', $shuttle->nama_armada) }}"
            >

            @error('nama_armada')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <br>

        <div>
            <label for="kapasitas">Kapasitas (Orang):</label><br>
            <input
                type="number"
                name="kapasitas"
                id="kapasitas"
                min="1"
                value="{{ old('kapasitas', $shuttle->kapasitas) }}"
            >

            @error('kapasitas')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <br>

        <div>
            <label for="rute_operasional">Rute Operasional:</label><br>
            <input
                type="text"
                name="rute_operasional"
                id="rute_operasional"
                value="{{ old('rute_operasional', $shuttle->rute_operasional) }}"
            >

            @error('rute_operasional')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <br>

        <div>
            <label for="status_aktif">Status Aktif:</label><br>
            <select name="status_aktif" id="status_aktif">
                <option value="1"
                    {{ old('status_aktif', $shuttle->status_aktif) == '1' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="0"
                    {{ old('status_aktif', $shuttle->status_aktif) == '0' ? 'selected' : '' }}>
                    Tidak Aktif
                </option>
            </select>

            @error('status_aktif')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <br>
    <a href="{{ route('shuttles.index') }}">
        &larr; Kembali ke Daftar
    </a>
</body>
</html>
