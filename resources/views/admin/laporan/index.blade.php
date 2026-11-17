@extends('layouts.app')

@section('title', 'Laporan Admin')

@section('content') 
<div class="d-flex justify-content-between align-items-center mb-4">  
    <h2 class="mb-0">Laporan Sistem</h2>  
    <a href="{{ route('admin.laporan.export') }}" class="btn btn-danger" target="_blank">  
        <i class="bi bi-file-earmark-pdf me-1"></i>Cetak Laporan (PDF)  
    </a>  
</div> 

{{-- Kartu ringkasan --}} 
<div class="row g-3 mb-4">  
    <div class="col-6 col-lg-3">  
        <div class="card kartu-angka p-3">  
            <small class="text-muted">Total Pengguna</small>  
            <div class="angka">{{ $ringkasan['total_pengguna'] }}</div>  
        </div>  
    </div>  
    <div class="col-6 col-lg-3">  
        <div class="card kartu-angka p-3">  
            <small class="text-muted">Kuis Dikerjakan</small>  
            <div class="angka">{{ $ringkasan['total_pengerjaan'] }}</div>  
        </div>  
    </div>  
    <div class="col-6 col-lg-3">  
        <div class="card kartu-angka p-3">  
            <small class="text-muted">Rata-rata Skor</small>  
            <div class="angka">{{ $ringkasan['rata_skor'] }}</div>  
        </div>  
    </div>  
    <div class="col-6 col-lg-3">  
        <div class="card kartu-angka p-3">  
            <small class="text-muted">Total Feedback</small>  
            <div class="angka">{{ $ringkasan['total_feedback'] }}</div>  
        </div>  
    </div>  
</div> 

{{-- Tab --}} 
<ul class="nav nav-tabs mb-3"> 
    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-pengguna" type="button">Data Pengguna</button></li> 
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-kuis" type="button">Hasil Kuis</button></li> 
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-feedback" type="button">Hasil Feedback</button></li> 
</ul> 

<div class="tab-content"> 
    {{-- Tab 1: Pengguna --}} 
    <div class="tab-pane fade show active" id="tab-pengguna"> 
        <div class="table-responsive"> 
            <table class="table table-striped align-middle"> 
                <thead class="table-dark"> 
                    <tr><th>ID</th><th>Username</th><th>Email</th><th>Gender</th><th>Umur</th></tr> 
                </thead> 
                <tbody> 
                    @forelse ($pengguna as $p) 
                        <tr> 
                            <td>{{ $p->id_pengguna }}</td> 
                            <td>{{ $p->username }}</td> 
                            <td>{{ $p->email }}</td> 
                            <td>{{ $p->gender }}</td> 
                            <td>{{ $p->umur }}</td> 
                        </tr> 
                    @empty 
                        <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr> 
                    @endforelse 
                </tbody> 
            </table> 
        </div> 
    </div> 

    {{-- Tab 2: Hasil Kuis --}} 
    <div class="tab-pane fade" id="tab-kuis"> 
        <div class="table-responsive"> 
            <table class="table table-striped align-middle"> 
                <thead class="table-dark"> 
                    {{-- Perhatikan: id diganti id_hasil --}}
                    <tr><th>ID Hasil</th><th>Pengguna</th><th>Kuis</th><th>Skor</th><th>Tanggal</th></tr> 
                </thead> 
                <tbody> 
                    {{-- Perhatikan: variabel diganti $hasilKuis --}}
                    @forelse ($hasilKuis as $hk) 
                        <tr> 
                            <td>{{ $hk->id_hasil }}</td> 
                            <td>{{ $hk->pengguna->username ?? '-' }}</td> 
                            <td>{{ $hk->kuis->judul ?? '-' }}</td> 
                            <td>{{ $hk->skor }}</td> 
                            <td>{{ $hk->tanggal->format('d M Y') }}</td> 
                        </tr> 
                    @empty 
                        <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr> 
                    @endforelse 
                </tbody> 
            </table> 
        </div> 
    </div> 

    {{-- Tab 3: Feedback --}} 
    <div class="tab-pane fade" id="tab-feedback"> 
        <div class="table-responsive"> 
            <table class="table table-striped align-middle"> 
                <thead class="table-dark"> 
                    <tr><th>ID</th><th>Username</th><th>Isi Feedback</th><th>Tanggal</th></tr> 
                </thead> 
                <tbody> 
                    @forelse ($feedback as $f) 
                        <tr> 
                            <td>{{ $f->id_feedback }}</td> 
                            <td>{{ $f->pengguna->username ?? 'Anonim' }}</td> 
                            <td>{{ $f->isi_feedback }}</td> 
                            <td>{{ $f->tanggal->format('d M Y') }}</td> 
                        </tr> 
                    @empty 
                        <tr><td colspan="4" class="text-center text-muted">Belum ada data.</td></tr> 
                    @endforelse 
                </tbody> 
            </table> 
        </div> 
        <p class="text-muted small mt-2">Halaman ini menampilkan 10 data terbaru. Data lengkap ada di file PDF.</p>
    </div> 
</div> 
@endsection