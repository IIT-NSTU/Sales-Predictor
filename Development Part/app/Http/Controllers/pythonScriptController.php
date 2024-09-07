<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pythonScriptController extends Controller
{
    public function runScript()
    {
        // Define the Python script path using base_path to get the root directory
        $scriptPath = base_path('python-scripts/example.py');

        // Quote the script path to handle spaces in the directory names
        $scriptPath = escapeshellarg($scriptPath);

        // Define any arguments you want to pass to the script
        $name = 'Laravel';

        // Construct the command to run the Python script
        $command = escapeshellcmd("python $scriptPath $name");

        // Execute the command and capture the output
        $output = shell_exec($command . ' 2>&1');

        // Return the output as a response
        return response()->json(['output' => $output]);
    }
}
