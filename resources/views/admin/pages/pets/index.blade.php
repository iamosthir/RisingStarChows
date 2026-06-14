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

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible mx-3 mt-3">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Bulk Action Bar -->
            <form action="{{ route('admin.pets.bulk-update') }}" method="POST" id="bulkPetsForm" class="px-3 pt-3">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label for="bulk_category" class="small mb-1">Set Category</label>
                        <select class="form-control form-control-sm" name="bulk_category" id="bulk_category">
                            <option value="">— No change —</option>
                            <option value="Puppies">Puppies</option>
                            <option value="Breeding Dog">Breeding Dog</option>
                            <option value="Companion Dog">Companion Dog</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="bulk_available_status" class="small mb-1">Set Available Status</label>
                        <select class="form-control form-control-sm" name="bulk_available_status" id="bulk_available_status">
                            <option value="">— No change —</option>
                            <option value="available">Available</option>
                            <option value="not available">Not Available</option>
                        </select>
                    </div>
                    <div class="col-md-6 text-right">
                        <span id="bulkSelectionCount" class="text-muted mr-2">0 selected</span>
                        <button type="submit" class="btn btn-primary btn-sm" id="bulkApplyBtn" disabled>
                            <i class="fas fa-check"></i> Apply to Selected
                        </button>
                    </div>
                </div>
                <hr class="mb-0">
            </form>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 36px;">
                                <input type="checkbox" id="selectAllPets" title="Select all">
                            </th>
                            <th>Image</th>
                            <th>Full Name</th>
                            <th>Call Name</th>
                            <th>Sex</th>
                            <th>Color</th>
                            <th>Reg No</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Available</th>
                            <th>Reserved</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pets as $pet)
                            <tr>
                                <td>
                                    <input type="checkbox" class="pet-checkbox"
                                           name="pet_ids[]" value="{{ $pet->id }}"
                                           form="bulkPetsForm">
                                </td>
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
                                    @if($pet->category)
                                        <span class="badge badge-{{ $pet->category === 'Puppies' ? 'info' : 'secondary' }}">
                                            {{ $pet->category }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($pet->available_status === 'not available')
                                        <span class="badge badge-secondary">Not Available</span>
                                    @else
                                        <span class="badge badge-success">Available</span>
                                    @endif
                                </td>
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
                                <td colspan="12" class="text-center">No pets found. <a href="{{ route('admin.pets.create') }}">Add one now</a></td>
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

    // Bulk selection handling
    const $selectAll = $('#selectAllPets');
    const $rowBoxes = $('.pet-checkbox');
    const $applyBtn = $('#bulkApplyBtn');
    const $count = $('#bulkSelectionCount');

    function refreshBulkState() {
        const checked = $rowBoxes.filter(':checked').length;
        $count.text(checked + ' selected');
        $applyBtn.prop('disabled', checked === 0);
        $selectAll.prop('checked', checked > 0 && checked === $rowBoxes.length);
        $selectAll.prop('indeterminate', checked > 0 && checked < $rowBoxes.length);
    }

    $selectAll.on('change', function() {
        $rowBoxes.prop('checked', this.checked);
        refreshBulkState();
    });

    $rowBoxes.on('change', refreshBulkState);

    $('#bulkPetsForm').on('submit', function(e) {
        const cat = $('#bulk_category').val();
        const avail = $('#bulk_available_status').val();
        const count = $rowBoxes.filter(':checked').length;

        if (!cat && !avail) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Nothing to update',
                text: 'Please choose Category and/or Available Status to apply.',
            });
            return;
        }

        e.preventDefault();
        const summary = [];
        if (cat) summary.push('Category → <strong>' + cat + '</strong>');
        if (avail) summary.push('Available Status → <strong>' + avail + '</strong>');

        Swal.fire({
            title: 'Apply bulk update?',
            html: 'This will update <strong>' + count + '</strong> pet(s):<br>' + summary.join('<br>'),
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, apply',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#3085d6',
        }).then((result) => {
            if (result.isConfirmed) {
                $('#bulkPetsForm')[0].submit();
            }
        });
    });

    refreshBulkState();
});
</script>
@endpush
