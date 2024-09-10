<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


class VirtualMachineController extends Controller
{
    public function SystemInfo2(Request $request)
{
    
    $validate = $request->validate([
        'hostname' => 'required|string|max:255',
        'ip_address' => 'required|string|max:255',
        'password' => 'required|string|max:255',
    ]);

    
    $hostname = $request->hostname;
    $ip_address = $request->ip_address;
    $password = $request->password;

    
    $scriptPath = base_path('scripts/infoScriptWhoAmI.sh'); 

    
    if (!file_exists($scriptPath)) {
        return response()->json(['error' => "Script not found: " . $scriptPath], 404);
    }

    
    $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
    $process->setWorkingDirectory(base_path());

   
    try {
        $process->mustRun();
    } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
        return response()->json([
            'error' => "Error: " . $e->getMessage(),
            'error_output' => $e->getProcess()->getErrorOutput()
        ], 500);
    }

    
    return response()->json([
        'output' => $process->getOutput()
    ]);
}





/*
    public function VMUp(Request $request){ //post method

        //uradi bolju validaciju na klijentu
    $validate = $request->validate([
            'ip_address' => 'required|string|max:255',
            'hostname' => 'required|string|max:255',
        ]);

    //iz requesta se vade ip adresa i hostname
    $ip_address = $request->ip_address;  //192.168.56.13
    $hostname = $request->hostname; //host1

    $scriptPath = base_path('scripts/bringVMUp.sh'); 

    if (!file_exists($scriptPath)) {
        return "Script not found: " . $scriptPath;
    }

    $process = new Process(['wsl','bash', $scriptPath, $ip_address, $hostname]);
    $process->setWorkingDirectory(base_path()); 

    try {
        $process->mustRun();
    } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
        return "Error: " . $e->getMessage() . "\nError Output: " . $e->getProcess()->getErrorOutput();
    }

    return $process->getOutput();
    }*/


    public function updateServers(Request $request)
    {
        
        $validate = $request->validate([
            
            'ip_address' => 'required|string|max:255',
           
        ]);
    
      
        $ip_address = $request->ip_address;
       
    
       
        $scriptPath = base_path('scripts/updateDataCenter.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $ip_address]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }


    public function loggedInNow(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/loggedInNow.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }

    public function loggedInRecently(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/loggedInRecently.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }



    public function CpuMemoryUsage(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/cpu_memory_usage.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }
    public function BindHealthCheck(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/bind9_health_check.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }


    public function ApacheHealthCheck(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/apache_health_check.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }


    public function totalRAM(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/total_ram.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }


    public function usedRAM(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/used_ram.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }


    public function freeRAM(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/free_ram.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }

    public function availableRAM(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/available_ram.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }

    public function freeSWAP(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/free_swap.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }


    public function memoryKillers(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/memory_killers.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }

    public function cpuKillers(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/cpu_killers.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }


    public function kernelRelease(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/kernel_release.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }

    public function kernelVersion(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/kernel_version.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }


    public function kernelName(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/kernel_name.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }



    public function machineHardwareName(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/machine_hardware_name.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }

    public function hostname(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/hostname.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }




    
    public function diskUsage(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
       
        $scriptPath = base_path('scripts/disk_usage_root.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $ip_address, $password]);
        $process->setWorkingDirectory(base_path());
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }


    public function foldersMemUsage(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'folder_path' => 'required|string|max:255'
        ]);
    
        
        $hostname = $request->hostname;
        $ip_address = $request->ip_address;
        $password = $request->password;
        $folder_path = $request->folder_path;
       
        $scriptPath = base_path('scripts/remote_folder_mem_usage.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $ip_address, $hostname,$password,$folder_path]);
        $process->setWorkingDirectory(base_path());
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }


    public function ShowDatabases(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'db_ipa' => 'required|string|max:255',
            'password' => 'required|string|max:255',
             'db_user' => 'required|string|max:255',
             'db_passwd' => 'required|string|max:255',

        ]);
    
        
        $hostname = $request->hostname;
        $db_ipa = $request->db_ipa;
        $password = $request->password;
        $db_user = $request->db_user;
        $db_passwd = $request->db_passwd;
       
        $scriptPath = base_path('scripts/remote_showdb.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $password, $db_user,$db_passwd,$db_ipa]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }



    public function CreateDatabase(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'db_ipa' => 'required|string|max:255',
            'password' => 'required|string|max:255',
             'db_user' => 'required|string|max:255',
             'db_passwd' => 'required|string|max:255',
             'db_name' => 'required|string|max:255'

        ]);
    
        
        $hostname = $request->hostname;
        $db_ipa = $request->db_ipa;
        $password = $request->password;
        $db_user = $request->db_user;
        $db_passwd = $request->db_passwd;
        $db_name = $request->db_name;
       
        $scriptPath = base_path('scripts/remote_insertdb.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $password, $db_user,$db_passwd,$db_ipa, $db_name]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }

    public function ShowUsers(Request $request)
    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'db_ipa' => 'required|string|max:255',
            'password' => 'required|string|max:255',
             'db_user' => 'required|string|max:255',
             'db_passwd' => 'required|string|max:255',

        ]);
    
        
        $hostname = $request->hostname;
        $db_ipa = $request->db_ipa;
        $password = $request->password;
        $db_user = $request->db_user;
        $db_passwd = $request->db_passwd;
       
        $scriptPath = base_path('scripts/remote_showusers.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $password, $db_user,$db_passwd,$db_ipa]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }






    public function DBUserAssociation(Request $request)

    {
        
        $validate = $request->validate([
            'hostname' => 'required|string|max:255',
            'db_ipa' => 'required|string|max:255',
            'password' => 'required|string|max:255',
             'db_user' => 'required|string|max:255',
             'db_passwd' => 'required|string|max:255',
             'new_user' => 'required|string|max:255',
             'new_db' => 'required|string|max:255',
             'new_user_pass' => 'required|string|max:255',
             'new_user_ip' => 'required|string|max:255',
    
    
    
        ]);
        $hostname = $request->hostname;
        $db_ipa = $request->db_ipa;
        $password = $request->password;
        $db_user = $request->db_user;
        $db_passwd = $request->db_passwd;
        $new_user = $request->new_user;
        $new_db = $request->new_db;
        $new_user_pass = $request->new_user_pass;
        $new_user_ip = $request->new_user_ip;
       
        $scriptPath = base_path('scripts/remote_user_db_association.sh'); 
    
        
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $hostname, $password, $db_user,$db_passwd,$db_ipa, $new_user, $new_db,$new_user_ip,$new_user_pass]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }

    public function MakeNewVirtualHost(Request $request)
    {
        
        $validate = $request->validate([
        'wp_folder_name' => 'required|string|max:255',
        'db_name' => 'required|string|max:255',
        'db_user' => 'required|string|max:255',
        'db_password' => 'required|string|max:255',
        'db_host' => 'required|string|max:255',
        'ssh_user' => 'required|string|max:255',
        'ssh_pass' => 'required|string|max:255',
        'ip_address' => 'required|string|max:255',
        'domain' => 'required|string|max:255',


        ]);
        $wp_folder_name = $request->wp_folder_name;
        $db_name = $request->db_name;
        $db_user = $request->db_user;
        $db_password = $request->db_password;
        $db_host = $request->db_host;
        $ssh_user = $request->ssh_user;
        $ssh_pass = $request->ssh_pass;
        $ip_address = $request->ip_address;
        $domain = $request->domain;
       
        $scriptPath = base_path('scripts/wp/main_script.sh'); 
        if (!file_exists($scriptPath)) {
            return response()->json(['error' => "Script not found: " . $scriptPath], 404);
        }
    
       
        $process = new Process(['bash', $scriptPath, $wp_folder_name, $db_name, $db_user, $db_password,
    $db_host, $ssh_user,$ssh_pass, $ip_address, $domain]);
        $process->setWorkingDirectory(base_path()); //!!!
    
       
        try {
            $process->mustRun();
        } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
            return response()->json([
                'error' => "Error: " . $e->getMessage(),
                'error_output' => $e->getProcess()->getErrorOutput()
            ], 500);
        }
    
        
        return response()->json([
            'output' => $process->getOutput()
        ]);
    }

























    








}

