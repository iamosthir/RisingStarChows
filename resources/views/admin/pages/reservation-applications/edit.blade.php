@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Reservation Application #{{ $reservationApplication->id }}</h3>
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

            <form action="{{ route('admin.reservation-applications.update', $reservationApplication->id) }}" method="POST">
                @csrf
                @method('PUT')
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
                                        <option value="{{ $pet->id }}"
                                            {{ old('pet_id', $reservationApplication->pet_id) == $pet->id ? 'selected' : '' }}>
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
                                        <option value="{{ $color->color_name }}"
                                            {{ old('color', $reservationApplication->color) == $color->color_name ? 'selected' : '' }}>
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
                                    <option value="Male" {{ old('gender', $reservationApplication->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $reservationApplication->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Litter" {{ old('gender', $reservationApplication->gender) == 'Litter' ? 'selected' : '' }}>Litter</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                        id="status" name="status" required>
                                    <option value="pending" {{ old('status', $reservationApplication->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ old('status', $reservationApplication->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ old('status', $reservationApplication->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h5 class="mb-3">Applicant Information</h5>

                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name"
                                       value="{{ old('name', $reservationApplication->name) }}"
                                       placeholder="Enter full name" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email"
                                       value="{{ old('email', $reservationApplication->email) }}"
                                       placeholder="Enter email address" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                       id="phone" name="phone"
                                       value="{{ old('phone', $reservationApplication->phone) }}"
                                       placeholder="Enter phone number" required>
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror"
                                          id="address" name="address" rows="3"
                                          placeholder="Enter full address" required>{{ old('address', $reservationApplication->address) }}</textarea>
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
                                          placeholder="Enter any additional notes or questions" required>{{ old('inquiry', $reservationApplication->inquiry) }}</textarea>
                                @error('inquiry')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Application
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
