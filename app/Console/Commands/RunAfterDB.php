<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RunAfterDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:runAfterDB';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run another artisan command after database is responding';

    /**
     * Number of connection attempts to do.
     *
     * @var integer
     */
    protected $attempts = 5;

    /**
     * Current attempt count.
     *
     * @var integer
     */
    protected $attemptCount = 0;

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
     * @return int
     */
    public function handle()
    {
        while ($this->attemptCount <= $this->attempts) {

            if($this->tryConnection()) {
                echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
            } else {
                sleep(2);
                $this->info('Could not connect yet, sleeping for 2s...');
            }
        }
    }

    /**
     * Try connecting to the database.
     *
     * @return int
     */
    public function tryConnection()
    {

        if ($this->attemptCount >= $this->attempts) {
            $this->error('Connection attempts exceeded');
            die('Connection attempts exceeded');
        }

        $this->attemptCount++;

        try {
            if(DB::connection()->getPdo()) {
                return true;
            }
        } catch (\Exception $e) {
            $this->info($e->getMessage());
            return false;
        }
    }
}
