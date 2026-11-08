<?php
require_once __DIR__ . '/../config/config.php';

if (isset($_SESSION['user_id'])) {
    logActivity(
        $pdo,
        $_SESSION['user_id'],
        $_SESSION['user_email'] ?? null,
        'logout',
        'success'
    );

    endUserSession($pdo);

    session_unset();
    session_destroy();
}

redirect('/index.php');
?>