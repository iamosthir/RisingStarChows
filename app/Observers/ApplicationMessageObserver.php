<?php

namespace App\Observers;

use App\Models\ApplicationMessage;

class ApplicationMessageObserver
{
    /**
     * Handle the ApplicationMessage "created" event.
     */
    public function created(ApplicationMessage $message): void
    {
        $this->updateApplicationCounters($message);
    }

    /**
     * Handle the ApplicationMessage "updated" event.
     */
    public function updated(ApplicationMessage $message): void
    {
        // If is_read changed, update counters
        if ($message->wasChanged('is_read')) {
            $this->updateApplicationCounters($message);
        }
    }

    /**
     * Handle the ApplicationMessage "deleted" event.
     */
    public function deleted(ApplicationMessage $message): void
    {
        $this->updateApplicationCounters($message);
    }

    /**
     * Update the parent application's unread count and last message timestamp.
     */
    private function updateApplicationCounters(ApplicationMessage $message): void
    {
        $application = $message->reservationApplication;

        if (!$application) {
            return;
        }

        // Count unread user messages
        $unreadCount = $application->messages()
            ->where('sender_type', 'user')
            ->where('is_read', false)
            ->count();

        // Get the latest message timestamp
        $lastMessage = $application->messages()
            ->orderBy('sent_at', 'desc')
            ->first();

        // Update the application
        $application->update([
            'unread_messages_count' => $unreadCount,
            'last_message_at' => $lastMessage ? $lastMessage->sent_at : null,
        ]);
    }
}
