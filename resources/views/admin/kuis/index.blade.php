@extends('layouts.app')

@section('title', 'Kelola Kuis')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Kuis</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKuis">+ Tambah</button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($kuis as $item)
        <div class="card mb-2 p-3 d-flex flex-row justify-content-between align-items-center">
            <div>
                <b>{{ $item->judul }}</b><br>
                <small class="text-muted">{{ $item->pertanyaan_count }} soal &middot; {{ $item->tanggal->format('d M Y') }}</small>
            </div>
            <form action="{{ route('admin.kuis.destroy', $item->id_kuis) }}" method="POST" onsubmit="return confirm('Hapus kuis ini? Semua soal dan hasil pengguna untuk kuis ini ikut terhapus.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
        </div>
    @empty
        <p>Belum ada kuis.</p>
    @endforelse

    {{-- Popup Form Tambah Kuis --}}
    <div class="modal fade" id="modalKuis" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <form action="{{ route('admin.kuis.store') }}" method="POST">
                    @csrf
                
                    <div class="modal-header">
                        <h5 class="modal-title">Form Kuis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->unique() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Judul Kuis</label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi (opsional)</label>
                            <textarea name="deskripsi" rows="2" class="form-control">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        </div>

                        <hr>

                        <div id="daftarSoal">
                            @include('admin.kuis._soal', ['i' => 0])
                        </div>

                        <button type="button" id="btnTambahSoal" class="btn btn-outline-secondary btn-sm">+ Tambah Soal</button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Cetakan 1 blok soal --}}
    <template id="tplSoal">
        @include('admin.kuis._soal', ['i' => '__I__'])
    </template>

    <script>
        let nomorSoal = 1;
        const daftarSoal = document.getElementById('daftarSoal');

        document.getElementById('btnTambahSoal').addEventListener('click', function () {
            const html = document.getElementById('tplSoal').innerHTML.replaceAll('__I__', nomorSoal);
            nomorSoal++;
            daftarSoal.insertAdjacentHTML('beforeend', html);
        });

        daftarSoal.addEventListener('click', function (e) {
            if (!e.target.classList.contains('btn-hapus-soal')) {
                return;
            }
        
            if (daftarSoal.querySelectorAll('.blok-soal').length > 1) {
                e.target.closest('.blok-soal').remove();
            } else {
                alert('Minimal harus ada 1 soal.');
            }
        });

        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function () {
                new bootstrap.Modal(document.getElementById('modalKuis')).show();
            });
        @endif
    </script>
@endsection