
<?php
session_start();
define('BASE_DIR', dirname(__DIR__));
require_once BASE_DIR . '/app/core/Config.php';
require_once BASE_DIR . '/app/core/Database.php';
require_once BASE_DIR . '/app/core/Model.php';
require_once BASE_DIR . '/app/core/Controller.php';
require_once BASE_DIR . '/app/core/Router.php';
require_once BASE_DIR . '/app/core/Auth.php';
$router = new Router();
require_once BASE_DIR . '/app/routes/web.php';
$router->dispatch();
