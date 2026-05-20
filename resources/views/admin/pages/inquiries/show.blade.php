@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Inquiry Details #{{ $inquiry->id }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.inquiries.edit', $inquiry->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">Inquiry Information</h5>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="200">Inquiry ID</th>
                                    <td>{{ $inquiry->id }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
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
                                </tr>
                                <tr>
                                    <th>Received Date</th>
                                    <td>{{ $inquiry->created_at->format('F d, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $inquiry->updated_at->format('F d, Y h:i A') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Contact Information</h5>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="200">Full Name</th>
                                    <td>{{ $inquiry->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>
                                        <a href="mailto:{{ $inquiry->email }}">
                                            {{ $inquiry->email }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>
                                        <a href="tel:{{ $inquiry->phone }}">
                                            {{ $inquiry->phone }}
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="mb-3">Inquiry Message</h5>
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-0" style="white-space: pre-line;">{{ $inquiry->inquiry }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <form action="{{ route('admin.inquiries.toggle-read', $inquiry->id) }}"
                      method="POST" class="d-inline">
                    @csrf
                    <button type="submit"
                            class="btn btn-{{ $inquiry->is_read ? 'warning' : 'success' }}">
                        <i class="fas fa-{{ $inquiry->is_read ? 'envelope' : 'check' }}"></i>
                        {{ $inquiry->is_read ? 'Mark as Unread' : 'Mark as Read' }}
                    </button>
                </form>
                <a href="{{ route('admin.inquiries.edit', $inquiry->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Inquiry
                </a>
                <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}"
                      method="POST" class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger delete-btn">
                        <i class="fas fa-trash"></i> Delete Inquiry
                    </button>
                </form>
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
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
