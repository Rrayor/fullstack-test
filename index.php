<?php
    session_start();

    require_once('db_config.php');

    $base_uri = 'fullstack-test';

    $db = new DB();
    $conn = $db->getConn();

    if($conn === null) {
        echo 'Server Error';
    }

    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }

    function view($file) {
        include_once('./views/components/head.php');
        include_once('./views/components/nav.php');
        include_once('./views/' . $file . '.php');
        include_once('./views/components/foot.php');
    }

    $request_uri = explode($base_uri, $_SERVER['REQUEST_URI'], 2);
    if(count($request_uri) > 1) {
        $request_uri = explode('?', $request_uri[1], 2);
    }
    
    switch ($request_uri[0]) {
        case '/':
            require_once('./routes/home.php');
            break;
        case '/login':
            require_once('./routes/login.php');
            break;
        case '/list':
            require_once('./routes/list.php');
            break;
        case '/logout':
            require_once('./routes/logout.php');
            break;
        default:
            require_once('./routes/404.php');
            break;
    }

?>