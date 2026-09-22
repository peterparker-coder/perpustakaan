@extends('layouts.app')

@section('title', 'Riwayat')

@section('content')

<div class="mb-4">

    <h4 class="fw-bold mb-1">Riwayat</h4>

    <p class="text-muted mb-0">
        Riwayat seluruh transaksi peminjaman dan pengembalian
    </p>

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
                        <th>Tgl. Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Tgl. Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($loans as $loan)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>
                                    {{ $loan->member->name ?? '-' }}
                                </strong>
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
                                @if($loan->returnBook)

                                    {{ $loan->returnBook->return_date->format('d-m-Y') }}

                                @else

                                    -

                                @endif
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

                                @if($loan->returnBook)

                                    Rp {{ number_format($loan->returnBook->fine, 0, ',', '.') }}

                                @else

                                    -

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-5 text-muted">

                                Belum ada riwayat transaksi.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection