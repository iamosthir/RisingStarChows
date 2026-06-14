@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Page: {{ $page->title }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.content-pages.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <a href="{{ url('/' . $page->slug) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-external-link-alt"></i> View Public
                    </a>
                </div>
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

            <form action="{{ route('admin.content-pages.update', $page->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title', $page->title) }}" required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                               id="subtitle" name="subtitle" value="{{ old('subtitle', $page->subtitle) }}"
                               placeholder="A short tagline shown under the title">
                        @error('subtitle')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="body">Page Content</label>
                        <textarea class="form-control @error('body') is-invalid @enderror"
                                  id="body" name="body" rows="10">{{ old('body', $page->body) }}</textarea>
                        @error('body')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inquiry_intro">Inquiry Form Intro</label>
                        <textarea class="form-control @error('inquiry_intro') is-invalid @enderror"
                                  id="inquiry_intro" name="inquiry_intro" rows="2"
                                  placeholder="Short text shown above the inquiry form on this page">{{ old('inquiry_intro', $page->inquiry_intro) }}</textarea>
                        @error('inquiry_intro')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="hero_image">Hero Image</label>
                        @if($page->hero_image)
                            <div class="mb-2">
                                <strong>Current:</strong>
                                <div class="mt-1">
                                    <img src="{{ asset($page->hero_image) }}" alt="Hero" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            </div>
                        @endif
                        <input type="file" class="form-control-file @error('hero_image') is-invalid @enderror"
                               id="hero_image" name="hero_image" accept="image/*">
                        <small class="form-text text-muted">Recommended landscape, ~1600×800px. JPG/PNG/WEBP up to 5 MB.</small>
                        @error('hero_image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <h5 class="mt-2">Gallery</h5>
                    <p class="text-muted small">Add more images to display on the public page. You can upload several at once.</p>

                    @if($page->images->count())
                        <div class="row mb-3">
                            @foreach($page->images as $image)
                                <div class="col-md-3 col-sm-4 col-6 mb-3">
                                    <div class="position-relative">
                                        <img src="{{ asset($image->image) }}" class="img-thumbnail w-100" style="height: 140px; object-fit: cover;" alt="Gallery image">
                                    </div>
                                    <form action="{{ route('admin.content-pages.images.delete', [$page->slug, $image->id]) }}"
                                          method="POST" class="d-inline w-100">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-block mt-1"
                                                onclick="return confirm('Delete this image?')">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted"><em>No gallery images yet.</em></p>
                    @endif

                    <div class="form-group">
                        <label for="gallery_images">Add Gallery Images</label>
                        <input type="file" class="form-control-file" id="gallery_images" name="gallery_images[]"
                               accept="image/*" multiple>
                        <small class="form-text text-muted">Select one or more images to add to the gallery.</small>
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
    $('#body').summernote({
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
