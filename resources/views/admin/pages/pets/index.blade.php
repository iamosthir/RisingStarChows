@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pets</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.pets.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Pet
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible mx-3 mt-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Full Name</th>
                            <th>Call Name</th>
                            <th>Sex</th>
                            <th>Color</th>
                            <th>Reg No</th>
                            <th>Status</th>
                            <th>Reserved</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pets as $pet)
                            <tr>
                                <td>
                                    @if($pet->primaryImg)
                                        <img src="{{ asset($pet->primaryImg) }}" alt="{{ $pet->full_name }}"
                                             class="img-thumbnail" style="max-height: 50px; max-width: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary text-center" style="width: 50px; height: 50px; line-height: 50px;">
                                            <i class="fas fa-dog"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    {{ $pet->full_name }}
                                    @if($pet->is_featured_dog)
                                        <span class="badge badge-primary ml-2">
                                            <i class="fas fa-star"></i> Featured
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $pet->call_name }}</td>
                                <td>
                                    @if($pet->sex)
                                        <span class="badge badge-{{ $pet->sex == 'Male' ? 'info' : 'warning' }}">
                                            {{ $pet->sex }}
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $pet->color }}</td>
                                <td>{{ $pet->reg_no }}</td>
                                <td>{{ $pet->status }}</td>
                                <td>
                                    @if($pet->is_reserved)
                                        <span class="badge badge-warning">
                                            <i class="fas fa-check-circle"></i> Reserved
                                        </span>
                                    @else
                                        <span class="badge badge-success">
                                            <i class="fas fa-circle"></i> Available
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.pets.toggle-reservation', $pet->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-sm btn-{{ $pet->is_reserved ? 'success' : 'warning' }}"
                                                title="{{ $pet->is_reserved ? 'Mark as Available' : 'Mark as Reserved' }}">
                                            <i class="fas fa-{{ $pet->is_reserved ? 'unlock' : 'lock' }}"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.pets.edit', $pet->id) }}"
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pets.destroy', $pet->id) }}"
                                          method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger delete-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No pets found. <a href="{{ route('admin.pets.create') }}">Add one now</a></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
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
