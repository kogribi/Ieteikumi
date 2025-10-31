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
<head>
    <meta charset="utf-8"><title>Login</title>
    <link href="forms.css" rel="stylesheet">
</head>
<body>

<form method="post" class="form">
    <p class="title">Pieraksties </p>
    <p class="message">Pieraksties, lai izmantotu majaslapu. </p>
    <label>
  <input name="email" type="email"  required class="input">
  <span>Email</span>
    </label>
    <label>
  <input name="password" type="password"  required class="input">
  <span>Parole</span>
    </label>
  <button type="submit" class="submit">Login</button>
  <?php foreach($errors as $e) echo "<p style='color:red;'>".htmlspecialchars($e)."</p>"; ?>
  <p class="signin">Izveido profilu šeit! <a href="register.php">Reģistrēties</a> </p>
</form>
</body>
</html>