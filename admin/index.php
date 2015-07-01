<?php

require_once 'system/config.php';
require_once 'system/page.php';
require_once 'system/html.php';
require_once 'system/url.php';
require_once 'system/model.php';
require_once 'system/controller.php';
require_once 'system/request.php';
require_once 'system/db.php';
require_once 'system/validator.php';
/* * ******* DEBUG ******** */
if (DEBUG_MODE) {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}
/* * ***** END DEBUG ****** */

ini_set("display_errors", "1");
error_reporting(E_ALL);

/* * ******* INIT ******** */
$request = new request();
$db = new db(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
/* * ***** END INIT ****** */

/* * ******* ROUTE ******** */
if (isset($request->session['user_id'])) {
    if (isset($request->get['model'])) {
        $model_name = $request->get['model'];
        $model_class = $model_name . "_controller";
        $model_file = 'controller/' . $model_name . ".php";
        if (file_exists($model_file)) {
            require_once $model_file;
            $controller = new $model_class($db, $request);
            $controller->dispatch();
        } else {
            header("location: index.php");
        }
    } else {
        require_once "controller/uploads.php";
        $controller = new uploads_controller($db, $request);
        $controller->dispatch();
    }
} else {
    require_once "controller/login.php";
    $controller = new login_controller($db, $request);
    $controller->dispatch();
}
/* * ***** END ROUTE ****** */
?>