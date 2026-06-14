@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Content Pages</h3>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible mx-3 mt-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-body">
                <p class="text-muted">These are the editable info pages on the public site. Click a page to update its text, hero image, gallery, and inquiry intro.</p>

                <div class="row">
                    @foreach($pages as $page)
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                @if($page->hero_image)
                                    <img src="{{ asset($page->hero_image) }}" class="card-img-top" alt="{{ $page->title }}" style="height: 180px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title mb-1">{{ $page->title }}</h5>
                                    <small class="text-muted">/{{ $page->slug }}</small>
                                    @if($page->subtitle)
                                        <p class="card-text mt-2">{{ $page->subtitle }}</p>
                                    @endif
                                </div>
                                <div class="card-footer bg-white">
                                    <a href="{{ route('admin.content-pages.edit', $page->slug) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Edit Page
                                    </a>
                                    <a href="{{ url('/' . $page->slug) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-external-link-alt"></i> View Public
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
