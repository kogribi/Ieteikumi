<?php
session_start();
include 'connect.php';
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
                header("Location: ../profile.php");
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
    <link href="../css/forms.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<script>
        let darkmode = localStorage.getItem('darkmode')

        const enableDarkmode = () => {
            document.body.classList.add('darkmode')
            localStorage.setItem('darkmode', 'active')
        }

        const disableDarkmode = () => {
            document.body.classList.remove('darkmode')
            localStorage.setItem('darkmode', 'inactive')
        }

        if(darkmode === "active") enableDarkmode()

       
    </script>

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
  <p class="signin">Aiziet <a href="../ieteikumi.php">atpakaļ?</a> </p>
</form>
</body>
</html>