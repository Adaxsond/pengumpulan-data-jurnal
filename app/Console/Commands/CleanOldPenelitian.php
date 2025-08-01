<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Penelitian;
use Carbon\Carbon;

class CleanOldPenelitian extends Command
{
    protected $signature = 'penelitian:clean';
    protected $description = 'Menghapus permanen data penelitian yang dihapus lebih dari 30 hari';

    public function handle()
    {
        $limitDate = Carbon::now()->subDays(30);

        $deleted = Penelitian::onlyTrashed()
            ->where('deleted_at', '<=', $limitDate)
            ->forceDelete();

        $this->info("Data penelitian lama berhasil dihapus permanen!");
    }
}
