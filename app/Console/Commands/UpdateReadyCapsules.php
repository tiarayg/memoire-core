<?php

namespace App\Console\Commands;

use App\Models\Capsule;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:update-ready-capsules')]
#[Description('Update sealed capsules that are ready to be opened')]
class UpdateReadyCapsules extends Command
{
    public function handle()
    {
        $updated = Capsule::where('status', 'sealed')
            ->whereNotNull('open_at')
            ->where('open_at', '<=', now())
            ->update([
                'status' => 'ready',
            ]);

        $this->info("{$updated} capsule(s) updated to ready.");

        return self::SUCCESS;
    }
}