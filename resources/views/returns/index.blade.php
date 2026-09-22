@extends('layouts.app')

@section('title', 'Pengembalian')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h4 class="fw-bold mb-1">Pengembalian</h4>

        <p class="text-muted mb-0">
            Kelola data pengembalian buku dan denda
        </p>
    </div>

    <a href="{{ route('returns.create') }}" class="btn btn-primary">
        + Proses Pengembalian
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
                        <th>Batas Kembali</th>
                        <th>Tanggal Kembali</th>
                        <th>Terlambat</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($returns as $return)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>
                                    {{ $return->loan->member->name ?? '-' }}
                                </strong>
                            </td>

                            <td>
                                {{ $return->loan->book->title ?? '-' }}
                            </td>

                            <td>
                                {{ $return->loan->due_date
                                    ? \Carbon\Carbon::parse($return->loan->due_date)->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $return->return_date
                                    ? $return->return_date->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td>
                                {{ $return->late_days }} hari
                            </td>

                            <td>
                                <strong>
                                    Rp {{ number_format($return->fine, 0, ',', '.') }}
                                </strong>
                            </td>

                            <td>

                                <form action="{{ route('returns.destroy', $return->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus data pengembalian ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="text-center py-5 text-muted">

                                Belum ada data pengembalian.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection