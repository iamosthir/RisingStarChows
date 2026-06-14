@extends("frontend.layouts.master")

@section("content")
<section class="pet-details-section" style="margin-top: 76px; min-height: 100vh; background: linear-gradient(135deg, #0d0d0d 0%, #1a0a0a 50%, #0d0d0d 100%);">

    <!-- Breadcrumb -->
    <div class="pet-breadcrumb-bar">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door-fill"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pets') }}">Our Dogs</a></li>
                        <li class="breadcrumb-item active">{{ $pet->call_name ?? $pet->full_name }}</li>
                    </ol>
                </nav>
                <a href="{{ route('pets') }}" class="btn btn-outline-light btn-sm rounded-pill">
                    <i class="bi bi-arrow-left me-1"></i> Back to All Dogs
                </a>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-5">
            <!-- Gallery Column -->
            <div class="col-lg-6" data-aos="fade-right">
                <div class="gallery-wrapper">
                    <!-- Main Image -->
                    <div class="main-image-container" id="mainImageContainer">
                        <img src="{{ $pet->primaryImg ? asset($pet->primaryImg) : 'https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=800' }}"
                             alt="{{ $pet->full_name }}"
                             class="main-pet-image"
                             id="mainPetImage"
                             onclick="openGallery(currentImageIndex)">
                        <div class="image-zoom-hint">
                            <i class="bi bi-zoom-in"></i>
                        </div>
                        <!-- Navigation Arrows on Main Image -->
                        @if(($pet->primaryImg && $pet->petImages->count() > 0) || $pet->petImages->count() > 1)
                        <button class="gallery-nav-btn prev-btn" onclick="navigateGallery(-1)">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="gallery-nav-btn next-btn" onclick="navigateGallery(1)">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                        @endif
                    </div>

                    <!-- Thumbnail Strip -->
                    @if($pet->petImages->count() > 0 || $pet->primaryImg)
                    <div class="thumbnail-strip" id="thumbnailStrip">
                        @if($pet->primaryImg)
                            <div class="thumb-item active" onclick="changeImage('{{ asset($pet->primaryImg) }}', 0, this)">
                                <img src="{{ asset($pet->primaryImg) }}" alt="Primary">
                            </div>
                        @endif
                        @foreach($pet->petImages as $index => $image)
                            <div class="thumb-item" onclick="changeImage('{{ $image->image_url }}', {{ $pet->primaryImg ? $index + 1 : $index }}, this)">
                                <img src="{{ $image->image_url }}" alt="Gallery {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Reference Link -->
                @if($pet->ref_link)
                <div class="ref-link-card mt-4" data-aos="fade-up">
                    <div class="ref-link-header">
                        <span><i class="bi bi-link-45deg me-2"></i>Reference Link</span>
                        <a href="{{ $pet->ref_link }}" target="_blank" class="btn btn-sm btn-danger rounded-pill">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Open
                        </a>
                    </div>
                    <div class="ref-link-body">
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $pet->ref_link }}" frameborder="0" sandbox="allow-same-origin allow-scripts allow-popups allow-forms"></iframe>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Details Column -->
            <div class="col-lg-6" data-aos="fade-left">
                <!-- Pet Name & Call Name -->
                <div class="pet-header mb-4">
                    <h1 class="pet-title">{{ $pet->full_name }}</h1>
                    @if($pet->call_name && $pet->call_name !== $pet->full_name)
                        <p class="pet-call-name">"{{ $pet->call_name }}"</p>
                    @endif

                    @if($pet->is_featured_dog)
                    <div class="d-flex gap-2 flex-wrap mt-3">
                        <span class="pet-badge featured"><i class="bi bi-star-fill me-1"></i>Featured</span>
                    </div>
                    @endif
                </div>

                <!-- Basic Information -->
                <div class="info-section" data-aos="fade-up" data-aos-delay="100">
                    <h5 class="info-section-title">
                        <i class="bi bi-info-circle-fill"></i> Basic Information
                    </h5>
                    <div class="info-grid">
                        @if($pet->sex)
                        <div class="info-item">
                            <div class="info-icon"><i class="bi bi-gender-{{ $pet->sex === 'Male' ? 'male' : 'female' }}"></i></div>
                            <div>
                                <span class="info-label">Sex</span>
                                <span class="info-value">{{ $pet->sex }}</span>
                            </div>
                        </div>
                        @endif
                        @if($pet->birthdate)
                        <div class="info-item">
                            <div class="info-icon"><i class="bi bi-calendar3"></i></div>
                            <div>
                                <span class="info-label">Birth Date</span>
                                <span class="info-value">{{ $pet->birthdate->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon"><i class="bi bi-clock-history"></i></div>
                            <div>
                                <span class="info-label">Age</span>
                                <span class="info-value">{{ $pet->birthdate->diffForHumans() }}</span>
                            </div>
                        </div>
                        @endif
                        @if($pet->color_name)
                        <div class="info-item">
                            <div class="info-icon"><i class="bi bi-palette-fill"></i></div>
                            <div>
                                <span class="info-label">Color</span>
                                <span class="info-value">{{ $pet->color_name }}</span>
                            </div>
                        </div>
                        @endif
                        @if($pet->reg_no)
                        <div class="info-item">
                            <div class="info-icon"><i class="bi bi-card-text"></i></div>
                            <div>
                                <span class="info-label">Registration</span>
                                <span class="info-value">{{ $pet->reg_no }}</span>
                            </div>
                        </div>
                        @endif
                        @if($pet->status)
                        <div class="info-item">
                            <div class="info-icon"><i class="bi bi-info-square-fill"></i></div>
                            <div>
                                <span class="info-label">Status</span>
                                <span class="info-value">{{ $pet->status }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Pedigree -->
                @if($pet->sire_name || $pet->dam_name)
                <div class="info-section" data-aos="fade-up" data-aos-delay="150">
                    <h5 class="info-section-title">
                        <i class="bi bi-diagram-3-fill"></i> Pedigree
                    </h5>
                    <div class="info-grid">
                        @if($pet->sire_name)
                        <div class="info-item">
                            <div class="info-icon"><i class="bi bi-arrow-right-circle-fill"></i></div>
                            <div>
                                <span class="info-label">Sire (Father)</span>
                                <span class="info-value">{{ $pet->sire_name }}</span>
                            </div>
                        </div>
                        @endif
                        @if($pet->dam_name)
                        <div class="info-item">
                            <div class="info-icon"><i class="bi bi-arrow-right-circle-fill"></i></div>
                            <div>
                                <span class="info-label">Dam (Mother)</span>
                                <span class="info-value">{{ $pet->dam_name }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Ownership -->
                @if($pet->owner_name || $pet->breeder_name)
                <div class="info-section" data-aos="fade-up" data-aos-delay="200">
                    <h5 class="info-section-title">
                        <i class="bi bi-person-badge-fill"></i> Ownership
                    </h5>
                    <div class="info-grid">
                        @if($pet->owner_name)
                        <div class="info-item">
                            <div class="info-icon"><i class="bi bi-person-fill"></i></div>
                            <div>
                                <span class="info-label">Owner</span>
                                <span class="info-value">{{ $pet->owner_name }}</span>
                            </div>
                        </div>
                        @endif
                        @if($pet->breeder_name)
                        <div class="info-item">
                            <div class="info-icon"><i class="bi bi-heart-fill"></i></div>
                            <div>
                                <span class="info-label">Breeder</span>
                                <span class="info-value">{{ $pet->breeder_name }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Health -->
                @if($pet->OFA)
                <div class="info-section" data-aos="fade-up" data-aos-delay="250">
                    <h5 class="info-section-title">
                        <i class="bi bi-shield-check"></i> Health
                    </h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon"><i class="bi bi-clipboard-check-fill"></i></div>
                            <div>
                                <span class="info-label">OFA</span>
                                <span class="info-value">{{ $pet->OFA }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Description -->
                @if($pet->description)
                <div class="info-section" data-aos="fade-up" data-aos-delay="300">
                    <h5 class="info-section-title">
                        <i class="bi bi-text-paragraph"></i> About {{ $pet->call_name ?? $pet->full_name }}
                    </h5>
                    <p class="pet-description">{{ $pet->description }}</p>
                </div>
                @endif

                <!-- Inquiry Button -->
                @php
                    $inquirySlug = $pet->category === 'Companion Dog' ? 'companion-dogs' : 'puppies';
                    $inquiryLabel = $pet->category === 'Companion Dog' ? 'Companion Dog Inquiry' : 'Puppy Inquiry';
                @endphp
                <div class="mt-4" data-aos="fade-up" data-aos-delay="350">
                    <a href="{{ route('content-page.show', $inquirySlug) }}#inquiry" class="reserve-btn">
                        <i class="bi bi-chat-dots-fill me-2"></i>{{ $inquiryLabel }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Pets -->
        @if($relatedPets->count() > 0)
        <div class="related-pets mt-5 pt-5">
            <h3 class="section-heading mb-4" data-aos="fade-up">
                <span class="heading-line"></span>
                Similar Dogs
                <span class="heading-line"></span>
            </h3>
            <div class="row g-4">
                @foreach($relatedPets as $index => $related)
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                    <div class="related-pet-card">
                        <div class="related-pet-image">
                            <img src="{{ $related->primaryImg ? asset($related->primaryImg) : 'https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=600' }}"
                                 alt="{{ $related->full_name }}">
                        </div>
                        <div class="related-pet-info">
                            <a href="{{ route('pet.details', $related->slug) }}" class="text-decoration-none">
                                <h5 class="related-pet-name">{{ $related->call_name ?? $related->full_name }}</h5>
                            </a>
                            <div class="related-pet-meta">
                                <span><i class="bi bi-{{ $related->sex === 'Male' ? 'gender-male' : 'gender-female' }}"></i> {{ $related->sex }}</span>
                                @if($related->birthdate)
                                <span><i class="bi bi-calendar3"></i> {{ $related->birthdate->diffForHumans() }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Lightbox Modal -->
<div class="modal fade" id="galleryModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-black border-0">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" style="z-index: 1060;"></button>
                <div id="galleryCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        @if($pet->primaryImg)
                        <div class="carousel-item active">
                            <img src="{{ asset($pet->primaryImg) }}" class="d-block w-100" style="max-height: 85vh; object-fit: contain;">
                        </div>
                        @endif
                        @foreach($pet->petImages as $image)
                        <div class="carousel-item {{ !$pet->primaryImg && $loop->first ? 'active' : '' }}">
                            <img src="{{ $image->image_url }}" class="d-block w-100" style="max-height: 85vh; object-fit: contain;">
                        </div>
                        @endforeach
                    </div>
                    @if(($pet->primaryImg && $pet->petImages->count() > 0) || $pet->petImages->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Breadcrumb Bar */
    .pet-breadcrumb-bar {
        background: linear-gradient(90deg, #1a0000 0%, #2d0000 50%, #1a0000 100%);
        border-bottom: 1px solid rgba(220, 53, 69, 0.3);
        padding: 14px 0;
    }

    .pet-breadcrumb-bar .breadcrumb {
        margin: 0;
    }

    .pet-breadcrumb-bar .breadcrumb-item a {
        color: #dc3545;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: color 0.2s;
    }

    .pet-breadcrumb-bar .breadcrumb-item a:hover {
        color: #ff6b7a;
    }

    .pet-breadcrumb-bar .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
    }

    .pet-breadcrumb-bar .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(220, 53, 69, 0.5);
        content: ">";
    }

    /* Gallery */
    .gallery-wrapper {
        position: sticky;
        top: 96px;
    }

    .main-image-container {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        background: #111;
        aspect-ratio: 1 / 1;
    }

    .main-pet-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.5s ease;
    }

    .main-image-container:hover .main-pet-image {
        transform: scale(1.03);
    }

    .main-image-container:hover .image-zoom-hint {
        opacity: 1;
    }

    .image-zoom-hint {
        position: absolute;
        bottom: 16px;
        right: 16px;
        background: rgba(0, 0, 0, 0.6);
        color: #fff;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
        font-size: 1.1rem;
        pointer-events: none;
    }

    .status-badge {
        position: absolute;
        top: 16px;
        left: 16px;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        z-index: 10;
        backdrop-filter: blur(8px);
        letter-spacing: 0.5px;
    }

    .status-badge.reserved {
        background: rgba(220, 53, 69, 0.9);
        color: #fff;
    }

    .status-badge.available {
        background: rgba(25, 135, 84, 0.9);
        color: #fff;
    }

    /* Gallery Nav Arrows */
    .gallery-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(220, 53, 69, 0.7);
        border: none;
        color: #fff;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s;
        opacity: 0;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .main-image-container:hover .gallery-nav-btn {
        opacity: 1;
    }

    .gallery-nav-btn:hover {
        background: rgba(220, 53, 69, 1);
        transform: translateY(-50%) scale(1.1);
    }

    .gallery-nav-btn.prev-btn { left: 12px; }
    .gallery-nav-btn.next-btn { right: 12px; }

    /* Thumbnails */
    .thumbnail-strip {
        display: flex;
        gap: 10px;
        margin-top: 12px;
        overflow-x: auto;
        padding-bottom: 8px;
        scrollbar-width: thin;
        scrollbar-color: #dc3545 #1a1a1a;
    }

    .thumbnail-strip::-webkit-scrollbar {
        height: 4px;
    }

    .thumbnail-strip::-webkit-scrollbar-track {
        background: #1a1a1a;
        border-radius: 4px;
    }

    .thumbnail-strip::-webkit-scrollbar-thumb {
        background: #dc3545;
        border-radius: 4px;
    }

    .thumb-item {
        flex: 0 0 80px;
        height: 80px;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        opacity: 0.6;
    }

    .thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumb-item:hover,
    .thumb-item.active {
        border-color: #dc3545;
        opacity: 1;
        box-shadow: 0 0 12px rgba(220, 53, 69, 0.4);
    }

    /* Pet Header */
    .pet-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        letter-spacing: -0.5px;
    }

    .pet-call-name {
        font-size: 1.2rem;
        color: #dc3545;
        font-weight: 500;
        font-style: italic;
        margin-top: 4px;
        margin-bottom: 0;
    }

    /* Pet Badges */
    .pet-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .pet-badge.reserved { background: rgba(220, 53, 69, 0.15); color: #dc3545; border: 1px solid rgba(220, 53, 69, 0.3); }
    .pet-badge.available { background: rgba(25, 135, 84, 0.15); color: #198754; border: 1px solid rgba(25, 135, 84, 0.3); }
    .pet-badge.featured { background: rgba(255, 193, 7, 0.15); color: #ffc107; border: 1px solid rgba(255, 193, 7, 0.3); }

    /* Info Sections */
    .info-section {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 16px;
        transition: background 0.3s;
    }

    .info-section:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    .info-section-title {
        color: #dc3545;
        font-size: 1rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-section-title i {
        font-size: 1.1rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(220, 53, 69, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #dc3545;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .info-label {
        display: block;
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.45);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        display: block;
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .pet-description {
        color: rgba(255, 255, 255, 0.75);
        line-height: 1.8;
        font-size: 0.95rem;
        margin: 0;
    }

    /* Reserve Button */
    .reserve-btn {
        display: block;
        text-align: center;
        background: linear-gradient(135deg, #dc3545, #a71d2a);
        color: #fff;
        padding: 16px 32px;
        border-radius: 14px;
        font-size: 1.1rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 20px rgba(220, 53, 69, 0.3);
    }

    .reserve-btn:hover {
        background: linear-gradient(135deg, #e74c5a, #c82333);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(220, 53, 69, 0.5);
    }

    /* Ref Link Card */
    .ref-link-card {
        border-radius: 14px;
        overflow: hidden;
        background: #111;
    }

    .ref-link-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 20px;
        background: rgba(220, 53, 69, 0.15);
        color: #dc3545;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .ref-link-body {
        padding: 0;
    }

    /* Section Heading */
    .section-heading {
        color: #fff;
        font-weight: 700;
        font-size: 1.6rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
    }

    .heading-line {
        display: inline-block;
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, transparent, #dc3545);
    }

    .heading-line:last-child {
        background: linear-gradient(90deg, #dc3545, transparent);
    }

    /* Related Pet Cards */
    .related-pet-card {
        background: rgba(255, 255, 255, 0.04);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s;
        position: relative;
    }

    .related-pet-card:hover {
        transform: translateY(-6px);
        background: rgba(255, 255, 255, 0.07);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
    }

    .related-pet-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 5;
        backdrop-filter: blur(8px);
    }

    .related-pet-badge.reserved { background: rgba(220, 53, 69, 0.85); color: #fff; }
    .related-pet-badge.available { background: rgba(25, 135, 84, 0.85); color: #fff; }

    .related-pet-image {
        height: 260px;
        overflow: hidden;
    }

    .related-pet-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .related-pet-card:hover .related-pet-image img {
        transform: scale(1.08);
    }

    .related-pet-info {
        padding: 18px 20px;
    }

    .related-pet-name {
        color: #fff;
        font-weight: 700;
        font-size: 1.05rem;
        margin-bottom: 6px;
        transition: color 0.2s;
    }

    .related-pet-name:hover {
        color: #dc3545;
    }

    .related-pet-meta {
        display: flex;
        gap: 14px;
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.85rem;
    }

    .related-pet-meta i {
        color: #dc3545;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .gallery-wrapper {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .pet-title {
            font-size: 1.6rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .main-image-container {
            aspect-ratio: 4 / 3;
        }

        .thumb-item {
            flex: 0 0 64px;
            height: 64px;
        }

        .gallery-nav-btn {
            opacity: 1;
            width: 36px;
            height: 36px;
            font-size: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    let currentImageIndex = 0;
    const allImages = [];

    @if($pet->primaryImg)
        allImages.push('{{ asset($pet->primaryImg) }}');
    @endif
    @foreach($pet->petImages as $image)
        allImages.push('{{ $image->image_url }}');
    @endforeach

    function changeImage(src, index, element) {
        currentImageIndex = index;
        const mainImg = document.getElementById('mainPetImage');
        mainImg.style.opacity = '0';
        setTimeout(() => {
            mainImg.src = src;
            mainImg.style.opacity = '1';
        }, 200);
        document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
    }

    function navigateGallery(direction) {
        if (allImages.length === 0) return;
        currentImageIndex = (currentImageIndex + direction + allImages.length) % allImages.length;
        const mainImg = document.getElementById('mainPetImage');
        mainImg.style.opacity = '0';
        setTimeout(() => {
            mainImg.src = allImages[currentImageIndex];
            mainImg.style.opacity = '1';
        }, 200);
        const thumbs = document.querySelectorAll('.thumb-item');
        thumbs.forEach(el => el.classList.remove('active'));
        if (thumbs[currentImageIndex]) {
            thumbs[currentImageIndex].classList.add('active');
            thumbs[currentImageIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }
    }

    function openGallery(index) {
        const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
        const carousel = new bootstrap.Carousel(document.getElementById('galleryCarousel'));
        carousel.to(index);
        modal.show();
    }

    // Add smooth transition to main image
    document.getElementById('mainPetImage').style.transition = 'opacity 0.2s ease';

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const modalEl = document.getElementById('galleryModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal && modal._isShown) {
            if (e.key === 'ArrowLeft') {
                bootstrap.Carousel.getInstance(document.getElementById('galleryCarousel')).prev();
            } else if (e.key === 'ArrowRight') {
                bootstrap.Carousel.getInstance(document.getElementById('galleryCarousel')).next();
            } else if (e.key === 'Escape') {
                modal.hide();
            }
        }
    });
</script>
@endpush
@endsection
