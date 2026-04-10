<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.0.96/css/materialdesignicons.min.css" rel="stylesheet">

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column">
            <h1 class="mb-2 fw-bold">Categories</h1>
            <p>Add, update, delete categories</p>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add new category</h5>
        </div>
        <form action="{{ route('category.store') }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- Name --}}
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-2 col-form-label">Name</label>

                    <div class="col-sm-10">
                        <input type="text" name="category_name" value="{{ old('category_name') }}"
                            class="form-control @error('category_name') is-invalid @enderror">

                        @error('category_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Division --}}
                <div class="row mb-3 align-items-center">
                    <label class="col-sm-2 col-form-label">Division PJ</label>

                    <div class="col-sm-10">
                        <select name="division_pj" class="form-select @error('division_pj') is-invalid @enderror">

                            <option value="SARPRAS">Sarpras</option>
                            <option value="TATA USAHA">Tata Usaha</option>
                            <option value="TEFA">TEFA</option>
                        </select>

                        @error('division_pj')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-10 d-flex">
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-1">
                        <i class="mdi mdi-content-save"></i> Save
                    </button>

                    <a href="{{ route('category.index') }}" class="btn btn-secondary ms-2">
                        Batal
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
