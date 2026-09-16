@extends('layouts.app')

@section('title', 'Data Buku')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Data Buku</h4>
        <p class="text-muted mb-0">
            Kelola data buku perpustakaan
        </p>
    </div>

    <a href="{{ route('books.create') }}" class="btn btn-primary">
        + Tambah Buku
    </a>
</div>

<div class="card">
    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>ISBN</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($books as $book)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $book->title }}</strong>
                            </td>

                            <td>
                                {{ $book->category->name ?? '-' }}
                            </td>

                            <td>{{ $book->author }}</td>

                            <td>{{ $book->publisher ?: '-' }}</td>

                            <td>{{ $book->year ?: '-' }}</td>

                            <td>{{ $book->isbn ?: '-' }}</td>

                            <td>
                                <strong>{{ $book->stock }}</strong>
                            </td>

                            <td>

                                <a href="{{ route('books.edit', $book->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('books.destroy', $book->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9"
                                class="text-center py-5 text-muted">
                                Belum ada data buku.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection