@extends("admin.layouts.master")

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Reservation Application Details #{{ $reservationApplication->id }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.reservation-applications.edit', $reservationApplication->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.reservation-applications.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">Application Information</h5>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="200">Application ID</th>
                                    <td>{{ $reservationApplication->id }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($reservationApplication->status === 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($reservationApplication->status === 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created Date</th>
                                    <td>{{ $reservationApplication->created_at->format('F d, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $reservationApplication->updated_at->format('F d, Y h:i A') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <h5 class="mb-3 mt-4">Pet Information</h5>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="200">Pet Name</th>
                                    <td>{{ $reservationApplication->pet->full_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Call Name</th>
                                    <td>{{ $reservationApplication->pet->call_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Sex</th>
                                    <td>{{ $reservationApplication->pet->sex ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td>{{ $reservationApplication->pet->color ?? 'N/A' }}</td>
                                </tr>
                                @if($reservationApplication->pet && $reservationApplication->pet->primaryImg)
                                <tr>
                                    <th>Pet Image</th>
                                    <td>
                                        <img src="{{ asset($reservationApplication->pet->primaryImg) }}"
                                             alt="{{ $reservationApplication->pet->full_name }}"
                                             class="img-thumbnail" style="max-height: 150px;">
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Applicant Information</h5>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="200">Name</th>
                                    <td>{{ $reservationApplication->user_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>
                                        <a href="mailto:{{ $reservationApplication->email }}">
                                            {{ $reservationApplication->email }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>
                                        <a href="tel:{{ $reservationApplication->phone }}">
                                            {{ $reservationApplication->phone }}
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h5 class="mb-3 mt-4">Initial Inquiry</h5>
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-0" style="white-space: pre-line;">{{ $reservationApplication->inquiry }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#replyModal">
                    <i class="fas fa-reply"></i> Send Reply
                </button>
                <a href="{{ route('admin.reservation-applications.edit', $reservationApplication->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Application
                </a>
                <form action="{{ route('admin.reservation-applications.destroy', $reservationApplication->id) }}"
                      method="POST" class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger delete-btn">
                        <i class="fas fa-trash"></i> Delete Application
                    </button>
                </form>
                <a href="{{ route('admin.reservation-applications.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Conversation Section -->
<div class="row mt-4">
    <div class="col-md-12">
        @include('admin.pages.reservation-applications._conversation', [
            'application' => $reservationApplication,
            'messages' => $reservationApplication->messages
        ])
    </div>
</div>

<!-- Reply Modal -->
@include('admin.pages.reservation-applications._reply_modal', ['application' => $reservationApplication])
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-fetch latest emails on page load
    fetchLatestMessages();

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

// Fetch latest messages from email server
function fetchLatestMessages() {
    $.ajax({
        url: '{{ route("admin.application-messages.fetch", $reservationApplication) }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success && response.html) {
                $('#conversation-container').parent().replaceWith(response.html);
            }
        },
        error: function(xhr) {
            console.error('Failed to fetch latest messages:', xhr);
        }
    });
}
</script>
@endpush
