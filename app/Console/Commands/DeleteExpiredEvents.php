<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;

class DeleteExpiredEvents extends Command
{
    protected $signature = 'events:delete';

    protected $description = 'Delete expired events';

    public function handle()
    {
        $yesterday = Carbon::yesterday();

        Event::whereDate('event_date', '<=', $yesterday)
                ->delete();

        $this->info('Expired events deleted');
    }
}
