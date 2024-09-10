<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;



//update celog dnsa i vebservera: konfiguracije, IP adrese, domeni, nameserveri - sve sem baze. sve skripte rade,ali u laravelu jos nije isprobano jer ne mogu da dognem 2 masine istovremeno i zato sto me zeza base_path
class DNSServerController extends Controller
{   
   public function DNSUp(Request $request){ //post method



    $scriptPath = base_path('scripts/bringDNSUp.sh'); 

    if (!file_exists($scriptPath)) {
        return "Script not found: " . $scriptPath;
    }

    $process = new Process(['bash', $scriptPath]);
    $process->setWorkingDirectory(base_path()); 

    try {
        $process->mustRun();
    } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
        return "Error: " . $e->getMessage() . "\nError Output: " . $e->getProcess()->getErrorOutput();
    }

    return $process->getOutput();
    }

    public function editDNS(Request $request){
        
        //uradi bolju validaciju na klijentu
    $validate = $request->validate([
            'dns_ipa' => 'required|string|max:255',
            'db_ipa' => 'required|string|max:255',
            'wp_ipa' => 'required|string|max:255',
            'fqdn1' => 'required|string|max:255',
            'fqdn2' => 'required|string|max:255',
            'ssh_user' => 'required|string|max:255',
            'ssh_password'=>'required|string|max:255'
        ]);

   $dns_ipa = $request->dns_ipa;
   $db_ipa = $request->db_ipa;
   $wp_ipa = $request->wp_ipa;
   $fqdn1 = $request->fqdn1;
   $fqdn2 = $request->fqdn2;
   $ssh_user = $request->ssh_user;
   $ssh_password = $request->ssh_password;



    $scriptPath = base_path('scripts/updateDNSServer.sh'); 
    $scriptPathWS = base_path('scripts/updateWSNameserver.sh');
    $scriptPathUpdateWS = base_path('scripts/updateWS.sh');

    if (!file_exists($scriptPath)) {
        return "Script not found: " . $scriptPath;
    }

    #edit dns configuration
    $process = new Process(['bash', $scriptPath, $dns_ipa, $db_ipa, $wp_ipa, $fqdn1, $fqdn2, $ssh_user, $ssh_password]);
    $process->setWorkingDirectory(base_path()); 
    #edit dns server ip for web server
    $processWSNS = new Process(['bash', $scriptPath, $dns_ipa, $ssh_password, $ssh_user, $wp_ipa, $scriptPathWS]);
    $processWSNS->setWorkingDirectory(base_path()); //NIJE DOBAR BASE PATH 
    #edit dns server ip for db
    #FALI
    #edit ws configuration
    $processWS = new Process(['bash', $scriptPathUpdateWS, $wp_ipa, $ssh_password, $ssh_user, $fqdn1, $fqdn2]);
    $processWS->setWorkingDirectory(base_path()); //NIJE DOBAR BASE PATH

    try {
        $process->mustRun();
        $processWSNS->mustRun();
    } catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
        return "Error: " . $e->getMessage() . "\nError Output: " . $e->getProcess()->getErrorOutput();
    }

    return $process->getOutput();
    }


    public function DNSInit(Request $request){

              
        //uradi bolju validaciju na klijentu
    $validate = $request->validate([
        'dns_ipa' => 'required|string|max:255',
        'wp_ipa' => 'required|string|max:255',
        'fqdn1' => 'required|string|max:255',
        'fqdn2' => 'required|string|max:255',
        'ssh_user' => 'required|string|max:255',
        'ssh_password'=>'required|string|max:255'
    ]);

$dns_ipa = $request->dns_ipa;
$wp_ipa = $request->wp_ipa;
$fqdn1 = $request->fqdn1;
$fqdn2 = $request->fqdn2;
$ssh_user = $request->ssh_user;
$ssh_password = $request->ssh_password;



$scriptPath = base_path('scripts/bringDNSServerUp.sh');
$process = new Process(['bash', $scriptPath, $dns_ipa, $wp_ipa, $fqdn1, $fqdn2, $ssh_user, $ssh_password]);
$process->setWorkingDirectory(base_path()); 

try {
    $process->mustRun();

} catch (\Symfony\Component\Process\Exception\ProcessFailedException $e) {
    return "Error: " . $e->getMessage() . "\nError Output: " . $e->getProcess()->getErrorOutput();
}

return $process->getOutput();

 }





public function getDNSIP(Request $request){

$scriptPath = base_path('scripts/getDNSIP.sh');
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