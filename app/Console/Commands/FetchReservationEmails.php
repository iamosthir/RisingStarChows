<?php

namespace App\Console\Commands;

use App\Services\EmailFetchService;
use Illuminate\Console\Command;

class FetchReservationEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:fetch
                            {--application= : Fetch emails for a specific application ID}
                            {--since= : Fetch emails since a specific date/time}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch new emails from IMAP server and link to reservation applications';

    /**
     * Execute the console command.
     */
    public function handle(EmailFetchService $emailFetchService): int
    {
        $this->info('Fetching emails from IMAP server...');

        $applicationId = $this->option('application');
        $since = $this->option('since');

        if ($applicationId) {
            $this->info("Filtering for application ID: {$applicationId}");
        }

        if ($since) {
            $this->info("Fetching emails since: {$since}");
        }

        try {
            $results = $emailFetchService->fetchNewEmails(
                $applicationId ? (int) $applicationId : null,
                $since
            );

            $this->newLine();
            $this->info('📧 Fetch Results:');
            $this->table(
                ['Metric', 'Count'],
                [
                    ['Fetched', $results['fetched']],
                    ['Stored', $results['stored']],
                    ['Duplicates', $results['duplicates']],
                    ['Rejected', $results['rejected']],
                ]
            );

            if (!empty($results['errors'])) {
                $this->newLine();
                $this->error('❌ Errors encountered:');
                foreach ($results['errors'] as $error) {
                    $this->line('  • ' . $error);
                }
            }

            if ($results['stored'] > 0) {
                $this->newLine();
                $this->info("✅ Successfully stored {$results['stored']} new message(s)");
            }

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('❌ Command failed: ' . $e->getMessage());
            $this->error($e->getTraceAsString());
            return Command::FAILURE;
        }
    }
}
