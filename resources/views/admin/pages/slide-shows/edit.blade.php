@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Slide Show</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.slide-shows.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mx-3 mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.slide-shows.update', $slideShow->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title', $slideShow->title) }}"
                                       placeholder="Enter slide title" required>
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="order">Order</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror"
                                       id="order" name="order" value="{{ old('order', $slideShow->order) }}"
                                       placeholder="Enter display order">
                                @error('order')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="3"
                                          placeholder="Enter slide description">{{ old('description', $slideShow->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*"
                                       onchange="previewImage(this, 'image-preview')">
                                <small class="form-text text-muted">Recommended size: 1920x1080px. Max size: 2MB. Leave empty to keep current image.</small>
                                @error('image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror

                                <div class="mt-3">
                                    @if($slideShow->image)
                                        <div class="mb-2">
                                            <strong>Current Image:</strong>
                                            <div class="mt-2">
                                                <img src="{{ asset($slideShow->image) }}" alt="{{ $slideShow->title }}"
                                                     class="img-thumbnail" style="max-height: 300px; max-width: 100%;">
                                            </div>
                                        </div>
                                    @endif

                                    <div id="image-preview-container" style="display: none;">
                                        <strong>New Preview:</strong>
                                        <div class="mt-2">
                                            <img id="image-preview" src="" alt="Image Preview"
                                                 class="img-thumbnail" style="max-height: 300px; max-width: 100%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <h5 class="mb-3">Action Button Settings</h5>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="enable_action_button"
                                           name="enable_action_button" value="1"
                                           {{ old('enable_action_button', $slideShow->enable_action_button) ? 'checked' : '' }}
                                           onchange="toggleActionButton()">
                                    <label class="custom-control-label" for="enable_action_button">
                                        Enable Action Button
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="action-button-fields" style="display: {{ old('enable_action_button', $slideShow->enable_action_button) ? 'contents' : 'none' }};">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="action_button_text">Button Text</label>
                                    <input type="text" class="form-control @error('action_button_text') is-invalid @enderror"
                                           id="action_button_text" name="action_button_text"
                                           value="{{ old('action_button_text', $slideShow->action_button_text) }}"
                                           placeholder="e.g., Learn More">
                                    @error('action_button_text')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="action_button_link">Button Link</label>
                                    <input type="url" class="form-control @error('action_button_link') is-invalid @enderror"
                                           id="action_button_link" name="action_button_link"
                                           value="{{ old('action_button_link', $slideShow->action_button_link) }}"
                                           placeholder="https://example.com">
                                    @error('action_button_link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_active"
                                           name="is_active" value="1"
                                           {{ old('is_active', $slideShow->is_active) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active">
                                        Active (Display on frontend)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Slide Show
                    </button>
                    <a href="{{ route('admin.slide-shows.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input, previewId) {
    const file = input.files[0];
    const previewContainer = document.getElementById(previewId + '-container');
    const preview = document.getElementById(previewId);

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        }

        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        previewContainer.style.display = 'none';
    }
}

function toggleActionButton() {
    const checkbox = document.getElementById('enable_action_button');
    const fields = document.getElementById('action-button-fields');

    if (checkbox.checked) {
        fields.style.display = 'contents';
    } else {
        fields.style.display = 'none';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleActionButton();
});
</script>
@endpush
