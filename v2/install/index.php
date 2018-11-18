<?php

require_once('core.php');

$step = $_GET['step'] ?? 'language';

ob_start();
switch ($step) {
    case 'language' :
        require('steps/language.php');
        break;
    case 'database' :
        require('steps/database.php');
        break;
    case 'settings' :
        require('steps/settings.php');
        break;
    case 'done' :
        require('steps/done.php');
        break;
    default :
        require('steps/language.php');
        break;
}
$content = ob_get_clean();
require('layout.php');
