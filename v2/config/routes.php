<?php
/**
 * befree application's routes
 */

use Befree\Application\Controllers\{
    DashboardController,
    Tools\ErrorMonitoringController,
    Tools\HtaccessEditorController,
    Tools\IpBlackListCheckerController,
    Tools\PortScannerController
};


$router->get('/', [DashboardController::class, 'index'], "dashboard.index");


//ANALYTICS
analytics_routes : {

}

// SECURITY
security_routes : {

}


// TOOLS
tools_routes : {
    $router->get('tools/port-scanner', [PortScannerController::class], 'tools.portScanner');
    $router->post('tools/port-scanner', [PortScannerController::class], 'tools.portScanner');
    $router->get('tools/htaccess-editor', [HtaccessEditorController::class], 'tools.htaccessEditor');
    $router->post('tools/htaccess-editor', [HtaccessEditorController::class], 'tools.htaccessEditor');
    $router->get('tools/error-monitoring', [ErrorMonitoringController::class], 'tools.errorMonitoring');
    $router->post('tools/error-monitoring', [ErrorMonitoringController::class], 'tools.errorMonitoring');
    $router->get('tools/ip-blacklist-checker', [IpBlackListCheckerController::class], 'tools.ipBlackListChecker');
    $router->post('tools/ip-blacklist-checker', [IpBlackListCheckerController::class], 'tools.ipBlackListChecker');
    $router->get('tools/html-encrypter', [], 'tools.htmlEncrypter');
    $router->post('tools/html-encrypter', [], 'tools.htmlEncrypter');
    $router->get('tools/password-generator', [], 'tools.passwordGenerator');
    $router->get('tools/hashing', [], 'tools.hashing');
    $router->post('tools/hashing', [], 'tools.hashing');
}
