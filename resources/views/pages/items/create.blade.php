    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.0.96/css/materialdesignicons.min.css" rel="stylesheet">

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex flex-column">
                <h1 class="mb-2 fw-bold">Items</h1>
                <p>Add Item</p>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add new item</h5>
            </div>
            <form action="{{ route('item.store') }}" method="POST">
                @csrf
                <div class="card-body">

                    {{-- input --}}
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-2 col-form-label">
                            Name
                        </label>

                        <div class="col-sm-10">
                            <input type="text" name="item_name" value="{{ old('item_name') }}"
                                placeholder="Input item name"
                                class="form-control @error('item_name') is-invalid @enderror">

                            @error('item_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- /input --}}

                    {{-- input --}}
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-2 col-form-label">
                            Category
                        </label>

                        <div class="col-sm-10">
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">

                                <option value="">-- Pilih Category --</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- /input --}}

                    {{-- input --}}
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-2 col-form-label">
                            Total
                        </label>

                        <div class="col-sm-10">
                            <input type="number" name="total_stock" value="{{ old('total_stock') }}"
                                placeholder="Input total"
                                class="form-control @error('total_stock') is-invalid @enderror">

                            @error('total')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- /input --}}

                    <div class="col-sm-10 d-flex">

                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-1">
                            <i class="mdi mdi-content-save"></i> Save
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
