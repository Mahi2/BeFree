<?php
/**
 * befree application's routes
 */

use Befree\Application\Controllers\DashboardController;
use Befree\Application\Controllers\Tools\{
    ErrorMonitoringController,
    HashingController,
    HtaccessEditorController,
    HtmlEncrypterController,
    IpBlackListCheckerController,
    PasswordGeneratorController,
    PortScannerController
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
    $router->get('tools/html-encrypter', [HtmlEncrypterController::class], 'tools.htmlEncrypter');
    $router->post('tools/html-encrypter', [HtmlEncrypterController::class], 'tools.htmlEncrypter');
    $router->get('tools/password-generator', [PasswordGeneratorController::class], 'tools.passwordGenerator');
    $router->get('tools/hashing', [HashingController::class], 'tools.hashing');
    $router->post('tools/hashing', [HashingController::class], 'tools.hashing');
}
