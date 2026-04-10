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
            padding: 1.5rem;
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
            vertical-align: middle;
        }

        .table th {
            background-color: #f9fafb;
            font-weight: 600;
        }

        .btn-sm-custom {
            padding: 0.3rem 0.6rem;
            border-radius: 6px;
            font-size: 0.85rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
    </style>

    <div class="dashboard-container">
        @php $role = auth()->user()->role; @endphp

        <div class="welcome">Selamat datang {{ ucfirst($role) }}</div>

        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin: 0;">Lendings</h2>
                @if ($role === 'staff')
                    <a href="{{ route('lending.create') }}" class="btn btn-primary">
                        <i class="mdi mdi-plus"></i> Add New
                    </a>
                @endif
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Borrower</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lendings as $lend)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lend->item->item_name }}</td>
                            <td>{{ $lend->qty }}</td>
                            <td>{{ $lend->person_name }}</td>
                            <td>{{ $lend->description ?? '-' }}</td>
                            <td>{{ $lend->created_at->format('d M Y') }}</td>
                            <td>
                                @if ($lend->is_returned)
                                    <span class="badge bg-success">Returned</span>
                                @else
                                    <span class="badge bg-warning text-dark">Not Returned</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($role === 'admin')
                                    <div class="action-buttons justify-content-center">

                                        {{-- Tombol Return (Pemicu Modal) --}}
                                        @if (!$lend->is_returned)
                                            <button type="button" class="btn btn-warning btn-sm-custom"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#returnModal"
                                                data-url="{{ route('lending.return', $lend->id) }}"
                                                data-item="{{ $lend->item->item_name }}">
                                                <i class="mdi mdi-restore"></i> Return
                                            </button>
                                        @else
                                            <button class="btn btn-outline-success btn-sm-custom" disabled>
                                                <i class="mdi mdi-check-all"></i> Done
                                            </button>
                                        @endif

                                        {{-- Tombol Delete (Pemicu Modal) --}}
                                        <button type="button" class="btn btn-danger btn-sm-custom"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal"
                                            data-url="{{ route('lending.destroy', $lend->id) }}">
                                            <i class="mdi mdi-trash-can"></i>
                                        </button>

                                    </div>
                                @else
                                    <small class="text-muted italic">Read Only</small>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No lending data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="returnModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="returnForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Pengembalian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin barang <strong id="returnItemName"></strong> sudah dikembalikan?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Ya, Sudah Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title text-danger">Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tindakan ini tidak dapat dibatalkan. Apakah Anda yakin ingin menghapus data peminjaman ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Logika Dinamis Modal Return
            const returnModal = document.getElementById('returnModal');
            returnModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-url');
                const itemName = button.getAttribute('data-item');
                
                document.getElementById('returnForm').setAttribute('action', url);
                document.getElementById('returnItemName').textContent = itemName;
            });

            // Logika Dinamis Modal Delete
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-url');
                
                document.getElementById('deleteForm').setAttribute('action', url);
            });
        });
    </script>
@endsection