<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportSql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:db {file_name}';

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
        $fileName = $this->argument('file_name');
        $path = storage_path('app' . DIRECTORY_SEPARATOR . 'backups');
        $database = config('database.connections.mysql.database');
        $user = config('database.connections.mysql.username');
        $pass = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
        $dir = $path . DIRECTORY_SEPARATOR . $fileName;

        exec("mysql --user={$user} --password={$pass} --host={$host} {$database} < $dir", $output);
    }
}
