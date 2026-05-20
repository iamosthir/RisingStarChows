@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">About Us</h3>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible mx-3 mt-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mx-3 mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.about-us.update') }}" method="POST" id="aboutUsForm">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title', $aboutUs->title ?? '') }}"
                               placeholder="Enter title" required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror"
                                  id="content" name="content" rows="10"
                                  placeholder="Enter about us content" required>{{ old('content', $aboutUs->content ?? '') }}</textarea>
                        @error('content')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <div class="mb-2">
                            @if($aboutUs && $aboutUs->image)
                                <img src="{{ asset($aboutUs->image) }}" alt="About Us Image"
                                     class="img-thumbnail" style="max-height: 200px;">
                            @else
                                <div class="text-muted">No image uploaded</div>
                            @endif
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imageInput" accept="image/*">
                            <label class="custom-file-label" for="imageInput">Choose file</label>
                        </div>
                        <small class="form-text text-muted">Recommended size: 800x600px</small>
                        <input type="hidden" name="image" id="imageBase64">
                    </div>

                    <!-- Image Preview -->
                    <div class="form-group" id="imagePreviewContainer" style="display: none;">
                        <label>Image Preview</label>
                        <div>
                            <img id="imagePreview" src="" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                        <button type="button" class="btn btn-sm btn-danger mt-2" id="removeImageBtn">
                            <i class="fas fa-times"></i> Remove
                        </button>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Update file input label
    $('.custom-file-input').on('change', function() {
        const fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // Handle image upload and preview
    $('#imageInput').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreviewContainer').show();
                $('#imageBase64').val(e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove image
    $('#removeImageBtn').on('click', function() {
        $('#imageInput').val('');
        $('#imageBase64').val('');
        $('.custom-file-label').removeClass("selected").html('Choose file');
        $('#imagePreviewContainer').hide();
    });

    // Initialize Summernote for content
    $('#content').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});
</script>
@endpush
