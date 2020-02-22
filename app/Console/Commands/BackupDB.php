<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class BackupDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:db {--c}';

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
        $isCustom = $this->option('c');
        $path = storage_path('app' . DIRECTORY_SEPARATOR . 'backups');

        $date = Carbon::now()->format('Y_m_d_h_i_s');
        $fileName = !$isCustom ? "automatic-" . $date . ".sql" : 'custom-' . $date . '.sql';
        $database = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASSWORD');
        $host = env('DB_HOST');
        $dir = $path . DIRECTORY_SEPARATOR . $fileName;

        exec("mysqldump --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);
    }
}
