@extends('layout.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.0.96/css/materialdesignicons.min.css" rel="stylesheet">

    <div class="container-xxl flex-grow-1 container-p-y" style="padding: 3rem 2rem; font-family: 'Inter', sans-serif;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex flex-column">
                <h1 class="mb-2 fw-bold" style="font-size: 1.75rem;">Lendings</h1>
                <p class="text-muted">Create New Lending Record</p>
            </div>
        </div>

        <div class="card mb-4"
            style="background: #fff; border-radius: 12px; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
            <div class="card-header bg-transparent border-bottom p-4">
                <h5 class="mb-0 fw-semibold">Add new lending</h5>
            </div>

            <form action="{{ route('lending.store') }}" method="POST">
                @csrf
                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row mb-4 align-items-center">
                        <label class="col-sm-2 col-form-label fw-medium">Person Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="person_name" value="{{ old('person_name') }}"
                                placeholder="Input borrower name"
                                class="form-control @error('person_name') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="row mb-4 align-items-center">
                        <label for="staff_name" class="col-sm-2 col-form-label fw-medium">Nama Staff</label>
                        <div class="col-sm-10">
                            <input type="text" name="staff_name" id="staff_name"
                                placeholder="Input staff name (Pemberi barang)"
                                class="form-control @error('staff_name') is-invalid @enderror" 
                                value="{{ old('staff_name') }}" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label fw-medium pt-2">Items</label>
                        <div class="col-sm-10">
                            <div id="items-wrapper">
                                <div class="row mb-3 item-row">
                                    <div class="col-md-6">
                                        <select name="item_id[]" class="form-select" required>
                                            <option value="">-- Pilih Item --</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->item_name }} (Stock:
                                                    {{ $item->total_stock - $item->total_borrowed }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" name="total[]" class="form-control" placeholder="Qty" required
                                            min="1">
                                    </div>
                                </div>
                            </div>

                            <button type="button"
                                class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1 mt-1" id="add-item">
                                <i class="mdi mdi-plus-circle-outline"></i> Add More Item
                            </button>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label fw-medium">Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" rows="3" class="form-control" placeholder="Optional notes...">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10 offset-sm-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-1">
                                <i class="mdi mdi-content-save"></i> Save Lending
                            </button>
                            <a href="{{ route('lending.index') }}" class="btn btn-secondary text-white">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Script Dynamic Input --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#add-item').click(function() {
                $('#items-wrapper').append(`
                    <div class="row mb-3 item-row animate__animated animate__fadeIn">
                        <div class="col-md-6">
                            <select name="item_id[]" class="form-select" required>
                                <option value="">-- Pilih Item --</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->item_name }} (Stock: {{ $item->total_stock - $item->total_borrowed }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="total[]" class="form-control" placeholder="Qty" required min="1">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-item" style="height: 38px; width: 100%;">
                                <i class="mdi mdi-close"></i>
                            </button>
                        </div>
                    </div>
                `);
            });

            $(document).on('click', '.remove-item', function() {
                $(this).closest('.item-row').remove();
            });
        });
    </script>
@endsection