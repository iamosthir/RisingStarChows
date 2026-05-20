@extends("frontend.layouts.master")

@section("content")
    <style>
        .reservation-page {
            background: linear-gradient(135deg, #1a1a2e 0%, #0f0f1e 100%);
            min-height: 100vh;
            color: #fff;
        }
        .reservation-page .page-header {
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.3) 0%, rgba(218, 165, 32, 0.2) 100%);
            border-bottom: 2px solid rgba(218, 165, 32, 0.3);
        }
        .reservation-page .card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: #fff;
        }
        .reservation-page .card-title {
            color: #d4af37;
        }
        .reservation-page .form-control,
        .reservation-page .form-select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }
        .reservation-page .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        .reservation-page .form-control:focus,
        .reservation-page .form-select:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #d4af37;
            color: #fff;
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
        }
        .reservation-page .form-label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }
        .reservation-page .border-bottom {
            border-color: rgba(255, 255, 255, 0.1) !important;
        }
        .reservation-page .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }
        .reservation-page .badge-success {
            background-color: #28a745;
        }
    </style>

    <div class="reservation-page">
        <!-- Page Header -->
        <section class="page-header py-5" style="margin-top: 76px;">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <span class="section-subtitle">Reserve Now</span>
                        <h1 class="section-title">Puppy Reservation</h1>
                        <p class="lead">Complete the form below to reserve this beautiful puppy</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Reservation Section -->
        <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Puppy Details -->
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="card shadow-sm sticky-top" style="top: 100px;">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Puppy Details</h4>

                            @if($pet->primaryImg)
                                <img src="{{ asset($pet->primaryImg) }}" alt="{{ $pet->full_name }}"
                                     class="img-fluid rounded mb-3" style="width: 100%; height: 300px; object-fit: cover;">
                            @endif

                            <h5 class="mb-3">{{ $pet->call_name ?? $pet->full_name }}</h5>

                            <div class="puppy-info-list">
                                @if($pet->sex)
                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <strong>Sex:</strong>
                                        <span>{{ $pet->sex }}</span>
                                    </div>
                                @endif

                                @if($pet->birthdate)
                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <strong>Age:</strong>
                                        <span>{{ $pet->birthdate->diffForHumans() }}</span>
                                    </div>
                                @endif

                                @if($pet->color)
                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <strong>Color:</strong>
                                        <span>{{ $pet->color_name }}</span>
                                    </div>
                                @endif

                                @if($pet->reg_no)
                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <strong>Registration No:</strong>
                                        <span>{{ $pet->reg_no }}</span>
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between py-2">
                                    <strong>Status:</strong>
                                    <span class="badge badge-success">Available</span>
                                </div>
                            </div>

                            @if($pet->description)
                                <div class="mt-3">
                                    <h6>Description:</h6>
                                    <p class="text-muted">{{ $pet->description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Reservation Form -->
                <div class="col-lg-7">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Reservation Form</h4>

                            <form action="{{ route('reservation.submit') }}" method="POST" id="reservationForm">
                                @csrf
                                <input type="hidden" name="pet_id" value="{{ $pet->id }}">

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="user_name" class="form-label">Full Name *</label>
                                        <input type="text"
                                               class="form-control @error('user_name') is-invalid @enderror"
                                               id="user_name"
                                               name="user_name"
                                               value="{{ old('user_name') }}"
                                               placeholder="Enter your full name"
                                               required>
                                        @error('user_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               id="email"
                                               name="email"
                                               value="{{ old('email') }}"
                                               placeholder="Enter your email"
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number *</label>
                                        <input type="tel"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               id="phone"
                                               name="phone"
                                               value="{{ old('phone') }}"
                                               placeholder="Enter your phone number"
                                               required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="inquiry" class="form-label">Your Message *</label>
                                        <textarea class="form-control @error('inquiry') is-invalid @enderror"
                                                  id="inquiry"
                                                  name="inquiry"
                                                  rows="5"
                                                  placeholder="Tell us why you'd like to reserve this puppy..."
                                                  required>{{ old('inquiry') }}</textarea>
                                        @error('inquiry')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @include('frontend.partial.captcha', ['key' => 'reservation'])

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            <i class="bi bi-send-fill me-2"></i>
                                            Submit Reservation Request
                                        </button>
                                    </div>

                                    <div class="col-12 text-center">
                                        <small class="text-muted">* Required fields</small>
                                    </div>
                                </div>
                            </form>
                        </div>
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
