@extends("frontend.layouts.master")

@section("content")
    <!-- Page Header -->
    <section class="page-header py-5 bg-dark" style="margin-top: 76px;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <span class="section-subtitle">Available Now</span>
                    <h1 class="section-title">Our Pets</h1>
                    <p class="lead text-muted">Browse our beautiful collection of pets</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="filters-section py-5">
        <div class="container">
            <form action="{{ route('pets') }}" method="GET">
                <div class="row g-3 justify-content-center">
                    <!-- Search Input -->
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-lg" name="search" placeholder="Search pets by name..." value="{{ request('search') }}">
                    </div>

                    <!-- Gender Filter -->
                    <div class="col-md-2">
                        <select class="form-select form-select-lg" name="sex">
                            <option value="">All Genders</option>
                            <option value="Male" {{ request('sex') === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ request('sex') === 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <!-- Color Filter -->
                    <div class="col-md-2">
                        <select class="form-select form-select-lg" name="color">
                            <option value="">All Colors</option>
                            @foreach($colors as $color)
                                <option value="{{ $color->color_name }}" {{ request('color') === $color->color_name ? 'selected' : '' }}>
                                    {{ $color->color_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-search me-1"></i>Search
                        </button>
                    </div>

                    @if(request()->hasAny(['search', 'sex', 'color']))
                        <div class="col-12 text-center mt-2">
                            <a href="{{ route('pets') }}" class="btn btn-link">
                                <i class="bi bi-x-circle me-1"></i>Clear Filters
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </section>

    <!-- Pets Grid Section -->
    <section class="pets-grid-section py-5">
        <div class="container">
            @if($pets->count() > 0)
                <div class="row g-4 mb-5">
                    @foreach($pets as $pet)
                        <div class="col-md-6 col-lg-4" data-aos="zoom-in">
                            <div class="puppy-card h-100">
                                <div class="puppy-badge {{ $pet->is_reserved ? 'reserved' : 'available' }}">
                                    {{ $pet->is_reserved ? 'Reserved' : 'Available' }}
                                </div>
                                <div class="puppy-image" style="height: 280px; overflow: hidden; position: relative;">
                                    @if($pet->primaryImg)
                                        <img src="{{ asset($pet->primaryImg) }}" alt="{{ $pet->full_name }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=600'">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=600" alt="Placeholder" style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="puppy-details">
                                    <a href="{{ route('pet.details', $pet->slug) }}" class="text-decoration-none text-dark">
                                        <h4 class="pet-name-hover">{{ $pet->call_name ?? $pet->full_name }}</h4>
                                    </a>
                                    <div class="puppy-info-row">
                                        <span><i class="bi bi-{{ $pet->sex === 'Male' ? 'gender-male' : 'gender-female' }}"></i> {{ $pet->sex }}</span>
                                        @if($pet->birthdate)
                                            <span><i class="bi bi-calendar3"></i> {{ $pet->birthdate->diffForHumans() }}</span>
                                        @endif
                                    </div>
                                    @if($pet->color)
                                        <div class="puppy-info-row">
                                            <span><i class="bi bi-palette"></i> {{ $pet->color_name }}</span>
                                        </div>
                                    @endif
                                    @if($pet->reg_no)
                                        <div class="puppy-info-row">
                                            <span><i class="bi bi-card-text"></i> Reg: {{ $pet->reg_no }}</span>
                                        </div>
                                    @endif
                                    @if($pet->description)
                                        <p class="puppy-description">{{ Str::limit($pet->description, 100) }}</p>
                                    @endif
                                    @if(!$pet->is_reserved)
                                        <a href="{{ route('reservation.show', $pet->id) }}" class="btn btn-primary w-100">
                                            <i class="bi bi-heart-fill me-2"></i>Reserve Now
                                        </a>
                                    @else
                                        <button class="btn btn-secondary w-100" disabled>
                                            <i class="bi bi-check-circle me-2"></i>Reserved
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $pets->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-search display-1 text-muted"></i>
                    <h3 class="mt-3">No pets found</h3>
                    <p class="text-muted">Try adjusting your filters or search terms</p>
                    <a href="{{ route('pets') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Filters
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Scroll to Reservation Form Section -->
    @if($pets->count() > 0)
        <section class="cta-section py-5 bg-dark">
            <div class="container text-center">
                <h2 class="mb-3">Found Your Perfect Pet?</h2>
                <p class="lead mb-4">Fill out our reservation form to secure your new family member</p>
                <a href="{{ route('home') }}#puppies" class="btn btn-primary btn-lg">
                    <i class="bi bi-heart-fill me-2"></i>Go to Reservation Form
                </a>
            </div>
        </section>
    @endif
@endsection
