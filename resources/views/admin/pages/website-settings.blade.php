@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Website Settings</h3>
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

            <form action="{{ route('admin.website-settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="site_name">Site Name</label>
                                <input type="text" class="form-control" id="site_name" name="site_name"
                                       value="{{ old('site_name', $setting->site_name ?? '') }}" placeholder="Enter site name">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ old('email', $setting->email ?? '') }}" placeholder="Enter email">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       value="{{ old('phone', $setting->phone ?? '') }}" placeholder="Enter phone number">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3"
                                          placeholder="Enter address">{{ old('address', $setting->address ?? '') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo" accept="image/*" onchange="previewImage(this, 'logo-preview')">
                                <div class="mt-3">
                                    @if(isset($setting->logo) && $setting->logo)
                                        <div class="mb-2">
                                            <strong>Current Logo:</strong>
                                            <div class="mt-2">
                                                <img src="{{ asset($setting->logo) }}" alt="Current Logo" class="img-thumbnail" style="max-height: 100px;">
                                            </div>
                                        </div>
                                    @endif
                                    <div id="logo-preview-container" style="display: none;">
                                        <strong>New Preview:</strong>
                                        <div class="mt-2">
                                            <img id="logo-preview" src="" alt="Logo Preview" class="img-thumbnail" style="max-height: 100px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="favicon">Favicon</label>
                                <input type="file" class="form-control" id="favicon" name="favicon" accept="image/*" onchange="previewImage(this, 'favicon-preview')">
                                <div class="mt-3">
                                    @if(isset($setting->favicon) && $setting->favicon)
                                        <div class="mb-2">
                                            <strong>Current Favicon:</strong>
                                            <div class="mt-2">
                                                <img src="{{ asset($setting->favicon) }}" alt="Current Favicon" class="img-thumbnail" style="max-height: 50px;">
                                            </div>
                                        </div>
                                    @endif
                                    <div id="favicon-preview-container" style="display: none;">
                                        <strong>New Preview:</strong>
                                        <div class="mt-2">
                                            <img id="favicon-preview" src="" alt="Favicon Preview" class="img-thumbnail" style="max-height: 50px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h5 class="mt-3 mb-3">Social Media Links</h5>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="url" class="form-control" id="facebook" name="facebook"
                                       value="{{ old('facebook', $setting->facebook ?? '') }}" placeholder="https://facebook.com/yourpage">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="twitter">Twitter</label>
                                <input type="url" class="form-control" id="twitter" name="twitter"
                                       value="{{ old('twitter', $setting->twitter ?? '') }}" placeholder="https://twitter.com/yourhandle">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instagram">Instagram</label>
                                <input type="url" class="form-control" id="instagram" name="instagram"
                                       value="{{ old('instagram', $setting->instagram ?? '') }}" placeholder="https://instagram.com/yourpage">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="linkedin">LinkedIn</label>
                                <input type="url" class="form-control" id="linkedin" name="linkedin"
                                       value="{{ old('linkedin', $setting->linkedin ?? '') }}" placeholder="https://linkedin.com/company/yourcompany">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="youtube">YouTube</label>
                                <input type="url" class="form-control" id="youtube" name="youtube"
                                       value="{{ old('youtube', $setting->youtube ?? '') }}" placeholder="https://youtube.com/yourchannel">
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
