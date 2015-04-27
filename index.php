<?php
//ini_set("display_errors", '0');
//error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(-1);
header('Cache-Control: no-store');
require_once('.'.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'include.php');

set_error_handler('errorLog');

use \application\controllers\FrontController as FrontController;
use \application\models\View as View;

$front = FrontController::getInstance();
$front->route();
echo $front->getBody();


