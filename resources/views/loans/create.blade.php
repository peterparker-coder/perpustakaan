@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')

<div class="mb-4">

    <h4 class="fw-bold mb-1">Tambah Peminjaman</h4>

    <p class="text-muted mb-0">
        Tambahkan transaksi peminjaman buku
    </p>

</div>

<div class="card">

    <div class="card-body">

        <form action="{{ route('loans.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">Anggota</label>

                <select name="member_id"
                        class="form-select @error('member_id') is-invalid @enderror">

                    <option value="">-- Pilih Anggota --</option>

                    @foreach($members as $member)

                        <option value="{{ $member->id }}"
                            {{ old('member_id') == $member->id ? 'selected' : '' }}>

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

                    <option value="">-- Pilih Buku --</option>

                    @foreach($books as $book)

                        <option value="{{ $book->id }}"
                            {{ old('book_id') == $book->id ? 'selected' : '' }}>

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
                       value="{{ old('loan_date', date('Y-m-d')) }}">

                @error('loan_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="mb-4">

                <label class="form-label">Batas Pengembalian</label>

                <input type="date"
                       name="due_date"
                       class="form-control @error('due_date') is-invalid @enderror"
                       value="{{ old('due_date') }}">

                @error('due_date')
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
                Simpan Peminjaman
            </button>

        </form>

    </div>

</div>

@endsection