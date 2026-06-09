<?php


session_start();

// Definir la ruta base de la aplicación
define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define('APP_PATH', BASE_PATH . 'app' . DIRECTORY_SEPARATOR);
define('CONTROLLERS_PATH', APP_PATH . 'controllers' . DIRECTORY_SEPARATOR);
define('MODELS_PATH', APP_PATH . 'models' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', APP_PATH . 'views' . DIRECTORY_SEPARATOR);
define('UTILITIES_PATH', APP_PATH . 'utilities' . DIRECTORY_SEPARATOR);
define('PUBLIC_PATH', BASE_PATH . 'public' . DIRECTORY_SEPARATOR);

// Incluir autoloader de clases
require_once APP_PATH . 'Autoloader.php';
\App\Autoloader::register();

// Obtener la acción solicitada
$action = isset($_GET['action']) ? $_GET['action'] : 'menu';
$action = htmlspecialchars($action, ENT_QUOTES, 'UTF-8');

// Enrutamiento simple
switch ($action) {
    case 'problem1':
        require_once CONTROLLERS_PATH . 'Problem1Controller.php';
        $controller = new \App\Controllers\Problem1Controller();
        $controller->handle();
        break;

    case 'problem2':
        require_once CONTROLLERS_PATH . 'Problem2Controller.php';
        $controller = new \App\Controllers\Problem2Controller();
        $controller->handle();
        break;

    case 'problem3':
        require_once CONTROLLERS_PATH . 'Problem3Controller.php';
        $controller = new \App\Controllers\Problem3Controller();
        $controller->handle();
        break;

    case 'problem4':
        require_once CONTROLLERS_PATH . 'Problem4Controller.php';
        $controller = new \App\Controllers\Problem4Controller();
        $controller->handle();
        break;
     
    case 'problem5':
        require_once CONTROLLERS_PATH . 'Problem5Controller.php';
        $controller = new \App\Controllers\Problem5Controller();
        $controller->handle();
        break;

    case 'problem6':
        require_once CONTROLLERS_PATH . 'Problem6Controller.php';
        $controller = new \App\Controllers\Problem6Controller();
        $controller->handle();
        break;

    case 'problem7':
        require_once CONTROLLERS_PATH . 'Problem7Controller.php';
        $controller = new \App\Controllers\Problem7Controller();
        $controller->handle();
        break;

    case 'problem8':
        require_once CONTROLLERS_PATH . 'Problem8Controller.php';
        $controller = new \App\Controllers\Problem8Controller();
        $controller->handle();
        break;

    case 'problem9':
        require_once CONTROLLERS_PATH . 'Problem9Controller.php';
        $controller = new \App\Controllers\Problem9Controller();
        $controller->handle();
        break;

    case 'menu':


    default:
        require_once VIEWS_PATH . 'menu.php';
        break;
}
?>

