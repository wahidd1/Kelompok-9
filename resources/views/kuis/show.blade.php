@extends('layouts.app')

@section('title', $kuis->judul)

@section('content')
    <h2 class="mb-3">{{ $kuis->judul }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    @if ($kuis->pertanyaan->isEmpty())
        <p>Kuis ini belum punya soal.</p>
    @else
        <form action="{{ route('kuis.submit', $kuis->id_kuis) }}" method="POST" id="formKuis">
            @csrf

        @foreach ($kuis->pertanyaan as $i => $soal)
            <div class="soal card p-3 mb-3" @if ($i > 0) style="display:none" @endif>
                <p class="mb-3">
                    <b>Soal {{ $i + 1 }} dari {{ $kuis->pertanyaan->count() }}</b><br>
                    {{ $soal->pertanyaan }}
                </p>

                @foreach ($soal->pilihan as $j => $opsi)
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" 
                               name="jawaban[{{ $soal->id_pertanyaan }}]" 
                               id="pilihan{{ $opsi->id_pilihan }}" 
                               value="{{ $opsi->id_pilihan }}">
                        <label class="form-check-label" for="pilihan{{ $opsi->id_pilihan }}">
                            {{ chr(65 + $j) }}. {{ $opsi->opsi }}
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <button type="button" id="btnSelanjutnya" class="btn btn-primary">Selanjutnya</button>
        <button type="submit" id="btnSubmit" class="btn btn-success" style="display:none">Submit</button>
    </form>

    <script>
        const daftarSoal = document.querySelectorAll('.soal');
        const btnSelanjutnya = document.getElementById('btnSelanjutnya');
        const btnSubmit = document.getElementById('btnSubmit');
        let aktif = 0;

        function tampilkan() {
            daftarSoal.forEach(function (el, i) {
                el.style.display = (i === aktif) ? 'block' : 'none';
            });

            const terakhir = (aktif === daftarSoal.length - 1);
            btnSelanjutnya.style.display = terakhir ? 'none' : 'inline-block';
            btnSubmit.style.display = terakhir ? 'inline-block' : 'none';
        }

        function sudahDijawab() {
            return daftarSoal[aktif].querySelector('input:checked') !== null;
        }

        btnSelanjutnya.addEventListener('click', function () {
            if (!sudahDijawab()) {
                alert('Pilih salah satu jawaban dulu.');
                return;
            }
            aktif++;
            tampilkan();
        });

        document.getElementById('formKuis').addEventListener('submit', function (e) {
            if (!sudahDijawab()) {
                e.preventDefault();
                alert('Pilih salah satu jawaban dulu.');
            }
        });

        tampilkan();
    </script>
@endif

@endsection