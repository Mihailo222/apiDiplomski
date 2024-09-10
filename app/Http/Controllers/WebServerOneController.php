<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


class WebServerOneController extends Controller
{                  
    public function getWEBOneIP(Request $request){

        $scriptPath = base_path('scripts/getWEB1IP.sh');
        $process = new Process(['bash', $scriptPath]);
        $process->setWorkingDirectory(base_path()); 
        
        try {
        $process->mustRun();
        $output = trim($process->getOutput()); //bez \n
        
        return response()->json([
            'success' => true,
            'output' => $output
        ]);
        
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
        return "Error: " . $e->getMessage() . "\nError Output: " . $e->getProcess()->getErrorOutput();
        }
        
        return $process->getOutput();
        
        }


        public function getDataBaseIP(Request $request){

            $scriptPath = base_path('scripts/getDBIP.sh');
            $process = new Process(['bash', $scriptPath]);
            $process->setWorkingDirectory(base_path()); 
            
            try {
            $process->mustRun();
            $output = trim($process->getOutput()); //bez \n
            
            return response()->json([
                'success' => true,
                'output' => $output
            ]);
            
            } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return "Error: " . $e->getMessage() . "\nError Output: " . $e->getProcess()->getErrorOutput();
            }
            
            return $process->getOutput();
            
            }



}
