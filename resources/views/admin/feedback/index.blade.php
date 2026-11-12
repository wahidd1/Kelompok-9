@extends('layouts.app')

@section('title', 'Kelola Feedback')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Feedback Pengguna</h2>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th width="5%">No</th>
                <th>Username</th>
                <th>Isi Feedback</th>
                <th>Tanggal</th>
                <th>Status</th> {{-- Tambahan --}}
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($feedback as $index => $item)
            <tr>
                <td>{{ $feedback->firstItem() + $index }}</td>
                <td>{{ $item->pengguna->username ?? 'Anonim' }}</td>
                <td>{{ $item->isi_feedback }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                
                {{-- Kolom Status --}}
                <td>
                    @if($item->id_admin)
                        <span class="badge bg-success">Disetujui</span>
                    @else
                        <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </td>

                <td>
                    {{-- Tombol Setujui disembunyikan kalau sudah disetujui --}}
                    @unless ($item->id_admin)
                        <form action="{{ route('admin.feedback.approve', $item->id_feedback) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT') 
                            <button class="btn btn-sm btn-success" onclick="return confirm('Setujui feedback ini?')">Setujui</button>
                        </form>
                    @endunless
                    
                    {{-- Tombol Hapus --}}
                    <form action="{{ route('admin.feedback.destroy', $item->id_feedback) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus feedback ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada feedback yang masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="mt-3 d-flex justify-content-center">
    {{ $feedback->links() }}
</div>
@endsection