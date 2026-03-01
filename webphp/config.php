<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('BASE_URL')) {
    $base_dir = str_replace('\\', '/', __DIR__);
    $doc_root = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
    if (strpos($base_dir, $doc_root) === 0) {
        define('BASE_URL', rtrim(substr($base_dir, strlen($doc_root)), '/'));
    } else {
        define('BASE_URL', '');
    }
}
?>
