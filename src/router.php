<?php
switch (parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/': {
        require_once 'pages/index.php';
        break;
    }
    case '/login': {
        require_once 'pages/login.php';
        break;
    }
    case 'api/login': {
        require_once 'pages/api/login.php';
        break;
    }
    default: {
        require_once 'pages/404.php';
        break;
    }
}
include_once 'components/Header.php';
?>