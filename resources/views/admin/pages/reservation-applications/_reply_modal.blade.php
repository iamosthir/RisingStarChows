<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="replyModalLabel">
                    <i class="fas fa-reply mr-2"></i>
                    Send Reply to {{ $application->user_name }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="replyForm">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Recipient:</strong> {{ $application->email }}<br>
                        <strong>Application:</strong> #{{ $application->id }}
                        @if($application->pet)
                            - {{ $application->pet->call_name ?? $application->pet->full_name }}
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="message-editor">Your Message <span class="text-danger">*</span></label>
                        <textarea id="message-editor" name="message" rows="8" class="form-control"></textarea>
                        <small class="form-text text-muted">
                            Write your reply message. You can use formatting tools above.
                        </small>
                        <div class="invalid-feedback" id="message-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary" id="sendReplyBtn">
                        <i class="fas fa-paper-plane mr-2"></i>Send Reply
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Summernote
    $('#message-editor').summernote({
        height: 250,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['view', ['codeview']]
        ],
        placeholder: 'Type your message here...'
    });

    // Handle form submission
    $('#replyForm').on('submit', function(e) {
        e.preventDefault();

        const message = $('#message-editor').summernote('code');

        // Basic validation
        if (!message || message.trim() === '' || message === '<p><br></p>') {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please enter a message before sending.',
            });
            return;
        }

        const $btn = $('#sendReplyBtn');
        const originalText = $btn.html();

        // Disable button and show loading
        $btn.prop('disabled', true)
            .html('<i class="fas fa-spinner fa-spin mr-2"></i>Sending...');

        // Send AJAX request
        $.ajax({
            url: '{{ route("admin.application-messages.reply", $application) }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                message: message
            },
            success: function(response) {
                // Reset form
                $('#message-editor').summernote('reset');
                $('#replyModal').modal('hide');

                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Your reply has been sent successfully.',
                    timer: 2000,
                    showConfirmButton: false
                });

                // Fetch latest messages to update conversation
                fetchLatestMessages();
            },
            error: function(xhr) {
                let errorMessage = 'Failed to send reply. Please try again.';

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMessage = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: errorMessage
                });
            },
            complete: function() {
                // Re-enable button
                $btn.prop('disabled', false).html(originalText);
            }
        });
    });

    // Reset form when modal is closed
    $('#replyModal').on('hidden.bs.modal', function() {
        $('#message-editor').summernote('reset');
        $('.invalid-feedback').hide();
    });
});
</script>
@endpush
