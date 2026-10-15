<?php
require_once __DIR__ . '/config/config.php';

$error = '';

if (isset($_SESSION['user_id'])) {
    header(
        'Location: ' . BASE_URL . '/app/' .
        $_SESSION['user_role'] . '/index.php'
    );
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($login === '' || $password === '') {
        $error = 'Please enter your username/email and password.';

        logActivity(
            $pdo,
            null,
            $login,
            'login',
            'failed'
        );
    } else {
        $result = loginUser($pdo, $login, $password);

        if ($result === true) {
            logActivity(
                $pdo,
                $_SESSION['user_id'],
                $_SESSION['user_email'] ?? $login,
                'login',
                'success'
            );

            header(
                'Location: ' . BASE_URL . '/app/' .
                $_SESSION['user_role'] . '/index.php'
            );
            exit;

        } elseif ($result === 'active_session') {
            $error = 'This account is already logged in on another device.';
        } else {
            $error = 'Invalid login credentials.';

            logActivity(
                $pdo,
                null,
                $login,
                'login',
                'failed'
            );
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>IT34B Login</title>
</head>
<body>
    <form method="POST">
        <label for="login">Username or Email</label>
        <input
            type="text"
            id="login"
            name="login"
            required
        >

        <br><br>

        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            required
        >

        <br><br>

        <button type="submit">Sign In</button>
    </form>

    <?php if ($error !== ''): ?>
        <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <?php if (isset($_GET['timeout'])): ?>
        <p>Your session has expired due to inactivity.
           Please log in again.</p>
    <?php endif; ?>
</body>
</html>
