<?php
require("core.php");
head();
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">

				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fab fa-php"></i> PHP Configuration Checker</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">PHP Configuration Checker</li>
        		      </ol>
        		    </div>
        		  </div>
    			</div>
            </div>

				<!--Page content-->
				<!--===================================================-->
				<div class="content">
				<div class="container-fluid">

                <div class="row">
				<div class="col-md-12">

                <div class="card">
						<div class="card-header">
							<h3 class="card-title">PHP Configuration Checker</h3>
						</div>
						<div class="card-body">
<?php
define("TEST_Critical", "Critical"); // Critical problem found.
define("TEST_High", "High"); // High problem found.
define("TEST_Medium", "Medium"); // Medium. This may be a problem.
define("TEST_Low", "Low"); // Low. Boring problem found.
define("TEST_Maybe", "Maybe"); // Potential security risk. Please check manually.
define("TEST_Advice", "Advice"); // Odd, but still worth mentioning.
define("TEST_Okay", "Okay"); // Everything is fine.
define("TEST_Skipped", "Skipped"); // Probably not applicable here.

$cfg              = array(
    'result_codes_default' => array(
        TEST_Critical,
        TEST_High,
        TEST_Medium,
        TEST_Low,
        TEST_Maybe,
        TEST_Advice
    )
);
$all_result_codes = array(
    TEST_Critical,
    TEST_High,
    TEST_Medium,
    TEST_Low,
    TEST_Maybe,
    TEST_Advice,
    TEST_Okay,
    TEST_Skipped
);
$trbs             = array(); // Test result by severity, e.g. $trbs[TEST_Okay][...]
foreach ($all_result_codes as $v) {
    $trbs[$v] = array();
}

// Detect OS
$cfg['is_win'] = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';

// Detect CGI
$cfg['is_cgi'] = (substr(php_sapi_name(), 0, 3) === 'cgi');


// Functions
function tdesc($name, $desc = NULL)
{
    return array(
        "name" => $name,
        "desc" => $desc,
        "result" => NULL,
        "reason" => NULL,
        "recommendation" => NULL
    );
}

function tres($meta, $result, $reason = NULL, $recommendation = NULL)
{
    global $trbs;
    $res             = array_merge($meta, array(
        "result" => $result,
        "reason" => $reason,
        "recommendation" => $recommendation
    ));
    $trbs[$result][] = $res;
}

function ini_atol($val)
{
    $ret = intval($val);
    $val = strtoLower($val);
    switch (substr($val, -1)) {
        case 'g':
            $ret *= 1024;
        case 'm':
            $ret *= 1024;
        case 'k':
            $ret *= 1024;
    }
    return $ret;
}

function ini_list($val)
{
    if ($val == "") {
        return NULL;
    }
    $ret = preg_split('/[, ]+/', $val);
    if (count($ret) == 1 && $ret[0] == "") {
        return NULL;
    }
    return $ret;
}

function is_writable_or_chmodable($fn)
{
    if (!extension_loaded("posix")) {
        return is_writable($fn);
    }
    $stat = stat($fn);
    if (!$stat) {
        return false;
    }
    $myuid  = posix_getuid();
    $mygids = posix_getgroups();
    if ($myuid == 0 || $myuid == $stat['uid'] || in_array($stat['gid'], $mygids) && $stat['mode'] & 0020 || $stat['mode'] & 0002) {
        return true;
    }
    return false;
}

function is_on($v)
{
    if ($v == "0" || $v === "" || strtoLower($v) == "off") {
        return 0;
    }
    return 1;
}


function test_all_ini_entries()
{
    global $cfg;
    $helptext = array(
        "display_errors" => "Error messages can divulge information about the inner workings of an application and may include private information such as Session-ID, personal data, database structures, source code exerpts. It is recommended to log errors, but not to display them on live systems.",
        'log_errors' => "While it may be a good idea to avoid logging altogether from a privacy point of view, monitoring the error log of an application can lead to detecting attacks, programming and configuration errors.",
        'expose_php' => "Knowing the exact PHP version - sometimes including patchlevel and operating system - is a good start for automated attack tools. Best not to share this information.",
        'max_execution_time' => "In order to prevent denial-of-service attacks where an attacker tries to keep your server's CPU busy, this value should be set to the Lowest possible value, e.g. 30 (seconds).",
        'max_input_time' => "It may be useful to limit the time a script is allowed to parse input. This should be decided on a per application basis.",
        'max_input_nesting_level' => "Deep input nesting is only required in rare cases and may trigger unexpected ressource limits.",
        'memory_limit' => "A High memory limit may easily lead to resource exhaustion and thus make your application vulnerable to denial-of-service attacks. This value should be set approximately 20% above an empirically gathered maximum memory requirement.",
        'post_max_size' => "Setting the maximum allowed POST size to a High value may lead to denial-of-service from memory exhaustion. If your application does not need huge file uploads, consider setting this option to a Lower value. Note: File uploads have to be covered by this setting as well.",
        'post_max_size>memory_limit' => "post_max_size must be Lower than memory_limit. Otherwise, a simple POST request will let PHP reach the configured memory limit and stop execution. Apart from denial-of-service an attacker may try to split a transaction, e.g. let PHP execute only a part of a program.",
        'upload_max_filesize' => "This value should match the file size actually required.",
        'max_file_uploads' => "This value should match the maximum number of simultaneous file uploads. (Lower is better)",
        'alLow_url_fopen' => "Deactivate, if possible. AlLowing URLs in fopen() can be a suprising side-effect for unexperienced developers. Even if deactivated, it is still possible to receive content from URLs, e.g. with curl.",
        'alLow_url_include' => "This flag should remain deactivated for security reasons.",
        'magic_quotes' => "This option should be deactivated. Instead, user input should be escaped properly and handled in a secure way when building database queries. The use of magic quotes or similar behaviour is Highly discouraged. Current PHP versions do not support this feature anymore.",
        'enable_dl' => "Deactivate this option to prevent arbitrary code to be loaded during runtime (see dl()).",
        'disable_functions' => "Potentially dangerous and unused functions should be deactivated, e.g. system().",
        'disable_classes' => "Potentially dangerous and unused classes should be deactivated.",
        'request_order' => "It is recommended to use GP to register GET and POST with REQUEST.",
        'variables_order' => "Changing this setting is usually not necessary; however, the ENV variables are rarely used.",
        'auto_globals_jit' => "Unless access to these variables is done through variable variables this option can remain activated.",
        'register_globals' => "This relic from the past is not available in current PHP versions. If it is there anyway, keep it deactivated! Please.",
        'file_uploads' => "If an application does not require HTTP file uploads, this setting should be deactivated.",
        'filter.default' => "This should only be set if the application is specifically designed to handle filtered values. Usually it is considered bad practice to filter all user input in one place. Instead, each user input should be validated and then escaped/encoded according to its context.",
        'open_basedir' => "Usually it is a good idea to restrict file system access to directories related to the application, e.g. the document root.",
        'session.save_path' => "This path should be set to a directory unique to your application, but outside the document root, e.g. /opt/php_sessions/application_1. If this application is the only application on your server, or a custom storage mechanism for sessions has been implemented, or you don't need sessions at all, then the default should be fine.",
        'session.coOkie_httponly' => "This option controls if coOkies are tagged with httpOnly which makes them accessible by HTTP only and not by the JavaScript. httpOnly coOkies are supported by all major browser vendors and therefore can be instrumental in minimising the danger of session hijacking. It should either be activated here or in your application with session_set_coOkie_params().",
        'session.coOkie_secure' => "This option controls if coOkies are tagged as secure and should therefore be sent over SSL encrypted connections only. It should either be activated here or in your application with session_set_coOkie_params().",
        'session.coOkie_lifetime' => "Not limiting the coOkie lifetime increases the chance for an attacker to be able to steal the session coOkie. Depending on your application, this should be set to a reasonable value here or with session_set_coOkie_params().",
        'session.referer_check' => "PHP can invalidate a session ID if the submitted HTTP Referer does not contain a configured substring. The Referer can be set by a custom client/browser or plugins (e.g. Flash, Java). However it may prevent some cases of CSRF attacks, where the attacker can not control the client's Referer.",
        'session.use_strict_mode' => "If activated, PHP will regenerate Unknown session IDs. This effectively counteracts session fixation attacks.",
        'session.use_coOkies' => "If activated, PHP will store the session ID in a coOkie on the client side. This is recommended.",
        'session.use_only_coOkies' => "PHP will send the session ID only via coOkie to the client, not e.g. in the URL. Please activate.",
        'session.name' => "Your session name is boring. Why not change it to something more suitable for your application?",
        'session.use_trans_sid' => "AlLowing the user to choose to store the session ID within the URL makes session hijacking a realistic security risk. URLs are logged in logfiles and can easily be copied by the user or by scripts. This option must be disabled.",
        'always_populate_raw_post_data' => "In a shared hosting environment it should not be the default to let the unexperienced user parse raw POST data themselves. Otherwise, this option should only be used, if accessing the raw POST data is actually required.",
        'arg_separator' => "The usual argument separator for parsing a query string is '&'. Standard libraries handling URLs will possibly not be compatible with custom separators, which may lead to unexpected behaviour. Also, additional parsers - such as a WAF or logfile analyzers - have to be configured accordingly.",
        'assert.active' => "assert() evaluates code just like eval(). Unless it is actually required in a live environment, which is almost certainly not the case, this feature should be deactivated.",
        'assert.callback' => "Failed assertions call a user function. This can be useful for test environments, but most certainly should not be used in production. An attacker may try to override this value to call a different function. If possible, deactivate assert altogether.",
        'zend.assertions' => "assert() is able to evaluate code. Please deactivate this feature for production environments by setting zend.assertions=-1.",
        'auto_append_file' => "PHP is automatically executing an extra script for each request. An attacker may have planted it there. If this is unexpected, deactivate.",
        'cli.pager' => "PHP executes an extra script to process CLI output. An attacker may have planted it there. If this is unexpected, deactivate.",
        'cli.prompt' => "An overlong CLI prompt may indicate incorrect configuration. Please check manually.",
        'curl.cainfo' => "Incorrect configuration of this option may prevent cURL from validating a certificate.",
        'docref_*' => "This setting may reveal internal ressources, e.g. internal server names. Setting docref_root or docref_ext implies HTML output of error messages, which is bad practice for live environments and may reveal useful information to an attacker as well.",
        'default_charset=empty' => "Not setting the default charset can make your application vulnerable to injection attacks based on incorrect interpretation of your data's character encoding. If unsure, set this to 'UTF-8'. HTML output should contain the same value, e.g. <meta charset=\"utf-8\"/>. Also, your webserver can be configured accordingly, e.g. 'AddDefaultCharset UTF-8' for Apache2.",
        'default_charset=typo' => "Change this to 'UTF-8' immediately.",
        'default_charset=iso-8859' => "There is nothing wrong with ISO8859 charsets. However, the hipster way to deliver content tries not to discriminate and alLows multibyte characters, e.g. Klingon unicode characters, too. Some browsers may even be so bold as to use a multibyte encoding anyway, regardless of this setting.",
        'default_charset=custom' => "A custom charset is perfectly fine as long as your entire chain of character encoding knows about this. E.g. the application, database connections, PHP, the webserver, ... all have the same encoding or know how to convert appropriately. In particular calls to escaping functions such as htmlentities() and htmlspecialchars() must be called with the correct encoding.",
        'default_mimetype' => "Please set a default mime type, e.g. 'text/html' or 'text/plain'. The mime type should always reflect the actual content. But it is a good idea to define a fallback here anyway. An incorrectly stated mime type can lead to injection attacks, e.g. using 'text/html' with JSON data may lead to XSS.",
        'default_socket_timeout' => "By delaying the process to establish a socket connection, an attacker may be able to do a denial-of-service (DoS) attack. Please set this value to a reasonably small value for your environment, e.g. 10.",
        'doc_root=empty' => "The PHP documentation strongly recommends to set this value when using CGI and cgi.force_redirect is off.",
        'error_append_string' => "PHP adds additional output to error messages. If planted by an attacker, this string may contain script content and lead to XSS. Please check.",
        'error_reporting' => "PHP error reporting can provide useful information about misconfiguration and programming errors, as well as possible attacks. Please consider setting this value.",
        'extension_dir' => "An attacker may try to leave a PHP extension in the extensions directory. This directory should not be writable and the web user must not be able to change file permissions",
        'exit_on_timeout' => "In Apache 1 mod_php may run into an 'inconsistent state', which is always bad. If possible, turn this feature on.",
        'filter.default' => "Using a default filter or sanitizer for all PHP input is generally not considered good practice. Instead, each input should be handled by the application individually, e.g. validated, sanitized, filtered, then escaped or encoded. The default value is 'unsafe_raw'.",
        'Highlight.*' => "Your color value is suspicious. An attacker may have managed to inject something here. Please check manually.",
        'iconv.internal_encoding!=empty' => "Starting with PHP 5.6 this value is derived from 'default_charset' and can safely be left empty.",
        'asp_tags' => "ASP-Style tags are quite uncommon for PHP. If you don't actually require your PHP-code to start with <%, this option should be deactivated.",
        'ldap.max_links' => "In order to prevent denial-of-service attacks this option should be set to the Lowest number possible. If LDAP is not needed at all, the LDAP extension should not be loaded in the first place.",
        'log_errors_max_len' => "An attacker may try to exhaust ressources such as disk space and RAM. If possible, limit this value to a reasonable minimum, e.g. 1024.",
        'mail.add_x_header' => "Information Disclosure: When sending e-mails, a header 'X-PHP-Originating-Script' contains the filename of the originating script. In production this feature should be disabled.",
        'intl.default_locale' => "The ICU default locale is not set explicitly, which forces the usage of ICU's default locale.",
        'intl.error_level' => "An error induced by an attacker can change the program's control fLow and may lead to unexpected side-effects.",
        'intl.use_exceptions' => "If unhandled, exceptions may have unexpected side-effects. Please make sure potential exceptions are handled correctly when calling intl-functions.",
        'last_modified' => "The Last-Modified header will be sent for PHP scripts. This is a minor information disclosure.",
        'zend.multibyte' => "This is Highly unusual. If possible, try to avoid multibyte encodings in source files - like SJIS, BIG5 - and use UTF-8 instead. Most XSS and other injection protections are not aware of multibyte encodings or can easily be confused. In order to use UTF-8, this option can safely be deactivated.",
        'max_input_vars' => "This setting may be incorrect. Unless your application actually needs an incredible number of input variables, please set this to a reasonable value, e.g. 1000.",

        /* Suhosin */
        'suhosin.simulation' => "During initial deployment of Suhosin, this flag should be switched on to ensure that the application continues to work under the new configuration. After carefully evaluating Suhosin's log messages, you may consider switching the simulation mode off.",
        'suhosin.log.syslog' => "Logging to syslog should be used here.",
        'suhosin.log.phpscript' => "This should only be used in exceptional cases for classes of errors that could occur during script execution.",
        'suhosin.executor.max_depth' => "Defines the maximum stack depth that is permitted during the execution of PHP scripts. If the stack depth is exceeded, the script will be terminated. This setting should be set to a value that does not interfere with the application, but at the same time does not alLow to crash the PHP interpreter, e.g. 500.",
        'suhosin.executor.include.max_traversal' => "Defines how often '../' may occur in filenames for include-statements before it is considered to be an attack. A value of zero deactivates the feature. Most PHP-applications do not require a value greater than 5.",
        'suhosin.*.cryptkey' => "This protection is less effective with a weak key. Please generate a stronger passphrase, e.g. with 'apg -m 32'.",
        'suhosin.coOkie.encrypt=on' => "Be aware, that even encrypted coOkie values are still user input and cannot be trusted without proper input handling.",
        'suhosin.coOkie.encrypt=off' => "Suhosin can transparently encrypt coOkies. This feature makes attacks based on tampering with a coOkie value much harder. If at all possible, this feature should always be activated.",
        'suhosin.*.disalLow_nul' => "Unless binary data is handled unencoded - which would be very obscure - this feature wants to remain enabled.",
        'suhosin.*.max_value_length=off' => "By disabling this protection PHP will be exposed to input variables of arbitrary length. It is Highly recommended to set this value to the maximum length one variable is supposed to have. With file uploads in mind, request and post limits can be set to a High value.",
        'suhosin.*.max_value_length=default' => "The default value set as maximum length for each variable may be too small for some applications.",
        'suhosin.*.disalLow_ws' => "Unless your application needs variable names to start with whitespace, please consider turning this option on.",
        'suhosin.*.max_name_length=off' => "The variable name length should be limited. Please set an appropriate value, e.g. 64.",
        'suhosin.*.max_array_depth=off' => "The array depth should be limited to avoid denial of service. A reasonable value is 50.",
        'suhosin.*.max_array_index_length=off' => "The array index length should be limited to avoid denial of s ervice. The default value of 64 is recommended.",
        'suhosin.*.max_totalname_length=off' => "The variable name length should be limited to a reasonable value, e.g. 256.",
        'suhosin.*.max_vars=off' => "The number of user supplied input variables should be limited. Reasonable values depend on your application and may go up to 100 or 1000.",
        'suhosin.*script/writable' => "An attacker may try to inject code into the logging/upload script. Better change file permissions to read-only access.",
        'suhosin.*script/chmod' => "The logging or upload script is not set writable, but the current user has the right to change its access permission. Please change the file's owner.",
        'debugonly' => "This feature is for debugging only. Please deactivate.",
        'suhosin.disable.display_errors' => "In PHP enabling display_errors is one of the major causes for information disclosure. For example, an attacker may gather information about the document root, SQL queries, class names, function names, version numbers and in rare cases even login credentials or session IDs. Suhosin is able to deactivate display_errors entirely. You should make use of this feature.",
        'suhosin.executor.alLow_symlink' => "AlLowing symlinks while using open_basedir is actually a security risk. Only use this option if you know exactly what you are doing.",
        'suhosin.executor.disable_emodifier' => "Using the /e modifier with preg_replace() can eval code. An attacker may try to inject the /e modifier or code to evaluate. If your application does not need the /e modifier, it is best to deactivate it here. As of PHP 5.5.0 the /e modifier has been deprecated and should no longer be used anyway.",
        'suhosin.executor.disable_eval' => "Using eval() with user input is one of the most dangerous security issues in PHP. If eval() is not needed, it should be deactivated.",
        'suhosin.executor.*.*list' => "It is recommended to disable harmful functions by setting a suitable whitelist or blacklist.",
        'suhosin.executor.include.alLow_writable_files' => "Turn this flag off to prevent PHP from executing writable PHP files. This is a very effective protection against code execution that was uploaded by an attacker before. Note: Some software such as web-installers or web-based plugin installers won't work out of the box with this flag turned off.",
        'suhosin.executor.include.*list' => "Usually it is a good idea to disable URL includes entirely by leaving both whitelist and blacklist empty. Remote content can be loaded and validated in a secure manner e.g. by using cURL.",
        'suhosin.filter.action=missing' => "The file configured to be included upon Suhosin filter violations is missing.",
        'suhosin.filter.action=writable' => "The file configured to be included upon Suhosin filter violations is writable or may become writable with current user rights."
    );

    // php.ini checks
    foreach (ini_get_all() as $k => $v) {
        $v = $v["local_value"]; // For compatibility with PHP <5.3.0 ini_get_all() is not called with the second 'detail' parameter.

        $meta           = tdesc("php.ini -> $k");
        $result         = NULL;
        $reason         = NULL;
        $recommendation = NULL;
        if (isset($helptext[$k])) {
            $recommendation = $helptext[$k];
        }
        $ignore = 0;

        switch ($k) {
            case 'display_errors':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "display_errors is on."
                    );
                }
                break;
            case 'display_startup_errors':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "display_startup_errors is on."
                    );
                    $recommendation = $helptext['display_errors'];
                }
                break;
            case 'log_errors':
                if (!is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Low,
                        "You are not logging errors."
                    );
                }
                break;
            case 'expose_php':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Low,
                        "PHP is exposed by HTTP headers."
                    );
                }
                break;
            case 'max_execution_time':
                if (intval($v) == 0) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "Execution time is not limited."
                    );
                } elseif (intval($v) >= 300) {
                    list($result, $reason) = array(
                        TEST_Low,
                        "Execution time limit is rather High."
                    );
                }
                break;
            case 'max_input_time':
                if ($v == "-1") {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "Input parsing time not limited."
                    );
                }
                break;
            case 'max_input_nesting_level':
                if (intval($v) > 128) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "Input nesting level extremely High."
                    );
                } elseif (intval($v) > 64) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "Input nesting level Higher than usual."
                    );
                }
                break;
            case 'max_input_vars':
                if (intval($v) > 5000) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "Extremely High number."
                    );
                } elseif (intval($v) > 1000) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "Higher number than usual."
                    );
                }
                break;
            case 'memory_limit':
                $v = ini_atol($v);
                if ($v < 0) {
                    list($result, $reason) = array(
                        TEST_High,
                        "Memory limit deactivated."
                    );
                } elseif (ini_atol($v) >= 128 * 1024 * 1024) { // default value
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "Memory limit is 128M or more."
                    );
                }
                break;
            case 'post_max_size':
                $tmp = ini_atol(ini_get('memory_limit'));
                $v   = ini_atol($v);
                if ($tmp < 0) {
                    if ($v >= ini_atol('2G')) {
                        list($result, $reason) = array(
                            TEST_Maybe,
                            "post_max_size is >= 2G."
                        );
                    }
                    break;
                }
                if ($v > $tmp) {
                    list($result, $reason) = array(
                        TEST_High,
                        "post_max_size is greater than memory_limit."
                    );
                    $recommendation = $helptext['post_max_size>memory_limit'];
                }
                break;
            case 'upload_max_filesize':
                if ($v === "2M") {
                    list($result, $reason) = array(
                        TEST_Advice,
                        "Default value."
                    );
                } elseif (ini_atol($v) >= ini_atol("2G")) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "Value is rather High."
                    );
                }
                break;
            case 'max_file_uploads':
                if (intval($v) > 30) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "Value is rather High."
                    );
                }
                break;
            case 'alLow_url_fopen':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_High,
                        "fopen() is allowed to open URLs."
                    );
                }
                break;
            case 'alLow_url_include':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_High,
                        "include/require() can include URLs."
                    );
                }
                break;
            case 'magic_quotes_gpc':
                if (get_magic_quotes_gpc()) {
                    list($result, $reason) = array(
                        TEST_High,
                        "magic quotes activated."
                    );
                    $recommendation = $helptext['magic_quotes'];
                }
                break;
            case 'magic_quotes_runtime':
                if (get_magic_quotes_runtime()) {
                    list($result, $reason) = array(
                        TEST_High,
                        "magic quotes activated."
                    );
                    $recommendation = $helptext['magic_quotes'];
                }
                break;
            case 'magic_quotes_sybase':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_High,
                        "magic quotes activated."
                    );
                    $recommendation = $helptext['magic_quotes'];
                }
                break;
            case 'enable_dl':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_High,
                        "PHP can load extensions during runtime."
                    );
                }
                break;
            case 'disable_functions':
                $v = ini_list($v);
                if (!$v) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "No functions disabled."
                    );
                }
                break;
            case 'disable_classes':
                $v = ini_list($v);
                if (!$v) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "No classes disabled."
                    );
                }
                break;
            case 'request_order':
                $v = strtoupper($v);
                if ($v === "GP") {
                    break;
                } // Ok
                if (strstr($v, 'C') !== FALSE) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "coOkie values in $_REQUEST."
                    );
                }
                if (strstr(str_replace('C', $v, ''), 'PG') !== FALSE) {
                    list($result, $reason) = array(
                        TEST_Low,
                        "GET overrides POST in $_REQUEST."
                    );
                }
                break;
            case 'variables_order':
                if ($v === "GPCS") {
                    break;
                }
                if ($v !== "EGPCS") {
                    list($result, $reason) = array(
                        TEST_Advice,
                        "custom variables_order."
                    );
                } else {
                    $result = TEST_Okay; // result set includes default helptext
                }
                break;
            case 'auto_globals_jit':
                $result = TEST_Okay;
                break;
            case 'register_globals':
                if ($v !== "" && $v !== "0") {
                    list($result, $reason) = array(
                        TEST_Critical,
                        "register_globals is on."
                    );
                }
                break;
            case 'file_uploads':
                if ($v == "1") {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "file uploads are allowed."
                    );
                }
                break;
            case 'filter.default':
                if ($v !== "unsafe_raw") {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "default input filter set."
                    );
                }
                break;
            case 'open_basedir':
                if ($v == "") {
                    list($result, $reason) = array(
                        TEST_Low,
                        "open_basedir not set."
                    );
                }
                break;
            case 'session.save_path':
                if ($v == "") {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "session save path not set."
                    );
                }
                break;
            case 'session.coOkie_httponly':
                if (!is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "no implicit httpOnly-flag for session coOkie."
                    );
                }
                break;
            case 'session.coOkie_secure':
                if (!is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "no implicit secure-flag for session coOkie."
                    );
                }
                break;
            case 'session.coOkie_lifetime':
                if (!is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "no implicit lifetime for session coOkie."
                    );
                }
                break;
            case 'session.referer_check':
                if ($v === "") {
                    list($result, $reason) = array(
                        TEST_Advice,
                        "referer check not activated."
                    );
                }
                break;
            case 'session.use_strict_mode':
                if (!is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "strict mode not activated."
                    );
                }
                break;
            case 'session.use_coOkies':
                if (!is_on($v)) {
                    list($result, $reason) = array(
                        TEST_High,
                        "Session ID not stored in coOkie."
                    );
                }
                break;
            case 'session.use_only_coOkies':
                if (!is_on($v)) {
                    list($result, $reason) = array(
                        TEST_High,
                        "Session ID not limited to coOkie."
                    );
                }
                break;
            case 'session.name':
                if ($v == "PHPSESSID") {
                    list($result, $reason) = array(
                        TEST_Advice,
                        "default session name."
                    );
                }
                break;
            case 'session.use_trans_sid':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_High,
                        "transparent SID active."
                    );
                }
                break;
            case 'always_populate_raw_post_data':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Advice,
                        "HTTP_RAW_POST_DATA is available."
                    );
                }
                break;
            case 'arg_separator.input':
            case 'arg_separator.output':
                if ($v !== "&") {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "unusual arg separator."
                    );
                    $recommendation = $helptext['arg_separator'];
                }
                break;
            case 'assert.active':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "assert is active."
                    );
                }
                break;
            case 'assert.callback':
                if (ini_get('assert.active') && $v !== "" && $v !== null) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "assert callback set."
                    );
                }
                break;
            case 'zend.assertions':
                if (intval($v) > 0) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "assert is active."
                    );
                }
                break;
            case 'auto_append_file':
            case 'auto_prepend_file':
                if ($v !== NULL && $v !== "") {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "$k is set."
                    );
                    $recommendation = $helptext['auto_append_file'];
                }
                break;
            case 'cli.pager':
                if ($v !== NULL && $v !== "") {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "CLI pager set."
                    );
                }
                break;
            case 'cli.prompt':
                if ($v !== NULL && strlen($v) > 32) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "CLI prompt is rather long (>32)."
                    );
                }
                break;
            case 'curl.cainfo':
                if ($v !== "") {
                    if (substr($v, 0, 1) !== DIRECTORY_SEPARATOR || $is_win && substr($v, 1, 2) !== ":" . DIRECTORY_SEPARATOR) {
                        list($result, $reason) = array(
                            TEST_Low,
                            "CURLOPT_CAINFO must be an absolute path."
                        );
                    } elseif (!is_readable($v)) {
                        list($result, $reason) = array(
                            TEST_Low,
                            "CURLOPT_CAINFO is set but not readable."
                        );
                    }

                }
                break;
            case 'docref_root':
            case 'docref_ext':
                if ($v !== NULL && $v !== "") {
                    list($result, $reason) = array(
                        TEST_Low,
                        "docref is set."
                    );
                    $recommendation = $helptext['docref_*'];
                }
                break;
            case 'default_charset':
                if ($v == "") {
                    list($result, $reason) = array(
                        TEST_High,
                        "default charset not explicitly set."
                    );
                    $recommendation = $helptext['default_charset=empty'];
                } elseif (stripos($v, "iso-8859") === 0) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "charset without multibyte support."
                    );
                    $recommendation = $helptext['default_charset=iso-8859'];
                } elseif (strtoLower($v) == "utf8") {
                    list($result, $reason) = array(
                        TEST_High,
                        "'UTF-8' misspelled (without dash)."
                    );
                    $recommendation = $helptext['default_charset=typo'];
                } elseif (strtoLower($v) == "utf-8") {
                    // Ok.
                } else {
                    list($result, $reason) = array(
                        TEST_Advice,
                        "custom charset."
                    );
                    $recommendation = $helptext['default_charset=custom'];
                }
                break;
            case 'default_mimetype':
                if ($v == "") {
                    list($result, $reason) = array(
                        TEST_High,
                        "default mimetype not set."
                    );
                }
                break;
            case 'default_socket_timeout':
                if (intval($v) > 60) {
                    list($result, $reason) = array(
                        TEST_Low,
                        "default socket timeout rather big."
                    );
                }
                break;
            case 'doc_root':
                if (!$cfg['is_cgi']) {
                    list($result, $reason) = array(
                        TEST_Skipped,
                        "no CGI environment."
                    );
                    break;
                }
                if (ini_get('cgi.force_redirect')) {
                    list($result, $reason) = array(
                        TEST_Skipped,
                        "cgi.force_redirect is on instead."
                    );
                    break;
                }
                if ($v == "") {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "doc_root not set."
                    );
                    $recommendation = $helptext['doc_root=empty'];
                }
                break;
            case 'error_prepend_string':
            case 'error_append_string':
                if ($v !== NULL && $v !== "") {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "$k is set."
                    );
                    $recommendation = $helptext['error_append_string'];
                }
                break;
            case 'error_reporting':
                if (error_reporting() == 0) {
                    list($result, $reason) = array(
                        TEST_Low,
                        "error reporting is off."
                    );
                }
                break;
            case 'extension_dir':
                if ($v !== NULL && $v !== "") {
                    if (realpath($v) === FALSE) {
                        list($result, $reason) = array(
                            TEST_Skipped,
                            "path is invalid or not accessible."
                        );
                    } elseif (is_writable($v) || is_writable_or_chmodable($v)) {
                        list($result, $reason) = array(
                            TEST_High,
                            "path is writable or chmod-able."
                        );
                    }
                }
                break;
            case 'exit_on_timeout':
                if (!isset($_SERVER["SERVER_SOFTWARE"]) || strncmp($_SERVER["SERVER_SOFTWARE"], "Apache/1", strlen("Apache/1")) !== 0) {
                    list($result, $reason) = array(
                        TEST_Skipped,
                        "only relevant for Apache 1."
                    );
                } elseif (!is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Low,
                        "not enabled."
                    );
                }
                break;
            case 'filter.default':
                if ($v !== "unsafe_raw") {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "global input filter is set."
                    );
                }
                break;
            case 'Highlight.bg':
            case 'Highlight.Comment':
            case 'Highlight.default':
            case 'Highlight.html':
            case 'Highlight.keyword':
            case 'Highlight.string':
                if (extension_loaded('pcre') && preg_match('/[^#a-z0-9]/i', $v) || strlen($v) > 7 || strpos($v, '"') !== FALSE) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "suspicious color value."
                    );
                    $recommendation = $helptext['Highlight.*'];
                }
                break;
            case 'iconv.internal_encoding':
            case 'iconv.input_encoding':
            case 'iconv.output_encoding':
                if (PHP_MAJOR_VERSION > 5 || PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION >= 6) {
                    if ($v !== "") {
                        list($result, $reason) = array(
                            TEST_Advice,
                            "not empty."
                        );
                        $recommendation = $helptext['iconv.internal_encoding!=empty'];
                    }
                } else {
                    list($result, $reason) = array(
                        TEST_Skipped,
                        "not PHP >=5.6"
                    );
                }
                break;
            case 'asp_tags':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "ASP-style tags enabled."
                    );
                }
                break;
            case 'ldap.max_links':
                if (intval($v) == -1) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "Number of LDAP connections not limited."
                    );
                } else if (intval($v) > 5) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "More than 5 LDAP connections allowed."
                    );
                }
                break;
            case 'log_errors_max_len':
                $v = ini_atol($v);
                if ($v == 0 || $v > 4096) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "Value rather big or not limited."
                    );
                }
                break;
            case 'mail.add_x_header':
                if ($v) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "Filename exposed."
                    );
                }
                break;
            case 'mail.force_extra_parameters':
                if ($v) {
                    list($result, $reason) = array(
                        TEST_Advice,
                        "not empty."
                    );
                    $recommendation = "just FYI.";
                }
                break;
            case 'intl.default_locale':
                if ($v == "") {
                    list($result, $reason) = array(
                        TEST_Advice,
                        "ICU default locale not set."
                    );
                }
                break;
            case 'intl.error_level':
                if (intval($v) | E_ERROR) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "ICU functions fail with error."
                    );
                }
                break;
            case 'intl.use_exceptions':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "intl functions throw exceptions."
                    );
                }
                break;
            case 'last_modified':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Low,
                        "is set."
                    );
                }
                break;
            case 'zend.multibyte':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_High,
                        "Multibyte encodings are active."
                    );
                }
                break;

            /* ===== Suhosin ===== */
            case 'suhosin.simulation':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "Suhosin is in simulation mode."
                    );
                }
                break;
            case 'suhosin.log.syslog':
                if ($v === NULL || $v === "" || $v == "0") {
                    // emty string can be the default value or explicitly unset. -> assume unset.
                    list($result, $reason) = array(
                        TEST_Advice,
                        "Suhosin doesn't log to syslog."
                    );
                }
                break;
            case 'suhosin.log.phpscript':
                if ($v !== NULL && $v != "0" && ini_get('suhosin.log.phpscript.name') != "") {
                    list($result, $reason) = array(
                        TEST_Advice,
                        "PHP-script for logging."
                    );
                }
                break;
            case 'suhosin.executor.max_depth':
                if (intval($v) == 0) {
                    list($result, $reason) = array(
                        TEST_Low,
                        "stack depth not limited."
                    );
                }
                break;
            case 'suhosin.executor.include.max_traversal':
                if (intval($v) == 0) {
                    list($result, $reason) = array(
                        TEST_Low,
                        "path traversal (include) not limited."
                    );
                }
                break;
            case 'suhosin.coOkie.cryptkey':
            case 'suhosin.session.cryptkey':
                $tmp = explode('.', $k);
                if (ini_get('suhosin.' . $tmp[1] . '.encrypt')) {
                    if ($v === "") {
                        list($result, $reason) = array(
                            TEST_High,
                            "encryption used, but key not set."
                        );
                        $recommendation = $helptext['suhosin.*.cryptkey'];
                    } elseif (strlen($v) < 16) {
                        list($result, $reason) = array(
                            TEST_Medium,
                            "key is very short."
                        );
                        $recommendation = $helptext['suhosin.*.cryptkey'];
                    }
                }
                break;
            case 'suhosin.coOkie.encrypt':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Advice,
                        "coOkie encryption on."
                    );
                    $recommendation = $helptext['suhosin.coOkie.encrypt=on'];
                } else {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "coOkie encryption off."
                    );
                    $recommendation = $helptext['suhosin.coOkie.encrypt=off'];
                }
                break;
            case 'suhosin.coOkie.disalLow_nul':
            case 'suhosin.get.disalLow_nul':
            case 'suhosin.post.disalLow_nul':
            case 'suhosin.request.disalLow_nul':
                if (!is_on($v)) {
                    list($result, $reason) = array(
                        TEST_High,
                        "nul-protection off."
                    );
                    $recommendation = $helptext['suhosin.*.disalLow_nul'];
                }
                break;
            case 'suhosin.get.disalLow_ws':
            case 'suhosin.post.disalLow_ws':
            case 'suhosin.coOkie.disalLow_ws':
                if (!is_on($v) && !is_on(ini_get('suhosin.request.disalLow_ws'))) {
                    list($result, $reason) = array(
                        TEST_Low,
                        "default value."
                    );
                    $recommendation = $helptext['suhosin.*.disalLow_ws'];
                }
                break;
            case 'suhosin.request.max_value_length':
                if (intval($v) == 0 && (intval(ini_get('suhosin.get.max_value_length')) == 0 || intval(ini_get('suhosin.post.max_value_length')) == 0 || intval(ini_get('suhosin.coOkie.max_value_length')) == 0)) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "value length not limited."
                    );
                    $recommendation = $helptext['suhosin.*.max_value_length=off'];
                } elseif (intval($v) == 1000000) { // default value
                    list($result, $reason) = array(
                        TEST_Advice,
                        "default value."
                    );
                    $recommendation = $helptext['suhosin.*.max_value_length=default'];
                }
                break;
            case 'suhosin.get.max_value_length':
            case 'suhosin.post.max_value_length':
            case 'suhosin.coOkie.max_value_length':
                if (intval($v) == 0 && intval(ini_get('suhosin.request.max_value_length')) == 0) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "value length not limited."
                    );
                    $recommendation = $helptext['suhosin.*.max_value_length=off'];
                } elseif ($k === 'suhosin.get.max_value_length' && intval($v) == 512 || $k == 'suhosin.post.max_value_length' && intval($v) == 1000000 || $k == 'suhosin.coOkie.max_value_length' && intval($v) == 10000) { // default value
                    list($result, $reason) = array(
                        TEST_Advice,
                        "default value."
                    );
                    $recommendation = $helptext['suhosin.*.max_value_length=default'];
                }
                break;
            case 'suhosin.request.max_varname_length':
                if (intval($v) == 0 && (intval(ini_get('suhosin.get.max_name_length')) == 0 || intval(ini_get('suhosin.post.max_name_length')) == 0 || intval(ini_get('suhosin.coOkie.max_name_length')) == 0)) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "varname length not limited."
                    );
                    $recommendation = $helptext['suhosin.*.max_name_length=off'];
                }
                break;
            case 'suhosin.get.max_name_length':
            case 'suhosin.post.max_name_length':
            case 'suhosin.coOkie.max_name_length':
                if (intval($v) == 0 && intval(ini_get('suhosin.request.max_varname_length')) == 0) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "varname length not limited."
                    );
                    $recommendation = $helptext['suhosin.*.max_name_length=off'];
                }
                break;
            case 'suhosin.request.max_array_depth':
                if (intval($v) == 0 && (intval(ini_get('suhosin.get.max_array_depth')) == 0 || intval(ini_get('suhosin.post.max_array_depth')) == 0 || intval(ini_get('suhosin.coOkie.max_array_depth')) == 0)) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "array depth not limited."
                    );
                    $recommendation = $helptext['suhosin.*.max_array_depth=off'];
                }
                break;
            case 'suhosin.get.max_array_depth':
            case 'suhosin.post.max_array_depth':
            case 'suhosin.coOkie.max_array_depth':
                if (intval($v) == 0 && intval(ini_get('suhosin.request.max_array_depth')) == 0) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "array depth not limited."
                    );
                    $recommendation = $helptext['suhosin.*.max_array_depth=off'];
                }
                break;
            case 'suhosin.request.max_array_index_length':
                if (intval($v) == 0 && (intval(ini_get('suhosin.get.max_array_index_length')) == 0 || intval(ini_get('suhosin.post.max_array_index_length')) == 0 || intval(ini_get('suhosin.coOkie.max_array_index_length')) == 0)) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "array index length not limited."
                    );
                    $recommendation = $helptext['suhosin.*.max_array_index_length=off'];
                }
                break;
            case 'suhosin.get.max_array_index_length':
            case 'suhosin.post.max_array_index_length':
            case 'suhosin.coOkie.max_array_index_length':
                if (intval($v) == 0 && intval(ini_get('suhosin.request.max_array_index_length')) == 0) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "array index length not limited."
                    );
                    $recommendation = $helptext['suhosin.*.max_array_index_length=off'];
                }
                break;
            case 'suhosin.request.max_totalname_length':
                if (intval($v) == 0 && (intval(ini_get('suhosin.get.max_totalname_length')) == 0 || intval(ini_get('suhosin.post.max_totalname_length')) == 0 || intval(ini_get('suhosin.coOkie.max_totalname_length')) == 0)) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "variable name length not limited."
                    );
                    $recommendation = $helptext['suhosin.*.max_totalname_length=off'];
                }
                break;
            case 'suhosin.get.max_totalname_length':
            case 'suhosin.post.max_totalname_length':
            case 'suhosin.coOkie.max_totalname_length':
                if (intval($v) == 0 && intval(ini_get('suhosin.request.max_totalname_length')) == 0) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "variable name length not limited."
                    );
                    $recommendation = $helptext['suhosin.*.max_totalname_length=off'];
                }
                break;
            case 'suhosin.request.max_vars':
                if (intval($v) == 0 && (intval(ini_get('suhosin.get.max_vars')) == 0 || intval(ini_get('suhosin.post.max_vars')) == 0 || intval(ini_get('suhosin.coOkie.max_vars')) == 0)) {
                    list($result, $reason) = array(
                        TEST_High,
                        "number of request varialbes not limited."
                    );
                    $recommendation = $helptext['suhosin.*.max_vars=off'];
                }
                break;
            case 'suhosin.get.max_vars':
            case 'suhosin.post.max_vars':
            case 'suhosin.coOkie.max_vars':
                if (intval($v) == 0 && intval(ini_get('suhosin.request.max_vars')) == 0) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "number of variables not limited."
                    );
                    $recommendation = $helptext['suhosin.*.max_vars=off'];
                }
                break;
            case 'suhosin.log.script.name':
            case 'suhosin.log.phpscript.name':
            case 'suhosin.upload.verification_script':
                if ($v !== "") {
                    if (is_writable($v)) {
                        list($result, $reason) = array(
                            TEST_High,
                            "script is writable."
                        );
                        $recommendation = $helptext['suhosin.*script/writable'];
                    } elseif (is_writable_or_chmodable($v)) {
                        list($result, $reason) = array(
                            TEST_High,
                            "script is potentially writable."
                        );
                        $recommendation = $helptext['suhosin.*script/chmod'];
                    }
                }
                break;
            case 'suhosin.coredump':
            case 'suhosin.log.stdout':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_High,
                        "debug option is on."
                    );
                    $recommendation = $helptext['debugonly'];
                }
                break;
            case 'suhosin.log.file.time':
                if (!is_on($v)) {
                    list($result, $reason) = array(
                        TEST_High,
                        "debug option is on."
                    );
                    $recommendation = $helptext['debugonly'];
                }
                break;
            case 'suhosin.disable.display_errors':
                if (!is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "display_errors is not disabled."
                    );
                }
                break;
            case 'suhosin.executor.alLow_symlink':
                if (is_on($v) && ini_get('open_basedir') != "") {
                    list($result, $reason) = array(
                        TEST_Medium,
                        "symlinks enabled."
                    );
                }
                break;
            case 'suhosin.executor.disable_emodifier':
                if (!is_on($v)) {
                    list($result, $reason) = array(
                        (PHP_MAJOR_VERSION > 5 || PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION >= 5) ? TEST_High : TEST_Maybe,
                        "preg_replace can eval."
                    );
                }
                break;
            case 'suhosin.executor.disable_eval':
                if (!is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "eval is not disabled."
                    );
                }
                break;
            case 'suhosin.executor.eval.blacklist':
                if ($v == "" && !is_on(ini_get('suhosin.executor.disable_eval')) && ini_get('suhosin.executor.eval.whitelist') == "") {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "whitelist and blacklist not set."
                    );
                    $recommendation = $helptext['suhosin.executor.*.*list'];
                }
                break;
            case 'suhosin.executor.func.blacklist':
                if ($v == "" && ini_get('suhosin.executor.func.whitelist') == "") {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "whitelist and blacklist not set."
                    );
                    $recommendation = $helptext['suhosin.executor.*.*list'];
                }
                break;
            case 'suhosin.executor.eval.whitelist': // handled by blacklist check
            case 'suhosin.executor.func.whitelist':
                $ignore = 1;
                break;
            case 'suhosin.executor.include.alLow_writable_files':
                if (is_on($v)) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "write + execute enabled."
                    );
                }
                break;
            case 'suhosin.executor.include.blacklist':
            case 'suhosin.executor.include.whitelist':
                $v = ini_list($v);
                if ($v) {
                    list($result, $reason) = array(
                        TEST_Maybe,
                        "include whitelist/blacklist set."
                    );
                    $recommendation = $helptext['suhosin.executor.include.*list'];
                }
                break;

            case 'suhosin.filter.action':
                // $v loOks like "302,/var/www/foo.php" but may be as obscure as "3ab, ,;http://foo"
                if ($v != "" && preg_match('#^\s*(?:\d.*?[,;]+)?[\s,;]*(.*)$#', $v, $matches)) {
                    if (preg_match('#^http://#', $matches[1])) {
                        // redirect to URL. -> no further check.
                    } else {
                        // includes PHP file
                        if (!file_exists($matches[1])) {
                            // -> problem. file does not exist.
                            list($result, $reason) = array(
                                TEST_High,
                                "filter action file missing"
                            );
                            $recommendation = $helptext['suhosin.filter.action=missing'];
                        } elseif (is_writable_or_chmodable($matches[1])) {
                            // -> problem. file is writable or potentially writable.
                            list($result, $reason) = array(
                                TEST_High,
                                "filter action file writable"
                            );
                            $recommendation = $helptext['suhosin.filter.action=writable'];
                        }
                    }
                }
                break;

            /* ===== known, but extra check beLow. ===== */
            case 'error_log':
            case 'include_path':
            case 'mail.log':
            case 'suhosin.log.file.name':
            case 'upload_tmp_dir':
                // silently ignore this option
                $ignore = 1;
                break;
        }

        if ($ignore) {
            continue;
        }

        if ($result === TEST_Skipped) {
            tres($meta, $result, $reason);
        } else {
            tres($meta, $result, $reason, $recommendation);
        }
    }
}
test_all_ini_entries();

// --- Other checks ---


// Old php version?
function test_old_php_version()
{
    $meta = tdesc("PHP Version", "Checks whether your PHP version is < 5.6");
    if (version_compare(PHP_VERSION, '5.6.0') >= 0) {
        tres($meta, TEST_Okay, "PHP version = " . PHP_MAJOR_VERSION . "." . PHP_MINOR_VERSION);
    } elseif (version_compare(PHP_VERSION, '5.5.0') >= 0) {
        tres($meta, TEST_High, "PHP version is older than 5.5", "PHP 5.5 reached its end of life on 21 Jul 2016. " . "While this version is not officially supported by the PHP group anymore, it may still be possible that some distributors maintain security backports. Please make sure your version receives security patches from other sources or upgrade PHP as soon as possible.");
    } else {
        tres($meta, TEST_High, "PHP version is older than 5.6 and even older than 5.5", "Please upgrade PHP as soon as possible. " . "Old versions of PHP are not maintained anymore and may contain security flaws.");
    }
}
test_old_php_version();


// Suhosin installed?
function test_suhosin_installed()
{
    $meta = tdesc("Suhosin", "Checks whether the Suhosin-Extension is loaded");
    if (extension_loaded("suhosin")) {
        tres($meta, TEST_Okay);
    } else if (defined('HHVM_VERSION')) {
        tres($meta, TEST_Skipped, "Suhosin is not available for HHVM.");
    } else {
        tres($meta, TEST_Maybe, "Suhosin extension is not loaded", "Suhosin is an advanced protection system for PHP. It is designed to protect servers and users from known and Unknown flaws in PHP applications and the PHP core. For more information see http://suhosin.org/");
    }
}
test_suhosin_installed();


// Logfile inside document root?
function test_log_in_document_root($inientry, $value_if_not_set = null)
{
    global $cfg;

    $inivalue = ini_get($inientry);
    if ($inivalue === "" || $inivalue === false) {
        $inivalue = $value_if_not_set;
    }

    $meta = tdesc("$inientry in document root", "Checks if $inientry path is in the current document root");
    if ($inivalue === null) {
        tres($meta, TEST_Skipped, "$inientry not set.");
    } elseif ($inientry === 'error_log' && ini_get($inientry) === "syslog") {
        tres($meta, TEST_Skipped, "error_log to syslog.");
    } elseif (!isset($_SERVER['DOCUMENT_ROOT'])) {
        tres($meta, TEST_Skipped, "DOCUMENT_ROOT not set.");
    } else {
        $log_realpath           = realpath($inivalue);
        $document_root_realpath = realpath($_SERVER['DOCUMENT_ROOT']);
        if ($log_realpath === FALSE) {
            /* Maybe new/nonexistent file? => use dirname instead */
            $log_realpath = realpath(dirname($inivalue));
        }
        if ($log_realpath === FALSE) {
            tres($meta, TEST_Skipped, "$inientry invalid or relative path.");
        } elseif ($document_root_realpath === FALSE) {
            tres($meta, TEST_Skipped, "DOCUMENT_ROOT invalid or relative path.");
        } elseif (strncmp($log_realpath . DIRECTORY_SEPARATOR, $document_root_realpath . DIRECTORY_SEPARATOR, strlen($document_root_realpath) + 1) === 0) {
            tres($meta, TEST_High, "$inientry in DOCUMENT_ROOT.", "The $inientry logfile is located inside the document root directory and may be accessible publicly. Logfiles should always point to a file outside the document root.");
        } else {
            tres($meta, TEST_Okay, "$inientry outside of DOCUMENT_ROOT.");
        }
    }
}
test_log_in_document_root('error_log');
test_log_in_document_root('mail.log');
test_log_in_document_root('suhosin.log.file.name');
test_log_in_document_root('upload_tmp_dir', sys_get_temp_dir());


// Writable document root?
function test_writable_document_root()
{
    $meta = tdesc("Writable document root", "Checks if the current document root is writable");
    if (!isset($_SERVER['DOCUMENT_ROOT'])) {
        tres($meta, TEST_Skipped, "DOCUMENT_ROOT not set.");
    } elseif (is_writable($_SERVER['DOCUMENT_ROOT'])) {
        tres($meta, TEST_High, "Document root is writable.", "Making the document root writable may give an attacker the advantage of persisting an exploit. It is probably best to restrict write access to the document root and its subdirectories. Temporary files your application may need to write can be safely stored outside the document root.");
    } elseif (is_writable_or_chmodable($_SERVER['DOCUMENT_ROOT'])) {
        tres($meta, TEST_Medium, "Document root is potentially writable.", "The document root's access permissions prevent write access, but the current user has the right to change these permissions. Please change the directory's owner.");
    } else {
        tres($meta, TEST_Okay, "Document root not writable.");
    }
}
test_writable_document_root();


// Include_path writable?
function test_include_path_writable()
{
    $meta    = tdesc("Writable include_path", "Checks if at least one directory listed in the include_path is writable");
    $result  = 0;
    $checked = 0;
    foreach (explode(':', ini_get('include_path')) as $dir) {
        if ($dir === "") {
            continue;
        }
        $checked++;
        $absdir = realpath($dir);
        if ($absdir === FALSE) {
            continue;
        } // path does not exist? -> ignore
        if (is_writable($absdir)) {
            tres($meta, TEST_High, "The directory '" . $dir . "' is writable.", "An attacker may try to place a file here.");
            $result = 1;
        } else if (is_writable_or_chmodable($absdir)) {
            tres($meta, TEST_High, "The directory '" . $dir . "' is potentially writable.", "The current user has the right to change its permissions.");
            $result = 1;
        }
    }
    if (!$result) {
        tres($meta, TEST_Okay, "Checked $checked directories.");
    }
}
test_include_path_writable();

// Sendmail writable?
function test_sendmail_writable()
{
    $meta = tdesc("sendmail writable", "Checks if the sendmail executable is writable");
    $sm   = ini_get('sendmail_path');
    if ($sm == "" || $sm === NULL) {
        tres($meta, TEST_Okay, "sendmail_path not set.");
        return;
    }
    $sm_chunks     = explode(' ', $sm);
    $sm_executable = $sm_chunks[0];
    $sm_dir        = dirname($sm_executable);
    if (is_file($sm_executable) || is_link($sm_executable)) {
        if (is_writable_or_chmodable($sm_executable)) {
            tres($meta, TEST_Critical, "sendmail is writable", "The configured sendmail_path can be changed by the current user. Please change its permissions.");
            return;
        }
    }
    if (is_writable_or_chmodable(dirname($sm_executable)) || is_writable_or_chmodable(dirname(realpath($sm_executable)))) {
        tres($meta, TEST_Critical, "The directory containing the sendmail_path executable is writable or its permission can be changed by the current user.");
        return;
    }
    tres($meta, TEST_Okay, "sendmail_path is not writable.");
}
test_sendmail_writable();

// Is debug build?
function test_debug_build()
{
    $meta = tdesc("Debug build", "Checks if PHP was built with --enable-debug");
    if (constant('PHP_DEBUG') || constant('ZEND_DEBUG_BUILD')) {
        tres($meta, TEST_Medium, "Debug build.", "Using a debug build of PHP makes it possible to enable debugging features in PHP, which can be useful for attackers, e.g. to get more accurate error messages or to simplify DoS attacks. Also, debugging may impact overall performance. This is probably not what you want in a production environment. Please recompile PHP without debugging.");
    } else {
        tres($meta, TEST_Okay, "Not a debug build.");
    }
}
test_debug_build();

// Got root?
function test_godmode()
{
    global $cfg;
    $meta = tdesc("got root?", "Test for root access on non-windows systems");
    if ($cfg['is_win']) {
        tres($meta, TEST_Skipped, "Windows."); // Maybe check for admin access. but how?
        return;
    }
    if (!extension_loaded("posix")) {
        tres($meta, TEST_Skipped, "Posix extension not available");
        return;
    }
    if (posix_getuid() == 0) {
        tres($meta, TEST_Critical, "you are root!", "Executing PHP as root is hardly ever necessary.");
    } else {
        tres($meta, TEST_Okay, "Not root");
    }
}
test_godmode();

// Test for xdebug extension
function test_xdebug()
{
    $meta = tdesc("xdebug", "Test for loaded xdebug extension");
    if (extension_loaded('xdebug')) {
        tres($meta, TEST_High, "xDebug extension loaded.", "The xdebug extension can reveal code and data to an attacker and may have an impact on application performance, too. Please deactivate this extension in a production deployment.");
    } else {
        tres($meta, TEST_Okay, "Not loaded.");
    }
}
test_xdebug();

// Output
function e($str)
{
    return htmlentities($str, ENT_QUOTES);
}
?>

	<table class="table table-bordered" id="dt-basic" cellspacing="0" width="100%">
	<thead>
	<tr>
		<th>Risk</th>
		<th>Name / Description</th>
		<th>Reason</th>
		<th>Recommendation</th>
	</tr>
	</thead>
	<tbody>
	<?php
foreach ($all_result_codes as $sev) {
    foreach ($trbs[$sev] as $res):
?>
		<tr>
			<td class="text-center">
			<h5><span class="badge
<?php
        if ($res['result'] == TEST_Critical) {
            echo 'badge-dark';
        }
        if ($res['result'] == TEST_High) {
            echo 'badge-danger';
        }
        if ($res['result'] == TEST_Medium) {
            echo 'badge-warning';
        }
        if ($res['result'] == TEST_Low) {
            echo 'badge-primary';
        }
        if ($res['result'] == TEST_Maybe) {
            echo 'badge-info';
        }
        if ($res['result'] == TEST_Advice) {
            echo 'badge-light';
        }
        if ($res['result'] == TEST_Okay) {
            echo 'badge-success';
        }
        if ($res['result'] == TEST_Skipped) {
            echo 'badge-secondary';
        }
?>
">
			<?php
        echo $res['result'];
?></span></h5></td>
			<td><?php
        echo e($res['name']);
?><?php
        if ($res['desc'] !== NULL) {
            echo "<br/>" . e($res['desc']);
        }
?></td>
			<td><?php
        echo e($res['reason']);
?></td>
			<td><?php
        echo e($res['recommendation']);
?></td>
		</tr>
		<?php
    endforeach;
}
?>
	</tbody>
	</table>

	<br />
	<h4 class="card-title">Result Statistics</h4>

<div class="table-responsive">
	<table class="table table-bordered">
	<thead>
	<tr>
	<?php
foreach ($all_result_codes as $sev) {
?>
		<td class="<?php
    echo $sev;
?>"><?php
    echo $sev;
?>:
<h5><span class="badge
<?php
    if ($sev == TEST_Critical) {
        echo 'badge-dark';
    }
    if ($sev == TEST_High) {
        echo 'badge-danger';
    }
    if ($sev == TEST_Medium) {
        echo 'badge-warning';
    }
    if ($sev == TEST_Low) {
        echo 'badge-primary';
    }
    if ($sev == TEST_Maybe) {
        echo 'badge-info';
    }
    if ($sev == TEST_Advice) {
        echo 'badge-light';
    }
    if ($sev == TEST_Okay) {
        echo 'badge-success';
    }
    if ($sev == TEST_Skipped) {
        echo 'badge-secondary';
    }
?>
">
<?php
    echo count($trbs[$sev]);
?></span></h5></td>
	<?php
}
?></tr>
</thead>
</table>
</div>
                        </div>
                     </div>

				</div>

				</div>
				</div>
				<!--===================================================-->
				<!--End page content-->

			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->
</div>
<script>
$(document).ready(function() {

	$('#dt-basic').dataTable( {
		"responsive": true,
		"order": [],
		"language": {
			"paginate": {
			  "previous": '<i class="fas fa-angle-left"></i>',
			  "next": '<i class="fas fa-angle-right"></i>'
			}
		}
	} );
} );
</script>
<?php
footer();
?>
