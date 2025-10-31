<?php
session_start();
include 'db.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if ($username === '') $errors[] = "Ievadi lietotāj vardu.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Izmato derīgu email.";
    if (strlen($password) < 6) $errors[] = "Parolē ir jābūt vismaz 6 simboli.";
    if ($password !== $password2) $errors[] = "Paroles nav vienādas!.";

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Emails jau ir izmantots!.";
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
<head>
    <meta charset="utf-8"><title>Register</title>
    <link href="forms.css" rel="stylesheet">
</head>
<body>
<form method="post" class="form">
    <p class="title">Reģistrēties </p>
    <p class="message">Reģistrējies lai varētu pilnīgi izmantot majaslapu! </p>
    <label>
            <input required="" placeholder="" type="text" class="input" name="username">
            <span>Lietotāj vards</span>
    </label>

    <label>
        <input name="email" required="" placeholder="" type="email" class="input">
        <span>Email</span>
    </label> 
        
    <label>
        <input name="password" required="" placeholder="" type="password" class="input">
        <span>Parole</span>
    </label>
    <label>
        <input name="password2" required="" placeholder="" type="password" class="input">
        <span>Atkartot paroli</span>
    </label>
    <?php foreach($errors as $e) echo "<p style='color:red;'>".htmlspecialchars($e)."</p>"; ?>
    <button type="submit" class="submit">Iesniegt</button>
    <p class="signin">Jau ir profils? <a href="login.php">Pieraksties!</a> </p>
</form>
</body>
</html>