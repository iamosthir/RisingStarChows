@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Pet</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.pets.index') }}" class="btn btn-secondary btn-sm">
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

            <form action="{{ route('admin.pets.update', $pet->id) }}" method="POST" id="petForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full_name">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                       id="full_name" name="full_name" value="{{ old('full_name', $pet->full_name) }}"
                                       placeholder="Enter pet's full name" required>
                                @error('full_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="call_name">Call Name</label>
                                <input type="text" class="form-control @error('call_name') is-invalid @enderror"
                                       id="call_name" name="call_name" value="{{ old('call_name', $pet->call_name) }}"
                                       placeholder="Enter pet's call name">
                                @error('call_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sire_name">Sire Name</label>
                                <input type="text" class="form-control @error('sire_name') is-invalid @enderror"
                                       id="sire_name" name="sire_name" value="{{ old('sire_name', $pet->sire_name) }}"
                                       placeholder="Enter sire's name">
                                @error('sire_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dam_name">Dam Name</label>
                                <input type="text" class="form-control @error('dam_name') is-invalid @enderror"
                                       id="dam_name" name="dam_name" value="{{ old('dam_name', $pet->dam_name) }}"
                                       placeholder="Enter dam's name">
                                @error('dam_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="owner_name">Owner Name</label>
                                <input type="text" class="form-control @error('owner_name') is-invalid @enderror"
                                       id="owner_name" name="owner_name" value="{{ old('owner_name', $pet->owner_name) }}"
                                       placeholder="Enter owner's name">
                                @error('owner_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="breeder_name">Breeder Name</label>
                                <input type="text" class="form-control @error('breeder_name') is-invalid @enderror"
                                       id="breeder_name" name="breeder_name" value="{{ old('breeder_name', $pet->breeder_name) }}"
                                       placeholder="Enter breeder's name">
                                @error('breeder_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reg_no">Registration No</label>
                                <input type="text" class="form-control @error('reg_no') is-invalid @enderror"
                                       id="reg_no" name="reg_no" value="{{ old('reg_no', $pet->reg_no) }}"
                                       placeholder="Enter registration number">
                                @error('reg_no')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sex">Sex</label>
                                <select class="form-control @error('sex') is-invalid @enderror" id="sex" name="sex">
                                    <option value="">Select Sex</option>
                                    <option value="Male" {{ old('sex', $pet->sex) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('sex', $pet->sex) == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('sex')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birthdate">Birth Date</label>
                                <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                                       id="birthdate" name="birthdate" value="{{ old('birthdate', $pet->birthdate ? $pet->birthdate->format('Y-m-d') : '') }}">
                                @error('birthdate')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="color">Color</label>
                                <select class="form-control @error('color') is-invalid @enderror" id="color" name="color">
                                    <option value="">Select Color</option>
                                    @foreach($colors as $color)
                                        <option value="{{ $color->color_name }}" {{ old('color', $pet->color) == $color->color_name ? 'selected' : '' }}>
                                            {{ $color->color_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('color')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror"
                                       id="status" name="status" value="{{ old('status', $pet->status) }}"
                                       placeholder="e.g., Available, Sold">
                                @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="OFA">OFA</label>
                                <input type="text" class="form-control @error('OFA') is-invalid @enderror"
                                       id="OFA" name="OFA" value="{{ old('OFA', $pet->OFA) }}"
                                       placeholder="Enter OFA information">
                                @error('OFA')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                                    <option value="">Select Category</option>
                                    <option value="Puppies" {{ old('category', $pet->category) == 'Puppies' ? 'selected' : '' }}>Puppies</option>
                                    <option value="Breeding Dog" {{ old('category', $pet->category) == 'Breeding Dog' ? 'selected' : '' }}>Breeding Dog</option>
                                    <option value="Companion Dog" {{ old('category', $pet->category) == 'Companion Dog' ? 'selected' : '' }}>Companion Dog</option>
                                </select>
                                @error('category')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="available_status">Available Status</label>
                                <select class="form-control @error('available_status') is-invalid @enderror" id="available_status" name="available_status">
                                    <option value="available" {{ old('available_status', $pet->available_status) == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="not available" {{ old('available_status', $pet->available_status) == 'not available' ? 'selected' : '' }}>Not Available</option>
                                </select>
                                @error('available_status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="is_featured_dog"
                                           name="is_featured_dog" value="1" {{ old('is_featured_dog', $pet->is_featured_dog) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_featured_dog">
                                        <strong>Featured Dog</strong>
                                        <small class="text-muted">(Display this dog in the homepage featured section - max 3 dogs)</small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ref_link">Reference Link</label>
                                <input type="url" class="form-control @error('ref_link') is-invalid @enderror"
                                       id="ref_link" name="ref_link" value="{{ old('ref_link', $pet->ref_link) }}"
                                       placeholder="https://example.com">
                                @error('ref_link')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="4"
                                          placeholder="Enter pet description">{{ old('description', $pet->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <h5 class="mb-3">Primary Image (300x300)</h5>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                @if($pet->primaryImg)
                                    <div class="mb-3">
                                        <strong>Current Image:</strong>
                                        <div class="mt-2">
                                            <img src="{{ asset($pet->primaryImg) }}" alt="{{ $pet->full_name }}"
                                                 class="img-thumbnail" style="width: 300px; height: 300px; object-fit: cover;">
                                        </div>
                                    </div>
                                @endif

                                <label for="primaryImgFile">Upload New Primary Image</label>
                                <input type="file" class="form-control" id="primaryImgFile" accept="image/*">
                                <small class="form-text text-muted">Select an image to crop it to 300x300 pixels. Leave empty to keep current image.</small>

                                <div id="primaryImagePreview" class="mt-3" style="display: none;">
                                    <strong>New Cropped Preview:</strong>
                                    <div class="mt-2">
                                        <img id="primaryPreview" src="" alt="Primary Preview"
                                             class="img-thumbnail" style="width: 300px; height: 300px; object-fit: cover;">
                                    </div>
                                    <button type="button" class="btn btn-warning btn-sm mt-2" onclick="resetPrimaryImage()">
                                        <i class="fas fa-redo"></i> Change Image
                                    </button>
                                </div>

                                <input type="hidden" name="primaryImg" id="primaryImgData" value="{{ old('primaryImg', $pet->primaryImg) }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <h5 class="mb-3">Pet Gallery Images</h5>
                        </div>

                        @if($pet->petImages && $pet->petImages->count() > 0)
                        <div class="col-md-12">
                            <div class="mb-3">
                                <strong>Existing Gallery Images:</strong>
                                <div class="row mt-2" id="existingGalleryImages">
                                    @foreach($pet->petImages as $image)
                                    <div class="col-md-3 mb-3" id="gallery-image-{{ $image->id }}">
                                        <div class="card">
                                            <img src="{{ $image->image_url }}" alt="Gallery Image"
                                                 class="card-img-top" style="height: 200px; object-fit: cover;">
                                            <div class="card-body p-2 text-center">
                                                <button type="button" class="btn btn-danger btn-sm btn-block"
                                                        onclick="deleteGalleryImage({{ $image->id }})">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="galleryImages">Upload New Gallery Images</label>
                                <input type="file" class="form-control-file" id="galleryImages" name="gallery_images[]" accept="image/*" multiple>
                                <small class="form-text text-muted">You can select multiple images for the gallery. These will be uploaded to /uploads/pet-gallery/</small>

                                <div id="galleryPreview" class="mt-3 row" style="display: none;">
                                    <div class="col-md-12 mb-2">
                                        <strong>Selected Images:</strong>
                                        <button type="button" class="btn btn-warning btn-sm ml-2" onclick="resetGalleryImages()">
                                            <i class="fas fa-redo"></i> Clear All
                                        </button>
                                    </div>
                                    <div id="galleryPreviewContainer" class="col-md-12">
                                        <!-- Preview images will be added here by JavaScript -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Pet
                    </button>
                    <a href="{{ route('admin.pets.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Image Cropper Modal -->
<div class="modal fade" id="cropperModal" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropperModalLabel">Crop Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div style="width: 100%; height: 400px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <img id="primaryCropImage" style="max-width: 100%; display: block;">
                    </div>
                </div>
                <div class="text-center">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="zoomIn()" title="Zoom In">
                            <i class="fas fa-search-plus"></i> Zoom In
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="zoomOut()" title="Zoom Out">
                            <i class="fas fa-search-minus"></i> Zoom Out
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="moveMode()" title="Move Image">
                            <i class="fas fa-arrows-alt"></i> Move
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="rotateLeft()" title="Rotate Left">
                            <i class="fas fa-undo"></i> Rotate Left
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="rotateRight()" title="Rotate Right">
                            <i class="fas fa-redo"></i> Rotate Right
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="resetCropper()" title="Reset">
                            <i class="fas fa-sync-alt"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="cropPrimaryImage()">
                    <i class="fas fa-check"></i> Crop & Save
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
@endpush

@push('scripts')
<script src="{{ asset('dist/js/jquery-cropper.min.js') }}"></script>
<script>
$(function() {
    var URL = window.URL || window.webkitURL;
    var $image = $('#primaryCropImage');
    var uploadedImageURL;
    var options = {
        aspectRatio: 1,
        viewMode: 1,
        dragMode: 'move',
        autoCropArea: 0.8,
        restore: false,
        guides: true,
        center: true,
        highlight: true,
        cropBoxMovable: true,
        cropBoxResizable: true,
        toggleDragModeOnDblclick: true,
        responsive: true,
        zoomable: true,
        zoomOnWheel: true,
        wheelZoomRatio: 0.1,
        minCropBoxWidth: 100,
        minCropBoxHeight: 100,
    };

    // Primary Image Handler
    $('#primaryImgFile').on('change', function(e) {
        var files = this.files;
        var file;

        if (files && files.length) {
            file = files[0];

            if (/^image\/\w+$/.test(file.type)) {
                // Revoke previous URL if exists
                if (uploadedImageURL) {
                    URL.revokeObjectURL(uploadedImageURL);
                }

                // Create object URL
                uploadedImageURL = URL.createObjectURL(file);

                // Destroy existing cropper if any
                if ($image.data('cropper')) {
                    $image.cropper('destroy');
                }

                // Set new image and initialize cropper
                $image.attr('src', uploadedImageURL);

                // Show modal
                $('#cropperModal').modal('show');

                // Initialize cropper after modal is shown and image is loaded
                $('#cropperModal').one('shown.bs.modal', function() {
                    $image.cropper(options);
                });
            } else {
                alert('Please choose an image file.');
            }
        }
    });

    // Clean up when modal is hidden
    $('#cropperModal').on('hidden.bs.modal', function () {
        if ($image.data('cropper')) {
            $image.cropper('destroy');
        }
        $('#primaryImgFile').val('');
    });

    // Crop and save function
    window.cropPrimaryImage = function() {
        if ($image.data('cropper')) {
            var canvas = $image.cropper('getCroppedCanvas', {
                width: 300,
                height: 300,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
                fillColor: '#fff'
            });

            if (canvas) {
                var croppedImage = canvas.toDataURL('image/png');
                $('#primaryImgData').val(croppedImage);
                $('#primaryPreview').attr('src', croppedImage);
                $('#primaryImagePreview').show();

                // Hide modal
                $('#cropperModal').modal('hide');
            }
        }
    };

    window.resetPrimaryImage = function() {
        $('#primaryImagePreview').hide();
        $('#primaryImgData').val('{{ old('primaryImg', $pet->primaryImg) }}');
        $('#primaryImgFile').val('');
    };

    // Cropper control functions
    window.zoomIn = function() {
        if ($image.data('cropper')) {
            $image.cropper('zoom', 0.1);
        }
    };

    window.zoomOut = function() {
        if ($image.data('cropper')) {
            $image.cropper('zoom', -0.1);
        }
    };

    window.moveMode = function() {
        if ($image.data('cropper')) {
            $image.cropper('setDragMode', 'move');
        }
    };

    window.rotateLeft = function() {
        if ($image.data('cropper')) {
            $image.cropper('rotate', -45);
        }
    };

    window.rotateRight = function() {
        if ($image.data('cropper')) {
            $image.cropper('rotate', 45);
        }
    };

    window.resetCropper = function() {
        if ($image.data('cropper')) {
            $image.cropper('reset');
        }
    };

    // Gallery Images Handler
    $('#galleryImages').on('change', function(e) {
        var files = this.files;
        var previewContainer = $('#galleryPreviewContainer');
        previewContainer.empty();

        if (files && files.length > 0) {
            $('#galleryPreview').show();

            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                if (/^image\/\w+$/.test(file.type)) {
                    var reader = new FileReader();

                    reader.onload = (function(file) {
                        return function(e) {
                            var imageHtml = '<div class="d-inline-block mr-2 mb-2 position-relative">' +
                                '<img src="' + e.target.result + '" alt="Gallery Image" ' +
                                'class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">' +
                                '<div class="mt-1"><small class="text-muted">' + file.name + '</small></div>' +
                                '</div>';
                            previewContainer.append(imageHtml);
                        };
                    })(file);

                    reader.readAsDataURL(file);
                }
            }
        } else {
            $('#galleryPreview').hide();
        }
    });

    window.resetGalleryImages = function() {
        $('#galleryImages').val('');
        $('#galleryPreviewContainer').empty();
        $('#galleryPreview').hide();
    };

    // Delete gallery image
    window.deleteGalleryImage = function(imageId) {
        if (!confirm('Are you sure you want to delete this image? This action cannot be undone.')) {
            return;
        }

        $.ajax({
            url: '/admin/pets/gallery/' + imageId,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#gallery-image-' + imageId).fadeOut(300, function() {
                        $(this).remove();

                        // Check if there are no more images
                        if ($('#existingGalleryImages .col-md-3').length === 0) {
                            $('#existingGalleryImages').closest('.col-md-12').fadeOut(300, function() {
                                $(this).remove();
                            });
                        }
                    });

                    // Show success message (optional - you can use toastr or other notification library)
                    alert('Image deleted successfully!');
                } else {
                    alert('Error deleting image: ' + (response.message || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                alert('Error deleting image. Please try again.');
                console.error(error);
            }
        });
    };
});
</script>
@endpush
