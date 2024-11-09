<?php
if (!isset($_SESSION)) {
    session_start();
}

// BASE PATH definido en .env
if (!defined('BASE_PATH')) {
    define('BASE_PATH','http://localhost/EVALUACION-U4/');
}
?>
