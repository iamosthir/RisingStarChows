<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationReplyRequest;
use App\Jobs\SendApplicationReply;
use App\Models\ApplicationMessage;
use App\Models\ReservationApplication;
use App\Services\EmailFetchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApplicationMessageController extends Controller
{
    /**
     * Store a new reply message.
     */
    public function store(StoreApplicationReplyRequest $request, ReservationApplication $application): JsonResponse
    {
        $validated = $request->validated();

        // Create the message record
        $message = ApplicationMessage::create([
            'reservation_application_id' => $application->id,
            'sender_type' => 'admin',
            'sender_id' => auth()->id(),
            'message_text' => strip_tags($validated['message']),
            'message_html' => $validated['message'],
            'is_read' => true, // Admin messages are pre-read
            'sent_at' => now(),
        ]);

        // Queue the email sending job
        SendApplicationReply::dispatch($message, $application);

        return response()->json([
            'success' => true,
            'message' => 'Reply sent successfully',
            'data' => [
                'message_id' => $message->id,
                'sent_at' => $message->formatted_sent_at,
            ],
        ]);
    }

    /**
     * Fetch latest emails for an application.
     */
    public function fetchLatest(ReservationApplication $application, EmailFetchService $emailFetchService): JsonResponse
    {
        try {
            // Fetch emails for this specific application
            $results = $emailFetchService->fetchNewEmails($application->id);

            // Reload application with messages
            $application->load(['messages' => function ($query) {
                $query->orderBy('sent_at', 'desc');
            }, 'messages.sender']);

            // Render the conversation HTML
            $html = view('admin.pages.reservation-applications._conversation', [
                'application' => $application,
                'messages' => $application->messages,
            ])->render();

            return response()->json([
                'success' => true,
                'html' => $html,
                'unread_count' => $application->unread_messages_count,
                'fetched' => $results['fetched'],
                'stored' => $results['stored'],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching emails: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Mark a message as read.
     */
    public function markRead(ApplicationMessage $message): JsonResponse
    {
        $message->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Message marked as read',
        ]);
    }
}
