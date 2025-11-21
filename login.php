<?php
require_once 'config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $errors[] = 'Username and password are required.';
    } else {
        // Check credentials
        $stmt = $pdo->prepare("SELECT id, name, password_hash, role FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            redirect('index.php');
        } else {
            $errors[] = 'Invalid username or password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Basketball Court Booking</title>
    <link rel="stylesheet" href="Home.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="Lokasi" style="text-align: center; margin: 50px 0;">
        <h2>Log In</h2>
    </div>

    <div style="max-width: 400px; margin: 0 auto; padding: 20px; border: 2px solid #4682b4; border-radius: 10px;">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username or Email:</label>
                <input type="text" id="username" name="username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Log In</button>
        </form>

        <p style="text-align: center; margin-top: 20px;">
            Don't have an account? <a href="signup.php">Sign up here</a>
        </p>
    </div>
</body>
</html>
