<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-comments mr-2"></i>
            Conversation History
        </h3>
        <div class="card-tools">
            <span class="badge badge-info">{{ $messages->count() }} Message(s)</span>
        </div>
    </div>
    <div class="card-body" id="conversation-container">
        @forelse($messages as $message)
            <div class="message-item {{ $message->sender_type === 'admin' ? 'admin-message' : 'user-message' }}" data-message-id="{{ $message->id }}">
                <div class="message-header">
                    <div class="message-avatar">
                        <div class="avatar-circle {{ $message->sender_type === 'admin' ? 'bg-success' : 'bg-primary' }}">
                            {{ $message->sender_initials }}
                        </div>
                    </div>
                    <div class="message-meta">
                        <strong>{{ $message->sender_name }}</strong>
                        <span class="text-muted ml-2">
                            <i class="far fa-clock"></i> {{ $message->formatted_sent_at }}
                        </span>
                        @if($message->sender_type === 'user' && !$message->is_read)
                            <span class="badge badge-warning ml-2">New</span>
                        @endif
                    </div>
                </div>
                <div class="message-body">
                    {!! nl2br(e($message->message_text)) !!}
                </div>
            </div>
        @empty
            <div class="text-center text-muted py-4">
                <i class="fas fa-inbox fa-3x mb-3"></i>
                <p>No messages yet. Click "Send Reply" to start the conversation.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    .message-item {
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        background: #f8f9fa;
        border-left: 4px solid #007bff;
    }

    .message-item.admin-message {
        background: #e7f9f0;
        border-left-color: #28a745;
    }

    .message-item.user-message {
        background: #e3f2fd;
        border-left-color: #007bff;
    }

    .message-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .message-avatar {
        margin-right: 15px;
    }

    .avatar-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 16px;
    }

    .message-meta {
        flex: 1;
    }

    .message-body {
        padding-left: 60px;
        color: #495057;
        line-height: 1.6;
        font-size: 15px;
    }

    .message-body p {
        margin-bottom: 0.5rem;
    }

    .message-body p:last-child {
        margin-bottom: 0;
    }
</style>
