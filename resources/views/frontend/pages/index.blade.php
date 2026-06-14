@extends("frontend.layouts.master")

@section("content")
<!-- Hero Section with Slideshow -->
    <section id="home" class="hero-section">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            @if($banners->count() > 0)
                <div class="carousel-indicators">
                    @foreach($banners as $index => $banner)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach($banners as $index => $banner)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="carousel-overlay"></div>
                            <img src="{{ asset($banner->image) }}" class="d-block w-100" alt="{{ $banner->title }}">
                            <div class="carousel-caption">
                                <h1 class="display-2 fw-bold animate-title">{{ $banner->title }}</h1>
                                @if($banner->description)
                                    <p class="lead animate-subtitle">{{ $banner->description }}</p>
                                @endif
                                @if($banner->enable_action_button && $banner->action_button_text && $banner->action_button_link)
                                    <a href="{{ $banner->action_button_link }}" class="btn btn-primary btn-lg mt-3 animate-btn">{{ $banner->action_button_text }}</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            @else
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="carousel-overlay"></div>
                        <img src="https://images.unsplash.com/photo-1523626752472-b55a628f1acc?w=1920" class="d-block w-100" alt="Chow Chow">
                        <div class="carousel-caption">
                            <h1 class="display-2 fw-bold animate-title">RisingStarChows</h1>
                            <p class="lead animate-subtitle">Where Champions Are Born & Raised</p>
                            <a href="#contact" class="btn btn-primary btn-lg mt-3 animate-btn">Get In Touch</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="scroll-indicator">
            <a href="#about"><i class="bi bi-chevron-double-down"></i></a>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="about-section py-5">
        <div class="container py-5">
            @if($aboutUs)
                <div class="row align-items-center">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                        <div class="about-image-wrapper">
                            <img src="{{ asset($aboutUs->image) }}" alt="{{ $aboutUs->title }}" class="img-fluid rounded-4 shadow-lg">
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                        <div class="about-content ps-lg-5 mt-5 mt-lg-0">
                            <span class="section-subtitle">About Us</span>
                            <h2 class="section-title">{{ $aboutUs->title }}</h2>
                            <div>
                                {!! $aboutUs->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row align-items-center">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                        <div class="about-image-wrapper">
                            <img src="https://images.unsplash.com/photo-1530281700549-e82e7bf110d6?w=800" alt="About Us" class="img-fluid rounded-4 shadow-lg">
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                        <div class="about-content ps-lg-5 mt-5 mt-lg-0">
                            <span class="section-subtitle">About Us</span>
                            <h2 class="section-title">Passionate About Raising Champions</h2>
                            <p class="lead text-muted">At RisingStarChows, we believe every dog has the potential to be a star. Our dedication to excellence in breeding and training has made us a trusted name in the dog competition world.</p>
                            <p class="text-muted">We specialize in Chow Chows and various other breeds, providing them with world-class training, nutrition, and care. Our dogs have competed and won in numerous national and international competitions.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Our Dogs Section -->
    @if($featuredDogs->count() > 0)
    <section id="dogs" class="dogs-section py-5">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-subtitle">Our Stars</span>
                <h2 class="section-title">Meet Our Champions</h2>
            </div>
            <div class="row g-4">
                @foreach($featuredDogs as $index => $dog)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <a href="{{ route('pet.details', $dog->slug) }}" class="text-decoration-none">
                            <div class="dog-card">
                                <div class="dog-image">
                                    <img src="{{ asset($dog->primaryImg ?? 'https://images.unsplash.com/photo-1523626752472-b55a628f1acc?w=600') }}" alt="{{ $dog->full_name }}">
                                    <div class="dog-overlay">
                                        @if($dog->color)
                                            <span class="breed-tag">{{ $dog->color }}</span>
                                        @endif
                                        <div class="view-details-overlay">
                                            <i class="bi bi-eye fs-1 text-white"></i>
                                            <p class="text-white mt-2 mb-0">View Details</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dog-info">
                                    <h4>{{ $dog->call_name ?? $dog->full_name }}</h4>
                                    @if($dog->status)
                                        <p>{{ $dog->status }}</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Puppies Section -->
    <section id="puppies" class="puppies-section py-5">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-subtitle">Available Now</span>
                <h2 class="section-title">{{ $puppiesPage?->title ?? 'Our Puppies' }}</h2>
                <p class="lead">{{ $puppiesPage?->subtitle ?? 'Beautiful, healthy puppies ready for their forever homes' }}</p>
            </div>

            <!-- Puppies Grid -->
            <div class="row g-4 mb-4">
                @forelse($puppies as $index => $puppy)
                    <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="puppy-card">
                            <div class="puppy-image" style="height: 280px; overflow: hidden; position: relative;">
                                @if($puppy->primaryImg)
                                    <img src="{{ asset($puppy->primaryImg) }}" alt="{{ $puppy->full_name }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=600'">
                                @else
                                    <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=600" alt="Puppy" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>
                            <div class="puppy-details">
                                <a href="{{ route('pet.details', $puppy->slug) }}" class="text-decoration-none text-dark">
                                    <h4 class="pet-name-hover">{{ $puppy->call_name ?? $puppy->full_name }}</h4>
                                </a>
                                <div class="puppy-info-row">
                                    <span><i class="bi bi-{{ $puppy->sex === 'Male' ? 'gender-male' : 'gender-female' }}"></i> {{ $puppy->sex ?? 'N/A' }}</span>
                                    @if($puppy->birthdate)
                                        <span><i class="bi bi-calendar3"></i> {{ $puppy->birthdate->diffForHumans() }}</span>
                                    @endif
                                </div>
                                @if($puppy->color || $puppy->reg_no)
                                    <div class="puppy-info-row">
                                        @if($puppy->color)
                                            <span><i class="bi bi-palette"></i> {{ $puppy->color_name }}</span>
                                        @endif
                                        @if($puppy->reg_no)
                                            <span><i class="bi bi-card-text"></i> {{ Str::limit($puppy->reg_no, 10) }}</span>
                                        @endif
                                    </div>
                                @endif
                                @if($puppy->description)
                                    <p class="puppy-description">{{ Str::limit($puppy->description, 80) }}</p>
                                @endif
                                <a href="{{ route('content-page.show', 'puppies') }}#inquiry" class="btn btn-primary w-100">
                                    <i class="bi bi-chat-dots-fill me-2"></i>Puppy Inquiry
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-heart display-1 text-muted"></i>
                        <h4 class="mt-3">No puppies available at the moment</h4>
                        <p class="text-muted">Please check back soon for new arrivals!</p>
                    </div>
                @endforelse
            </div>

            @if($puppies->count() > 0)
                <div class="text-center mb-5">
                    <a href="{{ route('content-page.show', 'puppies') }}" class="btn btn-outline-primary">
                        <i class="bi bi-info-circle me-2"></i>More About Our Puppies
                    </a>
                </div>
            @endif

            <!-- Reservation Form Section -->
            <div class="row justify-content-center mt-5">
                <div class="col-lg-10">
                    <div class="reservation-form-container" data-aos="fade-up">
                        <div class="text-center mb-4">
                            <span class="section-subtitle">General Inquiry</span>
                            <h3 class="section-title">Contact Us</h3>
                            <p class="">Have questions about our puppies? Send us a message</p>
                        </div>

                        <form action="{{ route('reservation.submit') }}" method="POST" class="puppy-reservation-form" id="generalInquiryForm">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <h6 class="mb-2"><i class="bi bi-exclamation-triangle me-2"></i>Please correct the following errors:</h6>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="user_name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                                           id="user_name" name="user_name" value="{{ old('user_name') }}"
                                           placeholder="Enter your full name">
                                    @error('user_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') }}"
                                           placeholder="Enter your email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number *</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                           id="phone" name="phone" value="{{ old('phone') }}"
                                           placeholder="Enter your phone number">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="inquiry" class="form-label">Your Message *</label>
                                    <textarea class="form-control @error('inquiry') is-invalid @enderror"
                                              id="inquiry" name="inquiry" rows="5"
                                              placeholder="Tell us about your interest in our puppies...">{{ old('inquiry') }}</textarea>
                                    @error('inquiry')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @include('frontend.partial.captcha', ['key' => 'inquiry'])

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="bi bi-send-fill me-2"></i>
                                        <span>Submit Inquiry</span>
                                    </button>
                                </div>

                                <div class="col-12 text-center">
                                    <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Fields marked with * are required</small>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Companion Dogs Section -->
    <section id="companion-dogs" class="puppies-section py-5">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-subtitle">For Loving Homes</span>
                <h2 class="section-title">{{ $companionDogsPage?->title ?? 'Companion Dogs' }}</h2>
                <p class="lead">{{ $companionDogsPage?->subtitle ?? 'Retired breeding dogs looking for loving homes' }}</p>
            </div>

            <div class="row g-4">
                @forelse($companionDogs as $index => $companion)
                    <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="puppy-card">
                            <div class="puppy-image" style="height: 280px; overflow: hidden; position: relative;">
                                @if($companion->primaryImg)
                                    <img src="{{ asset($companion->primaryImg) }}" alt="{{ $companion->full_name }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=600'">
                                @else
                                    <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=600" alt="Companion Dog" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>
                            <div class="puppy-details">
                                <a href="{{ route('pet.details', $companion->slug) }}" class="text-decoration-none text-dark">
                                    <h4 class="pet-name-hover">{{ $companion->call_name ?? $companion->full_name }}</h4>
                                </a>
                                <div class="puppy-info-row">
                                    <span><i class="bi bi-{{ $companion->sex === 'Male' ? 'gender-male' : 'gender-female' }}"></i> {{ $companion->sex ?? 'N/A' }}</span>
                                    @if($companion->birthdate)
                                        <span><i class="bi bi-calendar3"></i> {{ $companion->birthdate->diffForHumans() }}</span>
                                    @endif
                                </div>
                                @if($companion->color || $companion->reg_no)
                                    <div class="puppy-info-row">
                                        @if($companion->color)
                                            <span><i class="bi bi-palette"></i> {{ $companion->color_name }}</span>
                                        @endif
                                        @if($companion->reg_no)
                                            <span><i class="bi bi-card-text"></i> {{ Str::limit($companion->reg_no, 10) }}</span>
                                        @endif
                                    </div>
                                @endif
                                @if($companion->description)
                                    <p class="puppy-description">{{ Str::limit($companion->description, 80) }}</p>
                                @endif
                                <a href="{{ route('content-page.show', 'companion-dogs') }}#inquiry" class="btn btn-primary w-100">
                                    <i class="bi bi-chat-dots-fill me-2"></i>Companion Dog Inquiry
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-heart display-1 text-muted"></i>
                        <h4 class="mt-3">No companion dogs available at the moment</h4>
                        <p class="text-muted">Please check back soon!</p>
                    </div>
                @endforelse
            </div>

            @if($companionDogs->count() > 0)
                <div class="text-center mt-4">
                    <a href="{{ route('content-page.show', 'companion-dogs') }}" class="btn btn-outline-primary">
                        <i class="bi bi-info-circle me-2"></i>More About Our Companion Dogs
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Achievements Section -->
    <section id="achievements" class="achievements-section py-5">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-subtitle">Our Pride</span>
                <h2 class="section-title text-white">Achievements & Awards</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="flip-left" data-aos-delay="100">
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="bi bi-trophy-fill"></i>
                        </div>
                        <h3>{{ $achievement->competition_wins ?? 0 }}+</h3>
                        <p>Competition Wins</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="flip-left" data-aos-delay="200">
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <h3>{{ $achievement->best_in_shows ?? 0 }}+</h3>
                        <p>Best in Show</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="flip-left" data-aos-delay="300">
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h3>{{ $achievement->champions ?? 0 }}+</h3>
                        <p>Champion Dogs</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="flip-left" data-aos-delay="400">
                    <div class="achievement-card">
                        <div class="achievement-icon">
                            <i class="bi bi-globe"></i>
                        </div>
                        <h3>{{ $achievement->international_shows ?? 0 }}+</h3>
                        <p>International Shows</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-5" data-aos="fade-right">
                    <span class="section-subtitle">Get In Touch</span>
                    <h2 class="section-title">Contact Us</h2>
                    <p class="mb-4">Have questions about our dogs or training programs? We'd love to hear from you. Reach out and let's start a conversation.</p>

                    <div class="contact-info">
                        @if($settings?->address)
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <h5>Location</h5>
                                <p>{{ $settings->address }}</p>
                            </div>
                        </div>
                        @endif

                        @if($settings?->phone)
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <h5>Phone</h5>
                                <p><a href="tel:{{ $settings->phone }}" class="text-decoration-none text-light">{{ $settings->phone }}</a></p>
                            </div>
                        </div>
                        @endif

                        @if($settings?->email)
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <h5>Email</h5>
                                <p><a href="mailto:{{ $settings->email }}" class="text-decoration-none text-light">{{ $settings->email }}</a></p>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($settings?->facebook || $settings?->twitter || $settings?->instagram || $settings?->linkedin || $settings?->youtube)
                    <div class="social-links mt-4">
                        @if($settings->facebook)
                            <a href="{{ $settings->facebook }}" target="_blank" class="social-link" title="Facebook"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if($settings->instagram)
                            <a href="{{ $settings->instagram }}" target="_blank" class="social-link" title="Instagram"><i class="bi bi-instagram"></i></a>
                        @endif
                        @if($settings->twitter)
                            <a href="{{ $settings->twitter }}" target="_blank" class="social-link" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                        @endif
                        @if($settings->youtube)
                            <a href="{{ $settings->youtube }}" target="_blank" class="social-link" title="YouTube"><i class="bi bi-youtube"></i></a>
                        @endif
                    </div>
                    @endif
                </div>
                <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
                    <div class="contact-form-wrapper">
                        <style>
                            .contact-form .form-control::placeholder,
                            .contact-form .form-select option[disabled] {
                                color: rgba(255, 255, 255, 0.5) !important;
                                opacity: 1;
                            }
                            .contact-form .form-label {
                                color: rgba(255, 255, 255, 0.9);
                                font-weight: 500;
                            }
                        </style>
                        <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                @if($errors->contact->any())
                                    <div class="col-12">
                                        <div class="alert alert-danger mb-0">
                                            <ul class="mb-0">
                                                @foreach ($errors->contact->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <label for="contact_name" class="form-label">Your Name *</label>
                                    <input type="text" class="form-control @error('name', 'contact') is-invalid @enderror"
                                           id="contact_name" name="name" value="{{ old('name') }}"
                                           placeholder="Enter your name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="contact_email" class="form-label">Your Email *</label>
                                    <input type="email" class="form-control @error('email', 'contact') is-invalid @enderror"
                                           id="contact_email" name="email" value="{{ old('email') }}"
                                           placeholder="Enter your email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="contact_phone" class="form-label">Your Phone</label>
                                    <input type="tel" class="form-control @error('phone', 'contact') is-invalid @enderror"
                                           id="contact_phone" name="phone" value="{{ old('phone') }}"
                                           placeholder="Enter your phone number">
                                </div>
                                <div class="col-md-6">
                                    <label for="contact_subject" class="form-label">Subject *</label>
                                    <select class="form-select @error('subject', 'contact') is-invalid @enderror"
                                            id="contact_subject" name="subject" required>
                                        <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select a subject</option>
                                        <option value="training" {{ old('subject') == 'training' ? 'selected' : '' }}>Training Inquiry</option>
                                        <option value="breeding" {{ old('subject') == 'breeding' ? 'selected' : '' }}>Breeding Information</option>
                                        <option value="competition" {{ old('subject') == 'competition' ? 'selected' : '' }}>Competition Prep</option>
                                        <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="contact_message" class="form-label">Your Message *</label>
                                    <textarea class="form-control @error('message', 'contact') is-invalid @enderror"
                                              id="contact_message" name="message" rows="6"
                                              placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                                </div>
                                @include('frontend.partial.captcha', ['key' => 'contact', 'bag' => 'contact'])
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <span>Send Message</span>
                                        <i class="bi bi-send ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .pet-name-hover {
        transition: color 0.3s ease;
    }

    .pet-name-hover:hover {
        color: #667eea !important;
    }

    .view-details-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s ease;
        text-align: center;
        z-index: 5;
    }

    .dog-card:hover .view-details-overlay {
        opacity: 1;
    }

    .dog-card:hover .dog-overlay {
        background: rgba(0, 0, 0, 0.7);
    }

    .dog-card {
        transition: transform 0.3s ease;
    }

    .dog-card:hover {
        transform: translateY(-10px);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6',
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('error') }}',
        confirmButtonColor: '#d33',
    });
@endif
</script>
@endpush
