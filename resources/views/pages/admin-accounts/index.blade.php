@extends('layout.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" style="margin-top: 70px;">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex flex-column">
                <h1 class="mb-2 fw-bold">Admin Accounts</h1>
                <p>Add, update, delete admin accounts</p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin-account.export') }}" class="btn btn-success d-flex align-items-center gap-1">
                    <i class="mdi mdi-file-document-arrow-right"></i>
                    Export Excel
                    </a>

                    <a href="{{ route('admin-account.create') }}" class="btn btn-primary d-flex align-items-center gap-1">
                        <i class="mdi mdi-plus"></i>
                        Add New
                    </a>
            </div>
        </div>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($admins as $index => $admin)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>

                                    <td class="text-center d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin-account.edit', $admin->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $admin->id }}">
                                            <i class="mdi mdi-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        No admin accounts found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

        {{-- MODAL DELETE --}}
        @foreach ($admins as $admin)
            <div class="modal fade" id="deleteModal{{ $admin->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            Yakin hapus admin <b>{{ $admin->name }}</b>?
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>

                            <form action="{{ route('admin-account.destroy', $admin->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
