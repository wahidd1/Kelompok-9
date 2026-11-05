@extends('layouts.app')

@section('title', 'Laporan Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Laporan Sistem</h2>
    {{-- Tombol Cetak PDF --}}
    <a href="{{ route('admin.laporan.export') }}" class="btn btn-danger" target="_blank">
        🖨️ Cetak Laporan (PDF)
    </a>
</div>

{{-- Navigasi Tab --}}
<ul class="nav nav-tabs mb-3" id="laporanTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pengguna-tab" data-bs-toggle="tab" data-bs-target="#tab-pengguna" type="button">Data Pengguna</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="kuis-tab" data-bs-toggle="tab" data-bs-target="#tab-kuis" type="button">Hasil Kuis</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="feedback-tab" data-bs-toggle="tab" data-bs-target="#tab-feedback" type="button">Hasil Feedback</button>
    </li>
</ul>

{{-- Isi Konten Tab --}}
<div class="tab-content" id="laporanTabContent">
    
    {{-- Tab 1: Data Pengguna --}}
    <div class="tab-pane fade show active" id="tab-pengguna" role="tabpanel">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Umur</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengguna as $p)
                    <tr>
                        <td>{{ $p->id_pengguna }}</td>
                        <td>{{ $p->username }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->gender }}</td>
                        <td>{{ $p->umur }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tab 2: Hasil Kuis --}}
    <div class="tab-pane fade" id="tab-kuis" role="tabpanel">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID Hasil</th>
                        <th>ID Pengguna</th>
                        <th>Skor</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hasil_kuis as $hk)
                    <tr>
                        <td>{{ $hk->id }}</td>
                        <td>{{ $hk->id_pengguna }}</td>
                        <td>{{ $hk->skor }}</td>
                        <td>{{ \Carbon\Carbon::parse($hk->tanggal)->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tab 3: Hasil Feedback --}}
    <div class="tab-pane fade" id="tab-feedback" role="tabpanel">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID Feedback</th>
                        <th>Username</th>
                        <th>Isi Feedback</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedback as $f)
                    <tr>
                        <td>{{ $f->id_feedback ?? $f->id }}</td>
                        <td>{{ $f->pengguna->username ?? 'Anonim' }}</td>
                        <td>{{ $f->isi_feedback }}</td>
                        <td>{{ \Carbon\Carbon::parse($f->tanggal)->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection