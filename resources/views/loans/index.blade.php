@extends('layouts.app')

@section('title', 'Peminjaman')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h4 class="fw-bold mb-1">Peminjaman</h4>

        <p class="text-muted mb-0">
            Kelola data peminjaman buku
        </p>
    </div>

    <a href="{{ route('loans.create') }}" class="btn btn-primary">
        + Tambah Peminjaman
    </a>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($loans as $loan)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $loan->member->name ?? '-' }}</strong>
                            </td>

                            <td>
                                {{ $loan->book->title ?? '-' }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($loan->loan_date)->format('d-m-Y') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($loan->due_date)->format('d-m-Y') }}
                            </td>

                            <td>

                                @if($loan->status === 'Dipinjam')

                                    <span class="badge bg-warning text-dark">
                                        Dipinjam
                                    </span>

                                @else

                                    <span class="badge bg-success">
                                        Dikembalikan
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('loans.edit', $loan->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('loans.destroy', $loan->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data peminjaman ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7"
                                class="text-center py-5 text-muted">
                                Belum ada data peminjaman.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection