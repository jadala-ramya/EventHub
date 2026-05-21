<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;

class ExpireEvents extends Command
{
    protected $signature = 'events:expire';

    protected $description = 'Expire old events';

    public function handle()
    {
        Event::whereDate('event_date', '<', Carbon::today())
            ->update([
                'status' => 'expired'
            ]);

        $this->info('Expired events updated.');
    }
}
