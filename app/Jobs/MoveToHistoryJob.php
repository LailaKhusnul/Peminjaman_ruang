<?php

namespace App\Jobs;

use App\Models\PeminjamanUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class MoveToHistoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Untuk history user
        {
            // Ambil waktu sekarang
            $now = Carbon::now();
            // Untuk memindahkan peminjaman yang telah selesai ke history
            $peminjamanSiapPindah = PeminjamanUser::where('tanggal_selesai', '<', $now)
                                    ->where('status', 'approved')
                                    ->where('is_history', false)
                                    ->get();
    
            // Looping untuk memperbarui status ke history
            foreach ($peminjamanSiapPindah as $pinjam) {
                $pinjam->update(['is_history' => true]);
            }
        }
    }
}
