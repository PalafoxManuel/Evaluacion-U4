<?php
if (!isset($_SESSION)) {
    session_start();
}

// BASE PATH Definido en .env
if (!defined('BASE_PATH')) {
    define('BASE_PATH', getenv('BASE_PATH') ?: 'http://default-path/');
}
?>