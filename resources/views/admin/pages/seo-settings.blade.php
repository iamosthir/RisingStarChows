@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">SEO Settings</h3>
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

            <form action="{{ route('admin.seo-settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="mb-3">Meta Tags</h5>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title"
                                       value="{{ old('meta_title', $setting->meta_title ?? '') }}"
                                       placeholder="Enter meta title (60-70 characters recommended)">
                                <small class="form-text text-muted">This appears in search engine results as the page title.</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="3"
                                          placeholder="Enter meta description (150-160 characters recommended)">{{ old('meta_description', $setting->meta_description ?? '') }}</textarea>
                                <small class="form-text text-muted">This appears in search engine results as the page description.</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="2"
                                          placeholder="Enter keywords separated by commas">{{ old('meta_keywords', $setting->meta_keywords ?? '') }}</textarea>
                                <small class="form-text text-muted">Separate keywords with commas (e.g., business, service, product)</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h5 class="mt-4 mb-3">Open Graph (Facebook, LinkedIn)</h5>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="og_title">OG Title</label>
                                <input type="text" class="form-control" id="og_title" name="og_title"
                                       value="{{ old('og_title', $setting->og_title ?? '') }}"
                                       placeholder="Enter Open Graph title">
                                <small class="form-text text-muted">Title when shared on social media.</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="og_description">OG Description</label>
                                <textarea class="form-control" id="og_description" name="og_description" rows="3"
                                          placeholder="Enter Open Graph description">{{ old('og_description', $setting->og_description ?? '') }}</textarea>
                                <small class="form-text text-muted">Description when shared on social media.</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="og_image">OG Image</label>
                                <input type="file" class="form-control" id="og_image" name="og_image" accept="image/*" onchange="previewImage(this, 'og-image-preview')">
                                <small class="form-text text-muted">Image when shared on social media (1200x630px recommended).</small>
                                <div class="mt-3">
                                    @if(isset($setting->og_image) && $setting->og_image)
                                        <div class="mb-2">
                                            <strong>Current OG Image:</strong>
                                            <div class="mt-2">
                                                <img src="{{ asset($setting->og_image) }}" alt="Current OG Image" class="img-thumbnail" style="max-height: 150px;">
                                            </div>
                                        </div>
                                    @endif
                                    <div id="og-image-preview-container" style="display: none;">
                                        <strong>New Preview:</strong>
                                        <div class="mt-2">
                                            <img id="og-image-preview" src="" alt="OG Image Preview" class="img-thumbnail" style="max-height: 150px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h5 class="mt-4 mb-3">Analytics & Tracking</h5>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="google_analytics">Google Analytics Code</label>
                                <textarea class="form-control" id="google_analytics" name="google_analytics" rows="5"
                                          placeholder="Paste your Google Analytics tracking code here">{{ old('google_analytics', $setting->google_analytics ?? '') }}</textarea>
                                <small class="form-text text-muted">Paste the entire script tag from Google Analytics.</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="google_tag_manager">Google Tag Manager Code</label>
                                <textarea class="form-control" id="google_tag_manager" name="google_tag_manager" rows="5"
                                          placeholder="Paste your Google Tag Manager code here">{{ old('google_tag_manager', $setting->google_tag_manager ?? '') }}</textarea>
                                <small class="form-text text-muted">Paste the entire script tag from Google Tag Manager.</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="facebook_pixel">Facebook Pixel Code</label>
                                <textarea class="form-control" id="facebook_pixel" name="facebook_pixel" rows="5"
                                          placeholder="Paste your Facebook Pixel code here">{{ old('facebook_pixel', $setting->facebook_pixel ?? '') }}</textarea>
                                <small class="form-text text-muted">Paste the entire script tag from Facebook Pixel.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save Settings</button>
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
</script>
@endpush
