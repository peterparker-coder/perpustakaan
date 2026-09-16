@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-1">Edit Buku</h4>
    <p class="text-muted mb-0">
        Perbarui data buku
    </p>
</div>

<div class="card">

    <div class="card-body">

        <form action="{{ route('books.update', $book->id) }}"
              method="POST">

            @csrf
            @method('PUT')

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
                                {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Judul Buku
                    </label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title', $book->title) }}"
                           required>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Penulis
                    </label>

                    <input type="text"
                           name="author"
                           class="form-control"
                           value="{{ old('author', $book->author) }}"
                           required>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Penerbit
                    </label>

                    <input type="text"
                           name="publisher"
                           class="form-control"
                           value="{{ old('publisher', $book->publisher) }}">

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">
                        Tahun Terbit
                    </label>

                    <input type="number"
                           name="year"
                           class="form-control"
                           value="{{ old('year', $book->year) }}"
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
                           value="{{ old('isbn', $book->isbn) }}">

                </div>


                <div class="col-md-4 mb-4">

                    <label class="form-label fw-semibold">
                        Stok
                    </label>

                    <input type="number"
                           name="stock"
                           class="form-control"
                           value="{{ old('stock', $book->stock) }}"
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
                Simpan Perubahan
            </button>

        </form>

    </div>

</div>

@endsection