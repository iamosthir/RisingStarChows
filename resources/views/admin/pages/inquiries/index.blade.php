@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contact Inquiries</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.inquiries.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Inquiry
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
                            <th>#ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inquiries as $inquiry)
                            <tr class="{{ $inquiry->is_read ? '' : 'table-warning' }}">
                                <td>{{ $inquiry->id }}</td>
                                <td>
                                    @if(!$inquiry->is_read)
                                        <strong>{{ $inquiry->full_name }}</strong>
                                    @else
                                        {{ $inquiry->full_name }}
                                    @endif
                                </td>
                                <td>{{ $inquiry->email }}</td>
                                <td>{{ $inquiry->phone }}</td>
                                <td>
                                    @if($inquiry->is_read)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle"></i> Read
                                        </span>
                                    @else
                                        <span class="badge badge-warning">
                                            <i class="fas fa-envelope"></i> Unread
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $inquiry->created_at->format('M d, Y') }}</td>
                                <td>
                                    <form action="{{ route('admin.inquiries.toggle-read', $inquiry->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-sm btn-{{ $inquiry->is_read ? 'warning' : 'success' }}"
                                                title="{{ $inquiry->is_read ? 'Mark as Unread' : 'Mark as Read' }}">
                                            <i class="fas fa-{{ $inquiry->is_read ? 'envelope' : 'check' }}"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.inquiries.show', $inquiry->id) }}"
                                       class="btn btn-sm btn-info"
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.inquiries.edit', $inquiry->id) }}"
                                       class="btn btn-sm btn-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}"
                                          method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No inquiries found. <a href="{{ route('admin.inquiries.create') }}">Add one now</a></td>
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
