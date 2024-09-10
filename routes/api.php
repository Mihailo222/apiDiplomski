<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//use Illuminate\Support\Facades\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use App\Http\Controllers\VirtualMachineController;
use App\Http\Controllers\DNSServerController;
use App\Http\Controllers\WebServerOneController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




/**************************************************************************************************/
//Route::post('/sysinfo',[VirtualMachineController::class,'SystemInfo2']);

//updating
Route::post('/update',[VirtualMachineController::class,'updateServers']);

// loggings 
Route::post('/loggedIn',[VirtualMachineController::class,'loggedInNow']);
Route::post('/loggedInRecently',[VirtualMachineController::class,'loggedInRecently']);

//memory and CPU utilization:
Route::post('/cpu_mem_usage',[VirtualMachineController::class,'CpuMemoryUsage']);

Route::post('/total_ram',[VirtualMachineController::class,'totalRAM']);
Route::post('/used_ram',[VirtualMachineController::class,'usedRAM']);
Route::post('/free_ram',[VirtualMachineController::class,'freeRAM']);
Route::post('/available_ram',[VirtualMachineController::class,'availableRAM']);
Route::post('/free_swap',[VirtualMachineController::class,'freeSWAP']);

Route::post('/memory_killers',[VirtualMachineController::class,'memoryKillers']);
Route::post('/cpu_killers',[VirtualMachineController::class,'cpuKillers']);

//system analysis: users, groups - shells;  file systems, kernel name, hostname, kernel release, kernel version, machine hardware name, ip addresses, 
//uname -r = kernel release; uname -v = kernel version;uname -s = kernel name; uname -n = hostname; machine hardware name = uname -m; 
Route::post('/kernel_release',[VirtualMachineController::class,'kernelRelease']);
Route::post('/kernel_version',[VirtualMachineController::class,'kernelVersion']);
Route::post('/kernel_name',[VirtualMachineController::class,'kernelName']);
Route::post('/hostname',[VirtualMachineController::class,'hostname']);
Route::post('/machine_hardware_name',[VirtualMachineController::class,'machineHardwareName']);

//MONITORING STORAGE
Route::post('/disk_usage_by_rootfs',[VirtualMachineController::class,'diskUsage']);

//????????????/ vidi za sta ti treba i vidi kako ces da integriras sa logovima; ovako uraditi health check i za dns i za mysql i druge servise
Route::post('/apache_health_check',[VirtualMachineController::class,'ApacheHealthCheck']);
Route::post('/bind9_health_check',[VirtualMachineController::class,'BindHealthCheck']);




// machines configuration
Route::post('/dnsUp',[DNSServerController::class,'DNSInit']);
Route::post('/updateDNS',[DNSServerController::class,'editDNS']);

Route::get('/getDNSIP',[DNSServerController::class,'getDNSIP']);
Route::get('/getWEBONEIP', [WebServerOneController::class, 'getWEBOneIP']);
Route::get('/getDBIP', [WebServerOneController::class,'getDataBaseIP']);




Route::post('/folder_mem_usage',[VirtualMachineController::class,'foldersMemUsage']);
 //echo "Usage: $0 ${db_username} ${db_passwd} ${new_user} ${new_db} ${new_user_ip} ${new_user_pass}"



//Database 
Route::post('/show_databases',[VirtualMachineController::class,'ShowDatabases']);
Route::post('/create_database',[VirtualMachineController::class,'CreateDatabase']); // radi samo kada su oba noda u clusteru pokrenuta
Route::post('/show_users',[VirtualMachineController::class,'ShowUsers']); 
Route::post('/create_db_user_association',[VirtualMachineController::class,'DBUserAssociation']);

//Web server
Route::post('/make_new_virtual_host',[VirtualMachineController::class,'MakeNewVirtualHost']);