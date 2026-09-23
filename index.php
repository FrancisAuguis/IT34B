<?php

require_once 'config/config.php';

if (isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
    exit;
}

$error='';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($login === '' || $password === ''){
        $error = 'Please fill in all fields';

        logActivity(
            $pdo,
            null,
            $login,
            'login',
            'failed'
        );
    } else{
        if(loginUser($pdo, $login, $password)){
            logActivity(
                $pdo,
                $_SESSION['user_id'],
                $_SESSION['user_email'],
                'login',
                'success'
            );

            header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
            exit;
        } else {
            $error = 'Invalid login credentials';

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form method="post">
        <?php if ($error !== ''): ?>
            <p style="color:red"><?php echo $error; ?></p>
        <?php endif; ?>

        <label>Username or Email</label>
        <input type="text"
               name="login"
               required>

        <br>
        <br>

        <label>Password</label>
        <input type="password"
               name="password"
               required>
        <br>

        <button type="submit">Sign In</button>
    </form>

</body>
</html>