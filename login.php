<?php
session_start();
include 'db.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Enter a valid email.";

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id, username, password_hash FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $username, $hash);
        if ($stmt->fetch()) {
            if (password_verify($password, $hash)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                header("Location: profile.php");
                exit;
            } else {
                $errors[] = "Wrong credentials.";
            }
        } else {
            $errors[] = "Wrong credentials.";
        }
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title></head>
<body>
<h1>Login</h1>
<?php foreach($errors as $e) echo "<p style='color:red;'>".htmlspecialchars($e)."</p>"; ?>
<form method="post">
  <input name="email" type="email" placeholder="Email" required><br>
  <input name="password" type="password" placeholder="Password" required><br>
  <button type="submit">Login</button>
</form>
<p><a href="register.php">Create account</a></p>
</body>
</html>