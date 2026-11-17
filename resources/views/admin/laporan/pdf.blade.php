<!DOCTYPE html>  
<html lang="id">  
<head>  
    <meta charset="UTF-8">  
    <title>Laporan Sistem</title>  
    <style>  
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; }  
        h1 { font-size: 18px; margin-bottom: 4px; }  
        h2 { font-size: 14px; margin-top: 20px; color: #59359a; }  
        table { width: 100%; border-collapse: collapse; margin-top: 6px; }  
        th, td { border: 1px solid #999; padding: 5px; text-align: left; }  
        th { background-color: #59359a; color: #fff; }  
    </style>  
</head>  
<body>  
    <h1>Laporan Sistem - Edukasi Kesetaraan Gender</h1>  
    <p>Dicetak pada {{ now()->format('d M Y H:i') }}</p>  

    <h2>Ringkasan</h2>  
    <table>  
        <tr>  
            <th>Total Pengguna</th>  
            <th>Kuis Dikerjakan</th>  
            <th>Rata-rata Skor</th>  
            <th>Total Feedback</th>  
        </tr>  
        <tr>  
            <td>{{ $ringkasan['total_pengguna'] }}</td>  
            <td>{{ $ringkasan['total_pengerjaan'] }}</td>  
            <td>{{ $ringkasan['rata_skor'] }}</td>  
            <td>{{ $ringkasan['total_feedback'] }}</td>  
        </tr>  
    </table>  

    <h2>Data Pengguna</h2>  
    <table>  
        <tr><th>ID</th><th>Username</th><th>Email</th><th>Gender</th><th>Umur</th></tr>  
        @foreach ($pengguna as $p)  
        <tr>  
            <td>{{ $p->id_pengguna }}</td>  
            <td>{{ $p->username }}</td>  
            <td>{{ $p->email }}</td>  
            <td>{{ $p->gender }}</td>  
            <td>{{ $p->umur }}</td>  
        </tr>  
        @endforeach  
    </table>  

    <h2>Hasil Kuis</h2>  
    <table>  
        <tr><th>ID</th><th>Pengguna</th><th>Kuis</th><th>Skor</th><th>Tanggal</th></tr>  
        @foreach ($hasilKuis as $h)  
        <tr>  
            <td>{{ $h->id_hasil }}</td>  
            <td>{{ $h->pengguna->username ?? '-' }}</td>  
            <td>{{ $h->kuis->judul ?? '-' }}</td>  
            <td>{{ $h->skor }}</td>  
            <td>{{ $h->tanggal->format('d M Y') }}</td>  
        </tr>  
        @endforeach  
    </table> 

    <h2>Feedback</h2>  
    <table>  
        <tr><th>ID</th><th>Username</th><th>Isi Feedback</th><th>Tanggal</th></tr>  
        @foreach ($feedback as $f)  
        <tr>  
            <td>{{ $f->id_feedback }}</td>  
            <td>{{ $f->pengguna->username ?? 'Anonim' }}</td>  
            <td>{{ $f->isi_feedback }}</td>  
            <td>{{ $f->tanggal->format('d M Y') }}</td>  
        </tr>  
        @endforeach  
    </table>  
</body>  
</html> 