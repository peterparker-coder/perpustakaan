@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-1">Tambah Buku</h4>
    <p class="text-muted mb-0">
        Tambahkan data buku baru
    </p>
</div>

<div class="card">

    <div class="card-body">

        <form action="{{ route('books.store') }}" method="POST">

            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Kategori
                    </label>

                    <select name="category_id"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('category_id')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Judul Buku
                    </label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title') }}"
                           required>

                    @error('title')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Penulis
                    </label>

                    <input type="text"
                           name="author"
                           class="form-control"
                           value="{{ old('author') }}"
                           required>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Penerbit
                    </label>

                    <input type="text"
                           name="publisher"
                           class="form-control"
                           value="{{ old('publisher') }}">

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">
                        Tahun Terbit
                    </label>

                    <input type="number"
                           name="year"
                           class="form-control"
                           value="{{ old('year') }}"
                           min="1000"
                           max="{{ date('Y') }}">

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">
                        ISBN
                    </label>

                    <input type="text"
                           name="isbn"
                           class="form-control"
                           value="{{ old('isbn') }}">

                </div>


                <div class="col-md-4 mb-4">

                    <label class="form-label fw-semibold">
                        Stok
                    </label>

                    <input type="number"
                           name="stock"
                           class="form-control"
                           value="{{ old('stock', 0) }}"
                           min="0"
                           required>

                </div>

            </div>


            <a href="{{ route('books.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

            <button type="submit"
                    class="btn btn-primary">
                Simpan Buku
            </button>

        </form>

    </div>

</div>

@endsection