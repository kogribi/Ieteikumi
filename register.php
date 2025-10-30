<?php
session_start();
include 'db.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if ($username === '') $errors[] = "Enter username.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Enter a valid email.";
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
    if ($password !== $password2) $errors[] = "Passwords do not match.";

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Email is already registered.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username,email,password_hash) VALUES (?,?,?)");
            $stmt->bind_param("sss", $username, $email, $hash);
            if ($stmt->execute()) {
                $_SESSION['user_id'] = $conn->insert_id;
                $_SESSION['username'] = $username;
                header("Location: profile.php");
                exit;
            } else {
                $errors[] = "DB error: ".$conn->error;
            }
        }
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Register</title></head>
<body>
<h1>Register</h1>
<?php foreach($errors as $e) echo "<p style='color:red;'>".htmlspecialchars($e)."</p>"; ?>
<form method="post">
  <input name="username" placeholder="Username" required><br>
  <input name="email" type="email" placeholder="Email" required><br>
  <input name="password" type="password" placeholder="Password" required><br>
  <input name="password2" type="password" placeholder="Repeat password" required><br>
  <button type="submit">Register</button>
</form>
<p><a href="login.php">Already have an account? Log in</a></p>
</body>
</html>