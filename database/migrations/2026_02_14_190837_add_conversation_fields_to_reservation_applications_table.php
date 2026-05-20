<?php

use App\Models\ApplicationMessage;
use App\Models\ReservationApplication;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reservation_applications', function (Blueprint $table) {
            $table->timestamp('last_message_at')->nullable()->after('status');
            $table->integer('unread_messages_count')->default(0)->after('last_message_at');
            $table->string('email_thread_id')->nullable()->after('unread_messages_count');

            $table->index('last_message_at');
        });

        // Convert existing inquiries to initial messages
        $this->convertInquiriesToMessages();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation_applications', function (Blueprint $table) {
            $table->dropIndex(['last_message_at']);
            $table->dropColumn(['last_message_at', 'unread_messages_count', 'email_thread_id']);
        });
    }

    /**
     * Convert existing application inquiries to initial messages
     */
    private function convertInquiriesToMessages(): void
    {
        ReservationApplication::chunk(100, function ($applications) {
            foreach ($applications as $application) {
                if ($application->inquiry) {
                    ApplicationMessage::create([
                        'reservation_application_id' => $application->id,
                        'sender_type' => 'user',
                        'sender_id' => null,
                        'message_text' => $application->inquiry,
                        'message_html' => nl2br(e($application->inquiry)),
                        'is_read' => true, // Already seen by admin
                        'sent_at' => $application->created_at,
                    ]);

                    $application->update([
                        'last_message_at' => $application->created_at,
                        'unread_messages_count' => 0,
                        'email_thread_id' => 'APP-' . $application->id . '-' . time(),
                    ]);
                }
            }
        });
    }
};
