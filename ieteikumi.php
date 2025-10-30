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
    <Header class="header">
        <div class="home">
            <button class="home_button"></button>
        </div>
        <div>
            IETEIKUMI.lv
        </div>
        <div>
            <?php if (!isset($_SESSION['user_id'])): ?>
    <a href="register.php"><button>Reģistrēties</button></a>
    <a href="login.php"><button>Pieteikties</button></a>
<?php else: ?>
    <a href="profile.php"><button>Profils</button></a>
    <a href="logout.php"><button>Atteikties</button></a>
<?php endif; ?>
        </div>
</body>
</html>