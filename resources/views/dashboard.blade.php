@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="mb-4">

    <h4 class="fw-bold mb-1">Dashboard</h4>

    <p class="text-muted mb-0">
        Ringkasan sistem pengelolaan perpustakaan
    </p>

</div>


<!-- STATISTIK -->

<div class="row g-4 mb-4">

    <div class="col-md-6 col-xl-3">

        <div class="card h-100">

            <div class="card-body">

                <p class="text-muted mb-2">
                    Total Buku
                </p>

                <h3 class="fw-bold mb-0">
                    {{ $totalBooks }}
                </h3>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl-3">

        <div class="card h-100">

            <div class="card-body">

                <p class="text-muted mb-2">
                    Total Kategori
                </p>

                <h3 class="fw-bold mb-0">
                    {{ $totalCategories }}
                </h3>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl-3">

        <div class="card h-100">

            <div class="card-body">

                <p class="text-muted mb-2">
                    Total Anggota
                </p>

                <h3 class="fw-bold mb-0">
                    {{ $totalMembers }}
                </h3>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl-3">

        <div class="card h-100">

            <div class="card-body">

                <p class="text-muted mb-2">
                    Sedang Dipinjam
                </p>

                <h3 class="fw-bold mb-0">
                    {{ $totalLoans }}
                </h3>

            </div>

        </div>

    </div>

</div>


<!-- INFORMASI TRANSAKSI -->

<div class="row g-4 mb-4">

    <div class="col-md-6">

        <div class="card h-100">

            <div class="card-body">

                <p class="text-muted mb-2">
                    Total Pengembalian
                </p>

                <h3 class="fw-bold mb-0">
                    {{ $totalReturns }}
                </h3>

            </div>

        </div>

    </div>


    <div class="col-md-6">

        <div class="card h-100">

            <div class="card-body">

                <p class="text-muted mb-2">
                    Total Denda
                </p>

                <h3 class="fw-bold mb-0">
                    Rp {{ number_format($totalFines, 0, ',', '.') }}
                </h3>

            </div>

        </div>

    </div>

</div>


<!-- PEMINJAMAN TERBARU -->

<div class="card">

    <div class="card-body">

        <div class="mb-3">

            <h5 class="fw-bold mb-1">
                Peminjaman Terbaru
            </h5>

            <p class="text-muted mb-0">
                Lima transaksi peminjaman terakhir
            </p>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($recentLoans as $loan)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

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

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="text-center py-4 text-muted">

                                Belum ada transaksi peminjaman.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection