<?php
/**
 * befree application's routes
 */

use Befree\Application\Controllers\{
    DashboardController,
    Tools\PortScannerController
};


$router->get('/', [DashboardController::class, 'index'], "dashboard.index");


//ANALYTICS


// SECURITY



// TOOLS
$router->get('/port-scanner', [PortScannerController::class, 'index'], 'portScanner');
$router->post('/port-scanner', [PortScannerController::class, 'index'], 'portScanner');