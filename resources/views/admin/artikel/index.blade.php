@extends('layouts.app')

@section('title', 'Daftar Artikel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Artikel</h2>
    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary">Tambah</a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@forelse ($artikels as $item)
    <div	class="card	mb-2	p-3	d-flex	flex-row	justify-content-between	align-items-center">
        <div>
            <b>{{	$item->judul	}}</b><br>
            <small	class="text-muted">{{	$item->tanggalPublish->format('d	M	Y')	}}</small>
        </div>
        <form	action="{{	route('admin.artikel.destroy',	$item->id_artikel)	}}"	method="POST"
                onsubmit="return	confirm('Yakin	mau	hapus	artikel	ini?')">
            @csrf
            @method('DELETE')
            <button	type="submit"	class="btn	btn-sm	btn-danger">Hapus</button>
        </form>
    </div>
    
@empty
    <p>Tidak ada artikel yang ditemukan.</p>
@endforelse
@endsection