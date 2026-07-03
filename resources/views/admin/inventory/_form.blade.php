@php
    $galleryText = old('gallery_input', implode(PHP_EOL, $inventory->gallery ?? []));
    $currentMainImage = old('main_image', $inventory->main_image);
    $currentGallery = old('gallery_input')
        ? preg_split('/\r\n|\r|\n/', old('gallery_input'))
        : ($inventory->gallery ?? []);
    $featureItems = old('features', $inventory->features ?? ['']);
    if (empty($featureItems)) {
        $featureItems = [''];
    }
@endphp

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="status" class="col-form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="available" @selected(old('status', $inventory->status) === 'available')>Available</option>
                <option value="sold" @selected(old('status', $inventory->status) === 'sold')>Sold</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="year" class="col-form-label">Year</label>
            <input id="year" name="year" type="number" class="form-control" value="{{ old('year', $inventory->year) }}" placeholder="2024">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group pt-md-4 mt-md-2">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" value="1" @checked(old('is_featured', $inventory->is_featured))>
                <label class="custom-control-label" for="is_featured">Show on home page</label>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="make" class="col-form-label">Make</label>
            <input id="make" name="make" type="text" class="form-control" value="{{ old('make', $inventory->make) }}" placeholder="Toyota">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="model" class="col-form-label">Model</label>
            <input id="model" name="model" type="text" class="form-control" value="{{ old('model', $inventory->model) }}" placeholder="Sequoia">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="trim" class="col-form-label">Trim</label>
            <input id="trim" name="trim" type="text" class="form-control" value="{{ old('trim', $inventory->trim) }}" placeholder="Platinum">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="price" class="col-form-label">Price</label>
            <input id="price" name="price" type="number" step="0.01" class="form-control" value="{{ old('price', $inventory->price) }}" placeholder="42900">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="doc_fee" class="col-form-label">Documentation Fee</label>
            <input id="doc_fee" name="doc_fee" type="number" step="0.01" class="form-control" value="{{ old('doc_fee', $inventory->doc_fee) }}" placeholder="367">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="filing_fee" class="col-form-label">Filing Fee</label>
            <input id="filing_fee" name="filing_fee" type="number" step="0.01" class="form-control" value="{{ old('filing_fee', $inventory->filing_fee) }}" placeholder="99">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="tag_fee" class="col-form-label">Tag Fee</label>
            <input id="tag_fee" name="tag_fee" type="number" step="0.01" class="form-control" value="{{ old('tag_fee', $inventory->tag_fee) }}" placeholder="27">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="mileage" class="col-form-label">Mileage</label>
            <input id="mileage" name="mileage" type="number" class="form-control" value="{{ old('mileage', $inventory->mileage) }}" placeholder="67420">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="stock" class="col-form-label">Stock Number</label>
            <input id="stock" name="stock" type="text" class="form-control" value="{{ old('stock', $inventory->stock) }}" placeholder="NMU20481">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="vin" class="col-form-label">VIN</label>
            <input id="vin" name="vin" type="text" class="form-control" value="{{ old('vin', $inventory->vin) }}" placeholder="Vehicle VIN">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="engine" class="col-form-label">Engine</label>
            <input id="engine" name="engine" type="text" class="form-control" value="{{ old('engine', $inventory->engine) }}" placeholder="5.7L V8">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="transmission" class="col-form-label">Transmission</label>
            <input id="transmission" name="transmission" type="text" class="form-control" value="{{ old('transmission', $inventory->transmission) }}" placeholder="Automatic">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="drivetrain" class="col-form-label">Drivetrain</label>
            <input id="drivetrain" name="drivetrain" type="text" class="form-control" value="{{ old('drivetrain', $inventory->drivetrain) }}" placeholder="4WD">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="exterior" class="col-form-label">Exterior Color</label>
            <input id="exterior" name="exterior" type="text" class="form-control" value="{{ old('exterior', $inventory->exterior) }}" placeholder="Magnetic Gray">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="interior" class="col-form-label">Interior Color</label>
            <input id="interior" name="interior" type="text" class="form-control" value="{{ old('interior', $inventory->interior) }}" placeholder="Black Leather">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="fuel" class="col-form-label">Fuel Type</label>
            <input id="fuel" name="fuel" type="text" class="form-control" value="{{ old('fuel', $inventory->fuel) }}" placeholder="Gasoline">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="main_image_file" class="col-form-label">Main Image From Computer</label>
            <input id="main_image_file" name="main_image_file" type="file" class="form-control" accept="image/*">
            <small class="form-text text-muted">Upload the main vehicle photo from your computer.</small>
        </div>

        <div class="form-group">
            <label for="main_image" class="col-form-label">Or Main Image URL</label>
            <input id="main_image" name="main_image" type="text" class="form-control" value="{{ $currentMainImage }}" placeholder="https://...">
        </div>

        @if ($currentMainImage)
            <div class="mb-3">
                <p class="mb-2 font-weight-semibold">Current Main Image</p>
                <img
                    src="{{ preg_match('/^https?:\/\//i', $currentMainImage) ? $currentMainImage : (str_starts_with($currentMainImage, 'storage/') ? asset($currentMainImage) : asset('storage/' . ltrim($currentMainImage, '/'))) }}"
                    alt="Current main image"
                    style="width: 220px; max-width: 100%; border-radius: 8px; border: 1px solid #d8dbe7;"
                >
            </div>
        @endif
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="gallery_files" class="col-form-label">Gallery Images From Computer</label>
            <input id="gallery_files" name="gallery_files[]" type="file" class="form-control" accept="image/*" multiple>
            <small class="form-text text-muted">Select multiple photos to build the gallery.</small>
        </div>

        <div class="form-group">
            <label for="gallery_input" class="col-form-label">Or Gallery Image URLs</label>
            <textarea id="gallery_input" name="gallery_input" class="form-control" rows="5" placeholder="One image URL per line">{{ $galleryText }}</textarea>
        </div>
    </div>
</div>

@if (!empty(array_filter($currentGallery)))
    <div class="form-group">
        <label class="col-form-label d-block">Current Gallery</label>
        <div class="d-flex flex-wrap" style="gap: 12px;">
            @foreach (array_filter($currentGallery) as $galleryImage)
                <img
                    src="{{ preg_match('/^https?:\/\//i', $galleryImage) ? $galleryImage : (str_starts_with($galleryImage, 'storage/') ? asset($galleryImage) : asset('storage/' . ltrim($galleryImage, '/'))) }}"
                    alt="Gallery image"
                    style="width: 110px; height: 78px; object-fit: cover; border-radius: 8px; border: 1px solid #d8dbe7;"
                >
            @endforeach
        </div>
    </div>
@endif

<div class="form-group">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-2">
        <label class="col-form-label mb-0">Feature Points</label>
        <button type="button" class="btn btn-outline-secondary btn-sm" id="add-feature-point">Add Point</button>
    </div>

    <div id="feature-points" class="inventory-feature-list">
        @foreach ($featureItems as $feature)
            <div class="feature-point-row">
                <input
                    type="text"
                    name="features[]"
                    class="form-control"
                    value="{{ $feature }}"
                    placeholder="Add a vehicle feature"
                >
                <button type="button" class="btn btn-outline-danger btn-sm remove-feature-point">Remove</button>
            </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-form-label">Description</label>
    <textarea id="description" name="description" class="form-control" rows="6" placeholder="Write vehicle details">{{ old('description', $inventory->description) }}</textarea>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0 pl-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@once
    @push('inventory-form-script')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const featureList = document.getElementById('feature-points');
                const addButton = document.getElementById('add-feature-point');

                if (!featureList || !addButton) {
                    return;
                }

                const rowTemplate = () => {
                    const row = document.createElement('div');
                    row.className = 'feature-point-row';
                    row.innerHTML = `
                        <input type="text" name="features[]" class="form-control" placeholder="Add a vehicle feature">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-feature-point">Remove</button>
                    `;

                    return row;
                };

                addButton.addEventListener('click', function () {
                    featureList.appendChild(rowTemplate());
                });

                featureList.addEventListener('click', function (event) {
                    if (!event.target.classList.contains('remove-feature-point')) {
                        return;
                    }

                    const rows = featureList.querySelectorAll('.feature-point-row');

                    if (rows.length === 1) {
                        rows[0].querySelector('input').value = '';
                        return;
                    }

                    event.target.closest('.feature-point-row')?.remove();
                });
            });
        </script>
    @endpush
@endonce
