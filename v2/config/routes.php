<?php
/**
 * befree application's routes
 */

use Befree\Application\Controllers\DashboardController;
use Befree\Application\Controllers\Analytics\LiveTrafficController;
use Befree\Application\Controllers\Analytics\VisitAnalyticsController;
use Befree\Application\Controllers\Security\AdBlockerDetectionController;
use Befree\Application\Controllers\Security\BadBotController;
use Befree\Application\Controllers\Security\MassRequestController;
use Befree\Application\Controllers\Security\ProxyController;
use Befree\Application\Controllers\Security\SpamController;
use Befree\Application\Controllers\Security\SqlInjectionController;
use Befree\Application\Controllers\Security\TorDetectionController;
use Befree\Application\Controllers\Tools\ErrorMonitoringController;
use Befree\Application\Controllers\Tools\HashingController;
use Befree\Application\Controllers\Tools\HtaccessEditorController;
use Befree\Application\Controllers\Tools\HtmlEncrypterController;
use Befree\Application\Controllers\Tools\IpBlackListCheckerController;
use Befree\Application\Controllers\Tools\PasswordGeneratorController;
use Befree\Application\Controllers\Tools\PortScannerController;

$router->get('/', [DashboardController::class, 'index'], "dashboard.index");


//ANALYTICS
analytics_routes : {
    $router->get('analytics/live-traffic', [LiveTrafficController::class], 'analytics.live-traffic');
    $router->get('analytics/visits', [VisitAnalyticsController::class], 'analytics.visits');
}

// SECURITY
security_routes : {
    $router->get('security/adblocker-detection', [AdBlockerDetectionController::class], 'security.adbBlockDetection');
    $router->post('security/adblocker-detection', [AdBlockerDetectionController::class], 'security.adbBlockDetection');
    $router->get('security/badbot', [BadBotController::class], 'security.badBot');
    $router->post('security/badbot', [BadBotController::class], 'security.badBot');
    $router->get('security/mass-request', [MassRequestController::class], 'security.massRequest');
    $router->post('security/mass-request', [MassRequestController::class], 'security.massRequest');
    $router->get('security/proxy', [ProxyController::class], 'security.proxy');
    $router->post('security/proxy', [ProxyController::class], 'security.proxy');
    $router->get('security/spam', [SpamController::class], 'security.spam');
    $router->post('security/spam', [SpamController::class], 'security.spam');
    $router->get('security/sql-injection', [SqlInjectionController::class], 'security.sqlInjection');
    $router->post('security/sql-injection', [SqlInjectionController::class], 'security.sqlInjection');
    $router->get('security/TorDetection', [TorDetectionController::class], 'security.tor-detection');
    $router->post('security/TorDetection', [TorDetectionController::class], 'security.tor-detection');
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
