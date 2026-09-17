@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')

<div class="mb-4">

    <h4 class="fw-bold mb-1">Edit Peminjaman</h4>

    <p class="text-muted mb-0">
        Perbarui data peminjaman buku
    </p>

</div>

<div class="card">

    <div class="card-body">

        <form action="{{ route('loans.update', $loan->id) }}"
              method="POST">

            @csrf
            @method('PUT')


            <div class="mb-3">

                <label class="form-label">Anggota</label>

                <select name="member_id"
                        class="form-select @error('member_id') is-invalid @enderror">

                    @foreach($members as $member)

                        <option value="{{ $member->id }}"
                            {{ old('member_id', $loan->member_id) == $member->id ? 'selected' : '' }}>

                            {{ $member->member_code }} - {{ $member->name }}

                        </option>

                    @endforeach

                </select>

                @error('member_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="mb-3">

                <label class="form-label">Buku</label>

                <select name="book_id"
                        class="form-select @error('book_id') is-invalid @enderror">

                    @foreach($books as $book)

                        <option value="{{ $book->id }}"
                            {{ old('book_id', $loan->book_id) == $book->id ? 'selected' : '' }}>

                            {{ $book->title }} (Stok: {{ $book->stock }})

                        </option>

                    @endforeach

                </select>

                @error('book_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="mb-3">

                <label class="form-label">Tanggal Peminjaman</label>

                <input type="date"
                       name="loan_date"
                       class="form-control @error('loan_date') is-invalid @enderror"
                       value="{{ old('loan_date', $loan->loan_date) }}">

                @error('loan_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="mb-3">

                <label class="form-label">Batas Pengembalian</label>

                <input type="date"
                       name="due_date"
                       class="form-control @error('due_date') is-invalid @enderror"
                       value="{{ old('due_date', $loan->due_date) }}">

                @error('due_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="mb-4">

                <label class="form-label">Status</label>

                <select name="status"
                        class="form-select @error('status') is-invalid @enderror">

                    <option value="Dipinjam"
                        {{ old('status', $loan->status) == 'Dipinjam' ? 'selected' : '' }}>
                        Dipinjam
                    </option>

                    <option value="Dikembalikan"
                        {{ old('status', $loan->status) == 'Dikembalikan' ? 'selected' : '' }}>
                        Dikembalikan
                    </option>

                </select>

                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <a href="{{ route('loans.index') }}"
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