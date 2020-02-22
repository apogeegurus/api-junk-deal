<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class ClearBackups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:backups';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach(glob(storage_path('app' . DIRECTORY_SEPARATOR .'backups') . DIRECTORY_SEPARATOR . '*.*') as $file) {
            $fileNameBackup = explode('-', last(explode(DIRECTORY_SEPARATOR, $file)));
            $type = $fileNameBackup[0];
            if($type === 'automatic') {
                $fileName = $fileNameBackup[1];
                $fileDate = explode('.', $fileName);
                /** @var Carbon $date */
                $date = Carbon::createFromFormat('Y_m_d_h_i_s', $fileDate[0]);

                $daysDiff = $date->diffInDays(Carbon::now());
                if($daysDiff > 7) {
                    unlink($file);
                }
            }
        }
    }
}
