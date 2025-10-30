<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Profile</title></head>
<body>
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
<p><a href="logout.php">Logout</a></p>
<p><a href="ieteikumi.php"><button>Home</button></a></p>
</body>
</html>