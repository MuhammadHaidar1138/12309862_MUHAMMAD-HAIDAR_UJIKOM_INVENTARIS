@extends('layout.app')

@section('content')
    <style>
        .dashboard-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f3f4f6;
            padding: 3rem 2rem;
            font-family: 'Inter', sans-serif;
        }

        .welcome {
            text-align: left;
            font-size: 1.125rem;
            font-weight: 600;
            color: #4b5563;
            margin-top: 2rem;
            margin-bottom: 1.5rem;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        .table th,
        .table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        .table th {
            background-color: #f9fafb;
            font-weight: 600;
        }

        .table td .btn {
            border: none;
            padding: 0.3rem 0.5rem;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #0d6efd;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }
    </style>


    <div class="dashboard-container">
        <div class="welcome">Categories</div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 style="font-size: 1.25rem; font-weight: 600;">Categories</h2>
                <a class="btn btn-primary d-flex align-items-center gap-1" href="{{ route('category.create') }}">
                    <i class="mdi mdi-plus"></i>
                    Add New
                </a>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Name</th>
                        <th>Division PJ</th>
                        <th>Total Items</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->division_pj }}</td>
                            <td>{{ $category->items_sum_total_stock ?? 0 }}</td>

                            <td class="action-buttons">
                                <a href="{{ route('category.edit', $category->id) }}"
                                    class="btn btn-primary d-flex align-items-center justify-content-center"
                                    style="width: 38px; height: 38px; padding: 0;">
                                    <i class="mdi mdi-pencil"></i>
                                </a>

                                <button type="button"
                                    class="btn btn-danger d-flex align-items-center justify-content-center"
                                    style="width: 38px; height: 38px; padding: 0;" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $category->id }}">
                                    <i class="mdi mdi-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No categories found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @foreach ($categories as $category)
                <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                Yakin hapus kategori <b>{{ $category->category_name }}</b>?
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Batal
                                </button>

                                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
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
@endsection
