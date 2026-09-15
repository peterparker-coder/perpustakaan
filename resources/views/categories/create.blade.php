@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-1">Tambah Kategori</h4>
    <p class="text-muted mb-0">
        Tambahkan kategori buku baru
    </p>
</div>

<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <form action="{{ route('categories.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Nama Kategori
                </label>

                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name') }}"
                       required>

                @error('name')
                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Deskripsi
                </label>

                <textarea name="description"
                          class="form-control"
                          rows="4">{{ old('description') }}</textarea>

            </div>

            <a href="{{ route('categories.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

            <button type="submit"
                    class="btn btn-primary">
                Simpan
            </button>

        </form>

    </div>

</div>

@endsection