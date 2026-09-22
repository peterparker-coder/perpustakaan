@extends('layouts.app')

@section('title', 'Proses Pengembalian')

@section('content')

<div class="mb-4">

    <h4 class="fw-bold mb-1">Proses Pengembalian</h4>

    <p class="text-muted mb-0">
        Proses pengembalian buku dan hitung denda otomatis
    </p>

</div>


<div class="card">

    <div class="card-body">

        <form action="{{ route('returns.store') }}" method="POST">

            @csrf


            <div class="mb-3">

                <label class="form-label">
                    Peminjaman
                </label>

                <select name="loan_id"
                        class="form-select @error('loan_id') is-invalid @enderror">

                    <option value="">
                        -- Pilih Peminjaman --
                    </option>

                    @foreach($loans as $loan)

                        <option value="{{ $loan->id }}"
                            {{ old('loan_id') == $loan->id ? 'selected' : '' }}>

                            {{ $loan->member->name }}
                            -
                            {{ $loan->book->title }}
                            -
                            Batas:
                            {{ \Carbon\Carbon::parse($loan->due_date)->format('d-m-Y') }}

                        </option>

                    @endforeach

                </select>

                @error('loan_id')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <div class="mb-4">

                <label class="form-label">
                    Tanggal Pengembalian
                </label>

                <input type="date"
                       name="return_date"
                       class="form-control @error('return_date') is-invalid @enderror"
                       value="{{ old('return_date', date('Y-m-d')) }}">

                @error('return_date')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <div class="alert alert-info border-0">

                <strong>Informasi Denda</strong>

                <p class="mb-0 mt-1">
                    Denda sebesar Rp2.000 per hari jika melewati batas pengembalian.
                </p>

            </div>


            <a href="{{ route('returns.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>


            <button type="submit"
                    class="btn btn-primary">

                Proses Pengembalian

            </button>

        </form>

    </div>

</div>

@endsection