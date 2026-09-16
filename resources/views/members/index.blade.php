@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h4 class="fw-bold mb-1">Data Anggota</h4>

        <p class="text-muted mb-0">
            Kelola data anggota perpustakaan
        </p>
    </div>

    <a href="{{ route('members.create') }}" class="btn btn-primary">
        + Tambah Anggota
    </a>

</div>


<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Anggota</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($members as $member)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $member->member_code }}</strong>
                            </td>

                            <td>{{ $member->name }}</td>

                            <td>{{ $member->email ?: '-' }}</td>

                            <td>{{ $member->phone ?: '-' }}</td>

                            <td>{{ $member->address ?: '-' }}</td>

                            <td>

                                <a href="{{ route('members.edit', $member->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('members.destroy', $member->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus anggota ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7"
                                class="text-center py-5 text-muted">
                                Belum ada data anggota.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection