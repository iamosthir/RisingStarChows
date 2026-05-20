@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Reservation Application</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.reservation-applications.index') }}" class="btn btn-secondary btn-sm">
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

            <form action="{{ route('admin.reservation-applications.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3">Pet Information</h5>

                            <div class="form-group">
                                <label for="pet_id">Pet <span class="text-danger">*</span></label>
                                <select class="form-control @error('pet_id') is-invalid @enderror"
                                        id="pet_id" name="pet_id" required>
                                    <option value="">Select a pet</option>
                                    @foreach($pets as $pet)
                                        <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
                                            {{ $pet->full_name }} ({{ $pet->call_name }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('pet_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="color">Preferred Color <span class="text-danger">*</span></label>
                                <select class="form-control @error('color') is-invalid @enderror"
                                        id="color" name="color" required>
                                    <option value="">Select a color</option>
                                    @foreach($colors as $color)
                                        <option value="{{ $color->color_name }}" {{ old('color') == $color->color_name ? 'selected' : '' }}>
                                            {{ $color->color_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('color')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                <select class="form-control @error('gender') is-invalid @enderror"
                                        id="gender" name="gender" required>
                                    <option value="">Select gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Litter" {{ old('gender') == 'Litter' ? 'selected' : '' }}>Litter</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h5 class="mb-3">Applicant Information</h5>

                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}"
                                       placeholder="Enter full name" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}"
                                       placeholder="Enter email address" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                       id="phone" name="phone" value="{{ old('phone') }}"
                                       placeholder="Enter phone number" required>
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror"
                                          id="address" name="address" rows="3"
                                          placeholder="Enter full address" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inquiry">Additional Notes / Inquiry <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('inquiry') is-invalid @enderror"
                                          id="inquiry" name="inquiry" rows="4"
                                          placeholder="Enter any additional notes or questions" required>{{ old('inquiry') }}</textarea>
                                @error('inquiry')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Application
                    </button>
                    <a href="{{ route('admin.reservation-applications.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
