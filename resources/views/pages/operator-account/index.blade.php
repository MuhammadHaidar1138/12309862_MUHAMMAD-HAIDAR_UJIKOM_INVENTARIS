@extends('layout.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" style="margin-top: 70px;">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex flex-column">
                <h1 class="mb-2 fw-bold">Operator Accounts</h1>
                <p>Manage operator accounts</p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('operator-account.export') }}" class="btn btn-success d-flex align-items-center gap-1">
                    <i class="mdi mdi-file-document-arrow-right"></i>
                    Export Excel
                </a>

                <a href="{{ route('operator-account.create') }}" class="btn btn-primary d-flex align-items-center gap-1">
                    <i class="mdi mdi-plus"></i>
                    Add New
                </a>
            </div>
        </div>
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
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($operators as $index => $op)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $op->name }}</td>
                                    <td>{{ $op->email }}</td>
                                    <td class="text-center d-flex justify-content-center gap-2">
                                        <a href="{{ route('operator-account.edit', $op->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $op->id }}">
                                            <i class="mdi mdi-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        No operator accounts found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                    @foreach ($operators as $op)
                        <div class="modal fade" id="deleteModal{{ $op->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        Yakin ingin menghapus operator <b>{{ $op->name }}</b>?
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                        <form action="{{ route('operator-account.destroy', $op->id) }}" method="POST">
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

            </div>
        </div>

    </div>
@endsection
