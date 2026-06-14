@extends("frontend.layouts.master")

@section("content")
<div class="content-page" style="margin-top: 76px;">

    @if($page->hero_image)
        <section class="page-hero" style="background-image: linear-gradient(135deg, rgba(13,13,13,0.55), rgba(26,10,10,0.55)), url('{{ asset($page->hero_image) }}');
                                          background-size: cover; background-position: center; min-height: 320px;
                                          display: flex; align-items: center; color: #fff;">
            <div class="container py-5 text-center" data-aos="fade-up">
                <h1 class="section-title">{{ $page->title }}</h1>
                @if($page->subtitle)
                    <p class="lead">{{ $page->subtitle }}</p>
                @endif
            </div>
        </section>
    @else
        <section class="page-header py-5"
                 style="background: linear-gradient(135deg, #1a1a2e 0%, #0f0f1e 100%); color: #fff;">
            <div class="container text-center" data-aos="fade-up">
                <h1 class="section-title">{{ $page->title }}</h1>
                @if($page->subtitle)
                    <p class="lead">{{ $page->subtitle }}</p>
                @endif
            </div>
        </section>
    @endif

    @if($page->body)
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9" data-aos="fade-up">
                        <div class="page-body">
                            {!! $page->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($page->images->count() > 0)
        <section class="py-5 bg-light">
            <div class="container">
                <h3 class="text-center mb-4" data-aos="fade-up">Gallery</h3>
                <div class="row g-3">
                    @foreach($page->images as $image)
                        <div class="col-md-4 col-sm-6" data-aos="zoom-in">
                            <div class="position-relative overflow-hidden rounded shadow-sm">
                                <img src="{{ asset($image->image) }}"
                                     alt="{{ $image->caption ?? $page->title }}"
                                     class="w-100" style="height: 260px; object-fit: cover;">
                                @if($image->caption)
                                    <div class="position-absolute bottom-0 start-0 end-0 p-2"
                                         style="background: rgba(0,0,0,0.6); color: #fff;">
                                        {{ $image->caption }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section id="inquiry" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <div class="reservation-form-container">
                        <div class="text-center mb-4">
                            <span class="section-subtitle">Get In Touch</span>
                            <h3 class="section-title">{{ $page->title }} Inquiry</h3>
                            @if($page->inquiry_intro)
                                <p>{{ $page->inquiry_intro }}</p>
                            @endif
                        </div>

                        <form action="{{ route('content-page.inquiry') }}" method="POST" class="puppy-reservation-form">
                            @csrf
                            <input type="hidden" name="page_slug" value="{{ $page->slug }}">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name') }}"
                                           placeholder="Enter your full name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') }}"
                                           placeholder="Enter your email" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                           id="phone" name="phone" value="{{ old('phone') }}"
                                           placeholder="Enter your phone number">
                                </div>
                                <div class="col-md-12">
                                    <label for="message" class="form-label">Your Message *</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror"
                                              id="message" name="message" rows="5"
                                              placeholder="Tell us what you're looking for...">{{ old('message') }}</textarea>
                                </div>

                                @include('frontend.partial.captcha', ['key' => 'content-page-' . $page->slug])

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="bi bi-send-fill me-2"></i>
                                        Send Inquiry
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Thank you!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6',
    });
@endif
</script>
@endpush
