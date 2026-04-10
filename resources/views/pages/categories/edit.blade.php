<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.0.96/css/materialdesignicons.min.css" rel="stylesheet">

<div class="container mt-4">

    <h3>Edit Category</h3>

    <div class="card p-3 mt-3">

        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Category Name</label>
                <input type="text" name="category_name" class="form-control"
                    value="{{ old('category_name', $category->category_name) }}">
            </div>

            {{-- Division --}}
            <div class="mb-3">
                <label>Division PJ</label>
                <select name="division_pj" class="form-select">
                    <option value="SARPRAS" {{ $category->division_pj == 'SARPRAS' ? 'selected' : '' }}>SARPRAS</option>
                    <option value="TATA USAHA" {{ $category->division_pj == 'TATA USAHA' ? 'selected' : '' }}>TATA USAHA
                    </option>
                    <option value="TEFA" {{ $category->division_pj == 'TEFA' ? 'selected' : '' }}>TEFA</option>
                </select>
            </div>

            <button class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('category.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
