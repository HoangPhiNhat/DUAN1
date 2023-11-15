<p>sao ko day len duoc</p><?php
require_once('config/connection.php');

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'index';
    }
} else {
    $controller = 'client';
    $action = 'home';
}
require_once('routes.php');
