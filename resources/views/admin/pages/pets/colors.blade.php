@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pet Colors</h3>
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

            <div class="card-body">
                <!-- Add New Color Form -->
                <form action="{{ route('admin.pet-colors.store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-0">
                                <label for="color_name">Add New Color</label>
                                <input type="text" class="form-control @error('color_name') is-invalid @enderror"
                                       id="color_name" name="color_name" value="{{ old('color_name') }}"
                                       placeholder="Enter color name" required>
                                @error('color_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-plus"></i> Add Color
                            </button>
                        </div>
                    </div>
                </form>

                <hr>

                <!-- Colors List -->
                <h5 class="mb-3">Existing Colors</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 80px;">#</th>
                                <th>Color Name</th>
                                <th style="width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($colors as $color)
                                <tr id="color-row-{{ $color->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="color-name-display">{{ $color->color_name }}</span>
                                        <form class="color-edit-form" style="display: none;"
                                              action="{{ route('admin.pet-colors.update', $color->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="color_name"
                                                       value="{{ $color->color_name }}" required>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-secondary btn-sm cancel-edit">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm edit-color-btn">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="{{ route('admin.pet-colors.destroy', $color->id) }}"
                                              method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No colors found. Add one using the form above.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Edit button click
    $('.edit-color-btn').on('click', function() {
        const row = $(this).closest('tr');
        row.find('.color-name-display').hide();
        row.find('.color-edit-form').show();
        $(this).hide();
    });

    // Cancel edit button click
    $('.cancel-edit').on('click', function() {
        const row = $(this).closest('tr');
        row.find('.color-name-display').show();
        row.find('.color-edit-form').hide();
        row.find('.edit-color-btn').show();
    });

    // Delete confirmation with SweetAlert
    $('.delete-btn').on('click', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush
