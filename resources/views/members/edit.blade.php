@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')

<div class="mb-4">

    <h4 class="fw-bold mb-1">Edit Anggota</h4>

    <p class="text-muted mb-0">
        Perbarui data anggota perpustakaan
    </p>

</div>


<div class="card">

    <div class="card-body">

        <form action="{{ route('members.update', $member->id) }}"
              method="POST">

            @csrf
            @method('PUT')


            <div class="mb-3">
                <label class="form-label">Kode Anggota</label>

                <input type="text"
                       name="member_code"
                       class="form-control @error('member_code') is-invalid @enderror"
                       value="{{ old('member_code', $member->member_code) }}">

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
                       value="{{ old('name', $member->name) }}">

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
                       value="{{ old('email', $member->email) }}">

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
                       value="{{ old('phone', $member->phone) }}">

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
                          class="form-control @error('address') is-invalid @enderror">{{ old('address', $member->address) }}</textarea>

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
                Simpan Perubahan
            </button>

        </form>

    </div>

</div>

@endsection