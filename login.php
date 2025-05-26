<?php
session_start(); // Mulai sesi
require_once "config/Database.php";
require_once "classes/User.php";

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_POST) {
    $user->username = $_POST['username'];
    $user->password = $_POST['password']; // Kata sandi akan di-hash di dalam kelas

    if ($user->login()) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['level'] = $user->level;

        if ($user->level == 0) { // Jika level adalah admin
            header("Location: admin_dashboard.php");
            exit();
        } else { // Jika level adalah pengguna biasa
            header("Location: user_dashboard.php");
            exit();
        }
    } else {
        $error_message = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error_message)) : ?>
        <p style="color: red;"><?= $error_message; ?></p>
    <?php endif; ?>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>