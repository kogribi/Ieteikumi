<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="ieteikumi.css" rel="stylesheet">
</head>
<body>
    <div class="min-h-screen max-w-full">
    <header class="header">
        <div class="title">
            Ieteikumi.lv
        </div>
        <div>
            <?php if (!isset($_SESSION['user_id'])): ?>
    <a href="register.php"><button class="boton-elegante">Reģistrēties</button></a>
    <a href="login.php"><button class="boton-elegante">Pieteikties</button></a>
<?php else: ?>
    <a href="profile.php"><button class="boton-elegante">Profils</button></a>
    <a href="logout.php"><button class="boton-elegante">Atteikties</button></a>
<?php endif; ?>
        </div>
    </header>
    <div class="sidebar">
       <a><div class="sidebar-options"><img width="25" height="25" src="https://img.icons8.com/ios/50/home--v1.png" alt="home--v1"/>Sākums</div></a>
       <div class="sidebar-options"><img width="25" height="25" src="https://img.icons8.com/ios/50/cutlery.png" alt="cutlery"/>Ēdieni</div>
    </div>
</body>
</html>