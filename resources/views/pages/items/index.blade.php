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
        <div class="welcome">Item</div>

        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 style="font-size: 1.25rem; font-weight: 600;">Items</h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('item.export') }}" class="btn btn-success">
                        Export Excel
                    </a>
                    <a href="{{ route('item.create') }}" class="btn btn-primary">
                        Add New
                    </a>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Total</th>
                        <th>Repair</th>
                        <th>Lending</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->category->category_name ?? '-' }}</td>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->total_stock }}</td>
                            <td>{{ $item->total_repaired }}</td>
                            <td>{{ $item->total_borrowed }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('item.edit', $item->id) }}"
                                    class="btn btn-primary d-flex align-items-center justify-content-center"
                                    style="width: 38px; height: 38px; padding: 0;">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <form action="{{ route('item.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin mau hapus item ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn btn-danger d-flex align-items-center justify-content-center"
                                    style="width: 38px; height: 38px; padding: 0;" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $item->id }}">
                                        <i class="mdi mdi-trash-can"></i>
                                    </button>
                                </form>

                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                Yakin mau hapus <b>{{ $item->item_name }}</b>?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>

                                                <form action="{{ route('item.destroy', $item->id) }}" method="POST">
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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Data kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
