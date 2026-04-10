<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.0.96/css/materialdesignicons.min.css" rel="stylesheet">

<div class="container-xxl flex-grow-1 container-p-y mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column">
            <h1 class="mb-2 fw-bold">Items</h1>
            <p>Edit Item</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Edit Item</h5>
        </div>

        <form action="{{ route('item.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                {{-- NAME --}}
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-2 col-form-label">Name</label>

                    <div class="col-sm-10">
                        <input type="text" name="item_name"
                            value="{{ old('item_name', $item->item_name) }}"
                            placeholder="Input item name"
                            class="form-control @error('item_name') is-invalid @enderror">

                        @error('item_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- CATEGORY (DINAMIS 🔥) --}}
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-2 col-form-label">Category</label>

                    <div class="col-sm-10">
                        <select name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror">

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @selected(old('category_id', $item->category_id) == $category->id)>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach

                        </select>

                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- TOTAL --}}
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-2 col-form-label">Total</label>

                    <div class="col-sm-10">
                        <input type="number" name="total_stock"
                            value="{{ old('total_stock', $item->total_stock) }}"
                            placeholder="Input total"
                            class="form-control @error('total_stock') is-invalid @enderror">

                        @error('total_stock')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- BROKEN --}}
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-2 col-form-label">
                        New Broken Item 
                    </label>

                    <div class="col-sm-10">
                        <input type="number" name="broken_item"
                            value="{{ old('broken_item') }}"
                            placeholder="Input broken item"
                            class="form-control @error('broken_item') is-invalid @enderror">

                        @error('broken_item')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="col-sm-10 d-flex">
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-1">
                        <i class="mdi mdi-content-save"></i> Update
                    </button>

                    <a href="{{ route('item.index') }}" class="btn btn-secondary ms-2">
                        Batal
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>