<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunPredictionScript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-prediction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the Python prediction using Laravel scheduler';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Define the Python script path using base_path to get the root directory
        $scriptPath = base_path('python-scripts/prediction.py');

        // Quote the script path to handle spaces in the directory names
        $scriptPath = escapeshellarg($scriptPath);

        // Construct the command to run the Python script
        $command = escapeshellcmd("python $scriptPath");

        // Execute the command and capture the output
        $output = shell_exec($command . ' 2>&1');

        // Log or display the output
        $this->info($output);
    }
}
