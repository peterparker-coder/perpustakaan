@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')

<div class="mb-4">

    <h4 class="fw-bold mb-1">Tambah Anggota</h4>

    <p class="text-muted mb-0">
        Tambahkan data anggota baru
    </p>

</div>


<div class="card">

    <div class="card-body">

        <form action="{{ route('members.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Kode Anggota</label>

                <input type="text"
                       name="member_code"
                       class="form-control @error('member_code') is-invalid @enderror"
                       value="{{ old('member_code') }}"
                       placeholder="Contoh: AG001">

                @error('member_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">Nama Anggota</label>

                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       placeholder="Masukkan nama anggota">

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">Email</label>

                <input type="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email">

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">No. HP</label>

                <input type="text"
                       name="phone"
                       class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone') }}"
                       placeholder="Masukkan nomor HP">

                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-4">
                <label class="form-label">Alamat</label>

                <textarea name="address"
                          rows="4"
                          class="form-control @error('address') is-invalid @enderror"
                          placeholder="Masukkan alamat">{{ old('address') }}</textarea>

                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <a href="{{ route('members.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

            <button type="submit"
                    class="btn btn-primary">
                Simpan Anggota
            </button>

        </form>

    </div>

</div>

@endsection