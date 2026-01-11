<?php
session_start();
require 'php/connect.php';
$result = $conn->query("SELECT * FROM recommendations ORDER BY created_at DESC"); //connects to database, sends command to sql, gives object with rows info about columns by the query
$recommendations = []; // array for the recomm
while ($row = $result->fetch_assoc()) { // makes each row an associative array
    $recommendations[] = $row; // add each row to the array
}

if (isset($_POST['genre'])){
     $_SESSION['selected_genre']=$_POST['genre'];
} else {
    $_SESSION['selected_genre']='Home';
}
?>



<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ieteikuki.lv ir vieta, kur var dalīties ar ieteikumiem!">
    <title>Ieteikumi.lv</title>
    <link href="css/ieteikumi.css" rel='stylesheet'>
</head>
<body>
    <div class="min-h-screen max-w-full">
        <header class="header">
            <div class="title">
                Ieteikumi.lv
            </div>
            <div>
                <a href="php/create.php">
                    <button class="button_create">
                        <span>Izveidot ieteikumu</span>
                        <img class="plus" width="25" height="25" src="https://img.icons8.com/ios/50/plus--v1.png" alt="home--v1"/>
                    </button>
                </a>
            </div>
            <div class="login_buttons">
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="php/register.php">
                        <button class="boton-elegante">
                            <span>Reģistrēties</span>
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/add-user-male.png" alt="home--v1"/>
                        </button>
                    </a>
                    <a href="php/login.php">
                        <button class="boton-elegante">
                            <span>Pieteikties</span>
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/login-rounded-right--v1.png" alt="home--v1"/>
                        </button>
                    </a>
                <?php else: ?>
                    <a href="profile.php">
                        <button class="boton-elegante">
                            <span>Profils</span>
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/user-male-circle--v1.png" alt="home--v1"/>
                        </button>
                    </a>
                    <a href="php/logout.php">
                        <button class="boton-elegante">
                            <span>Atteikties</span>
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/exit--v1.png" alt="home--v1"/>
                        </button>
                    </a>
                <?php endif; ?>
            </div>
        </header>
        <main>
            <div class="sidebar">
                <div>
                    <form method="post">
                        <button type="submit" name="genre" value="Home" class="sidebar-options<?php if ($_SESSION['selected_genre']==='Home'){echo " active";} ?>">
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/home--v1.png" alt="home--v1"/> <span>Sākums</span>
                        </button>

                        <button type="submit" name="genre" value="Food" class="sidebar-options<?php if ($_SESSION['selected_genre']==='Food'){echo " active";} ?>">
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/cutlery.png" alt="cutlery"/> <span>Ēdieni</span>
                        </button>

                        <button type="submit" name="genre" value="Video" class="sidebar-options<?php if ($_SESSION['selected_genre']==='Video'){echo " active";} ?>">
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/video-call.png" alt="video"/> <span>Video</span>
                        </button>

                        <button type="submit" name="genre" value="Games" class="sidebar-options<?php if ($_SESSION['selected_genre']==='Games'){echo " active";} ?>">
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/controller.png" alt="games"/> <span>Spēles</span>
                        </button>

                        <button type="submit" name="genre" value="Places" class="sidebar-options<?php if ($_SESSION['selected_genre']==='Places'){echo " active";} ?>">
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/national-park.png" alt="park"/> <span>Vietas</span>
                        </button>

                        <button type="submit" name="genre" value="Products" class="sidebar-options<?php if ($_SESSION['selected_genre']==='Products'){echo " active";} ?>">
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/product--v1.png" alt="product"/> <span>Produkti</span>
                        </button>

                        <button type="submit" name="genre" value="Activity" class="sidebar-options<?php if ($_SESSION['selected_genre']==='Activity'){echo " active";} ?>">
                            <img width="25" height="25" src="https://img.icons8.com/ios/50/running--v1.png" alt="product"/> <span>Aktivitāte</span>
                        </button>
                    </form>
                </div>
            
                <div style="place-items: center; margin-bottom: 30px; margin-top: 20px;">
                    <button id="theme-switch">
                        <img width="25" height="25" src="https://img.icons8.com/ios/50/sun--v1.png" alt="sun--v1"/>
                        <img width="25" height="25" src="https://img.icons8.com/ios/50/do-not-disturb-2.png" alt="do-not-disturb-2"/>
                    </button>
            </div>
    <script>
        let darkmode = localStorage.getItem('darkmode')
        const themeSwitch = document.getElementById('theme-switch')

        const enableDarkmode = () => {
            document.body.classList.add('darkmode')
            localStorage.setItem('darkmode', 'active')
        }

        const disableDarkmode = () => {
            document.body.classList.remove('darkmode')
            localStorage.setItem('darkmode', 'inactive')
        }

        if(darkmode === "active") enableDarkmode()

        themeSwitch.addEventListener("click", function() {
            darkmode = localStorage.getItem('darkmode')
            darkmode !== "active" ? enableDarkmode() : disableDarkmode()
        })
    </script>
            </div>
            <div class="outer_content">
                <div class="content">
                    <?php foreach ($recommendations as $rec) { ?> <!-- go through every item in array one by one and store each of them in $rec -->
                        <?php if ($_SESSION['selected_genre'] === 'Home') { ?>
                            <div class="item"
                                data-title="<?php echo htmlspecialchars($rec['title']); ?>"
                                data-image="<?php echo htmlspecialchars($rec['image'] ?? 'https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg'); ?>"
                                data-genre="<?php echo htmlspecialchars($rec['genre']); ?>"
                                data-rating="<?php echo htmlspecialchars($rec['rating']); ?>"
                                data-id="<?php echo htmlspecialchars($rec['id']); ?>"
                                data-user="<?php echo htmlspecialchars($rec['user']); ?>"
                                data-time="<?php echo htmlspecialchars($rec['time']); ?>"
                                data-price="<?php echo htmlspecialchars($rec['price']); ?>"
                                data-length="<?php echo htmlspecialchars($rec['length']); ?>"
                                data-created_at="<?php $date=new DateTime($rec['created_at']); echo htmlspecialchars(date_format($date,"Y-m-d")); ?>"
                                data-desc="<?php echo htmlspecialchars($rec['description'] ?? ''); ?>"
                                data-user_id="<?php echo htmlspecialchars($rec['user_id'] ?? ''); ?>">
                                <div class="images">
                                    <img alt="user_created" fetchpriority="high" width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
                                </div>
                                <div class="text">
                                    <div class="small_title"><?php echo $rec['title'] ?></div>
                                    <div class="ratings">
                                        <div class="rating">
                                            <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/>
                                            <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                                        </div>
                                        <div class="genre">
                                            <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/running--v1.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/>
                                            <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                                        </div>
                                        <div class="time">
                                            <img width="50" height="50" src="<?php if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/trail--v2.png";} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/>
                                            <div style="text-align:center;"><?php if($rec['genre']==='Vietas'){echo $rec['length'];} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo $rec['time'];} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo $rec['price'];} ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['selected_genre']==='Food' && $rec['genre']==='Ēdiens') { ?>
                            <div class="item"
                                data-title="<?php echo htmlspecialchars($rec['title']); ?>"
                                data-image="<?php echo htmlspecialchars($rec['image'] ?? 'https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg'); ?>"
                                data-genre="<?php echo htmlspecialchars($rec['genre']); ?>"
                                data-rating="<?php echo htmlspecialchars($rec['rating']); ?>"
                                data-id="<?php echo htmlspecialchars($rec['id']); ?>"
                                data-user="<?php echo htmlspecialchars($rec['user']); ?>"
                                data-time="<?php echo htmlspecialchars($rec['time']); ?>"
                                data-price="<?php echo htmlspecialchars($rec['price']); ?>"
                                data-length="<?php echo htmlspecialchars($rec['length']); ?>"
                                data-created_at="<?php $date=new DateTime($rec['created_at']); echo htmlspecialchars(date_format($date,"Y-m-d"));?>"
                                data-desc="<?php echo htmlspecialchars($rec['description'] ?? ''); ?>"
                                data-user_id="<?php echo htmlspecialchars($rec['user_id'] ?? ''); ?>">
                                <div class="images">
                                    <img alt="user_created" fetchpriority="high" width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
                                </div>
                                <div class="text">
                                    <div class="small_title"><?php echo $rec['title'] ?></div>
                                    <div class="ratings">
                                        <div class="rating">
                                            <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/>
                                            <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                                        </div>
                    <div class="genre">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/running--v1.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/>
                        <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                    </div>
                    <div class="time">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/trail--v2.png";} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/>
                        <div style="text-align:center;"><?php if($rec['genre']==='Vietas'){echo $rec['length'];} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo $rec['time'];} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo $rec['price'];} ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if ($_SESSION['selected_genre']==='Video' && $rec['genre']==='Video') { ?>
            <div class="item" data-title="<?php echo htmlspecialchars($rec['title']); ?>"
            data-image="<?php echo htmlspecialchars($rec['image'] ?? 'https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg'); ?>"
            data-genre="<?php echo htmlspecialchars($rec['genre']); ?>"
            data-rating="<?php echo htmlspecialchars($rec['rating']); ?>"
            data-id="<?php echo htmlspecialchars($rec['id']); ?>"
            data-user="<?php echo htmlspecialchars($rec['user']); ?>"
            data-time="<?php echo htmlspecialchars($rec['time']); ?>"
            data-price="<?php echo htmlspecialchars($rec['price']); ?>"
            data-length="<?php echo htmlspecialchars($rec['length']); ?>"
            data-created_at="<?php $date=new DateTime($rec['created_at']); echo htmlspecialchars(date_format($date,"Y-m-d")); ?>"
            data-desc="<?php echo htmlspecialchars($rec['description'] ?? ''); ?>"
            data-user_id="<?php echo htmlspecialchars($rec['user_id'] ?? ''); ?>"> 
            <div class="images">
                <img alt="user_created" fetchpriority="high" width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
            </div>
            <div class="text">
                <div class="small_title"><?php echo $rec['title'] ?></div>
                <div class="ratings">
                    <div class="rating">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/>
                        <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                    </div>
                    <div class="genre">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/running--v1.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/>
                        <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                    </div>
                    <div class="time">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/trail--v2.png";} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/>
                        <div style="text-align:center;"><?php if($rec['genre']==='Vietas'){echo $rec['length'];} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo $rec['time'];} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo $rec['price'];} ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if ($_SESSION['selected_genre']==='Games' && $rec['genre']==='Spēles') { ?>
            <div class="item" data-title="<?php echo htmlspecialchars($rec['title']); ?>"
            data-image="<?php echo htmlspecialchars($rec['image'] ?? 'https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg'); ?>"
            data-genre="<?php echo htmlspecialchars($rec['genre']); ?>"
            data-rating="<?php echo htmlspecialchars($rec['rating']); ?>"
            data-id="<?php echo htmlspecialchars($rec['id']); ?>"
            data-user="<?php echo htmlspecialchars($rec['user']); ?>"
            data-time="<?php echo htmlspecialchars($rec['time']); ?>"
            data-price="<?php echo htmlspecialchars($rec['price']); ?>"
            data-length="<?php echo htmlspecialchars($rec['length']); ?>"
            data-created_at="<?php $date=new DateTime($rec['created_at']); echo htmlspecialchars(date_format($date,"Y-m-d")); ?>"
            data-desc="<?php echo htmlspecialchars($rec['description'] ?? ''); ?>"
            data-user_id="<?php echo htmlspecialchars($rec['user_id'] ?? ''); ?>"> 
            <div class="images">
                <img alt="user_created" fetchpriority="high" width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
            </div>
            <div class="text">
                <div class="small_title"><?php echo $rec['title'] ?></div>
                <div class="ratings">
                    <div class="rating">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/>
                        <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                    </div>
                    <div class="genre">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/running--v1.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/>
                        <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                    </div>
                    <div class="time">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/trail--v2.png";} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/>
                        <div style="text-align:center;"><?php if($rec['genre']==='Vietas'){echo $rec['length'];} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo $rec['time'];} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo $rec['price'];} ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if ($_SESSION['selected_genre']==='Places' && $rec['genre']==='Vietas') { ?>
            <div class="item" data-title="<?php echo htmlspecialchars($rec['title']); ?>"
            data-image="<?php echo htmlspecialchars($rec['image'] ?? 'https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg'); ?>"
            data-genre="<?php echo htmlspecialchars($rec['genre']); ?>"
            data-rating="<?php echo htmlspecialchars($rec['rating']); ?>"
            data-id="<?php echo htmlspecialchars($rec['id']); ?>"
            data-user="<?php echo htmlspecialchars($rec['user']); ?>"
            data-time="<?php echo htmlspecialchars($rec['time']); ?>"
            data-price="<?php echo htmlspecialchars($rec['price']); ?>"
            data-length="<?php echo htmlspecialchars($rec['length']); ?>"
            data-created_at="<?php $date=new DateTime($rec['created_at']); echo htmlspecialchars(date_format($date,"Y-m-d")); ?>"
            data-desc="<?php echo htmlspecialchars($rec['description'] ?? ''); ?>"
            data-user_id="<?php echo htmlspecialchars($rec['user_id'] ?? ''); ?>"> 
            <div class="images">
                <img alt="user_created" fetchpriority="high" width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
            </div>
            <div class="text">
                <div class="small_title"><?php echo $rec['title'] ?></div>
                <div class="ratings">
                    <div class="rating">
                        <img alt="user_created" width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/>
                        <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                    </div>
                    <div class="genre">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/running--v1.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/>
                        <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                    </div>
                    <div class="time">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/trail--v2.png";} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/>
                        <div style="text-align:center;"><?php if($rec['genre']==='Vietas'){echo $rec['length'];} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo $rec['time'];} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo $rec['price'];} ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if ($_SESSION['selected_genre']==='Products' && $rec['genre']==='Produkti') { ?>
            <div class="item" data-title="<?php echo htmlspecialchars($rec['title']); ?>"
            data-image="<?php echo htmlspecialchars($rec['image'] ?? 'https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg'); ?>"
            data-genre="<?php echo htmlspecialchars($rec['genre']); ?>"
            data-rating="<?php echo htmlspecialchars($rec['rating']); ?>"
            data-id="<?php echo htmlspecialchars($rec['id']); ?>"
            data-user="<?php echo htmlspecialchars($rec['user']); ?>"
            data-time="<?php echo htmlspecialchars($rec['time']); ?>"
            data-price="<?php echo htmlspecialchars($rec['price']); ?>"
            data-length="<?php echo htmlspecialchars($rec['length']); ?>"
            data-created_at="<?php $date=new DateTime($rec['created_at']); echo htmlspecialchars(date_format($date,"Y-m-d"));?>"
            data-desc="<?php echo htmlspecialchars($rec['description'] ?? ''); ?>"
            data-user_id="<?php echo htmlspecialchars($rec['user_id'] ?? ''); ?>"> 
            <div class="images">
                <img alt="user_created" fetchpriority="high" width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
            </div>
            <div class="text">
                <div class="small_title"><?php echo $rec['title'] ?></div>
                <div class="ratings">
                    <div class="rating">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/>
                        <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                    </div>
                    <div class="genre">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/running--v1.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/>
                        <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                    </div>
                    <div class="time">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/trail--v2.png";} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/>
                        <div style="text-align:center;"><?php if($rec['genre']==='Vietas'){echo $rec['length'];} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo $rec['time'];} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo $rec['price'];} ?></div>
                    </div>
                </div>
            </div>
                        </div>
            <?php } ?>
            <?php if ($_SESSION['selected_genre']==='Activity' && $rec['genre']==='Aktivitāte') { ?>
            <div class="item" data-title="<?php echo htmlspecialchars($rec['title']); ?>"
            data-image="<?php echo htmlspecialchars($rec['image'] ?? 'https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg'); ?>"
            data-genre="<?php echo htmlspecialchars($rec['genre']); ?>"
            data-rating="<?php echo htmlspecialchars($rec['rating']); ?>"
            data-id="<?php echo htmlspecialchars($rec['id']); ?>"
            data-user="<?php echo htmlspecialchars($rec['user']); ?>"
            data-time="<?php echo htmlspecialchars($rec['time']); ?>"
            data-price="<?php echo htmlspecialchars($rec['price']); ?>"
            data-length="<?php echo htmlspecialchars($rec['length']); ?>"
            data-created_at="<?php $date=new DateTime($rec['created_at']); echo htmlspecialchars(date_format($date,"Y-m-d")); ?>"
            data-desc="<?php echo htmlspecialchars($rec['description'] ?? ''); ?>"
            data-user_id="<?php echo htmlspecialchars($rec['user_id'] ?? ''); ?>"
            > 
            <div class="images">
                <img alt="user_created" fetchpriority="high" width="100%" height="100%" class="image" src="<?php if (isset($rec['image'])){ echo $rec['image'];}else{ echo "https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg";}?>"/>
            </div>
            <div class="text">
                <div class="small_title"><?php echo $rec['title'] ?></div>
                <div class="ratings">
                    <div class="rating">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/rating.png" alt="rating"/>
                        <div style="text-align:center;"><?php echo $rec['rating'] ?><img class="small_star" width="15" height="15" src="https://img.icons8.com/ios/50/star--v1.png" alt="star--v1"/></div>
                    </div>
                    <div class="genre">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Ēdiens'){echo "https://img.icons8.com/ios/50/cutlery.png";}if($rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/running--v1.png";}if($rec['genre']==='Video'){echo "https://img.icons8.com/ios/50/video-call.png";}if($rec['genre']==='Spēles'){echo "https://img.icons8.com/ios/50/controller.png";}if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/national-park.png";}if($rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/product--v1.png";}
                          ?>" alt="cutlery"/>
                        <div style="text-align:center;"><?php echo $rec['genre'] ?></div>
                    </div>
                    <div class="time">
                        <img width="50" height="50" src="<?php if($rec['genre']==='Vietas'){echo "https://img.icons8.com/ios/50/trail--v2.png";} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo "https://img.icons8.com/ios/50/time_2.png";} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo "https://img.icons8.com/ios/50/price-tag-euro.png";} ?>" alt="time_2"/>
                        <div style="text-align:center;"><?php if($rec['genre']==='Vietas'){echo $rec['length'];} if($rec['genre']==='Video' || $rec['genre']==='Aktivitāte'){echo $rec['time'];} if($rec['genre']==='Ēdiens' || $rec['genre']==='Spēles' || $rec['genre']==='Produkti'){echo $rec['price'];} ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
                </div>
            </div>
        </main>
    </div>
    <?php 
    $user_id = $_SESSION['user_id'] ?? null;
    $liked_posts = [];
    if ($user_id) {
    $result = $conn->query("SELECT post_id FROM likes WHERE user_id = $user_id");
    while ($row = $result->fetch_assoc()) {
        $liked_posts[] = (int)$row['post_id'];
    }
}
     ?>
<script>
    const likedPosts = <?= json_encode($liked_posts) ?>;
</script>
    <div id="myModal" class="modal">
        
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="Modal_id" ></div>
        <div id="Modal_title" ></div>
        <div class="Modal_img_container"><img id="Modal_image"></div>
        <div class="Modal_container">
        <div class="Modal_ratings_container">
        <div class="delete-post">
        <button class="btn" id="delete" data-post-id="" data-user-id="">
            <svg viewBox="0 0 15 17.5" height="17.5" width="15" xmlns="http://www.w3.org/2000/svg" class="icon">
                <path transform="translate(-2.5 -1.25)" d="M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z" id="Fill"></path>
            </svg>
        </button>
        </div>
        <div>
            <div id="Modal_genre_image_container"> <img  src="https://img.icons8.com/ios/50/image--v1.png" alt="selection" class="Modal_rating_image"> </div>
            <div id="Modal_genre"> </div>
        </div>
        <div>
            <div id="Modal_rating_image_container"> <img  src="https://img.icons8.com/ios/50/rating.png" alt="selection" class="Modal_rating_image"> </div>
            <div id="Modal_rating"></div>
        </div>
        <div>
            <div id="Modal_time_image_container"> <img  src="https://img.icons8.com/ios/50/time_2.png" alt="selection" class="Modal_rating_image"> </div>
            <div id="Modal_time" ></div>
        </div>
        <div>
            <div id="Modal_price_image_container"> <img  src="https://img.icons8.com/ios/50/price-tag-euro.png" alt="selection" class="Modal_rating_image"> </div>
            <div id="Modal_price" ></div>
        </div>
        <div>
            <div id="Modal_length_image_container"> <img  src="https://img.icons8.com/ios/50/trail--v2.png" alt="selection" class="Modal_rating_image"> </div>
            <div id="Modal_length" ></div>
        </div>
        <div class="like_container">
            <label class="like">
                <input id="like" type="checkbox" data-post-id="">
                    <div class="checkmark">
                    <svg viewBox="0 0 256 256">
                <rect fill="none" height="256" width="256"></rect>
                <path d="M224.6,51.9a59.5,59.5,0,0,0-43-19.9,60.5,60.5,0,0,0-44,17.6L128,59.1l-7.5-7.4C97.2,28.3,59.2,26.3,35.9,47.4a59.9,59.9,0,0,0-2.3,87l83.1,83.1a15.9,15.9,0,0,0,22.6,0l81-81C243.7,113.2,245.6,75.2,224.6,51.9Z" stroke-width="20px" stroke="#808080" fill="none"></path></svg>
            </div>
        </label>
        </div>
        </div>
        </div>
        <div class="Modal_main_content">
            <div class="Modal_info">
            <div class="Modal_user_div">
            <div id="Modal_user_image_container"> <img width="50" height="50" src="https://img.icons8.com/ios/50/user--v1.png" alt="selection"> </div>
            <div id="Modal_user" ></div>
            </div>
            <div class="Modal_created_at">
            <div id="Modal_created_at_image_container"> <img width="50" height="50" src="https://img.icons8.com/ios/50/calendar--v1.png" alt="selection"> </div>
            <div id="Modal_created_at" ></div>
            </div>
            </div>
            <div class="Modal_desc_container">
            <div id="Modal_desc" ></div>
            </div>
        </div>
        </div>
<script>
const CurrentUserId = "<?php if(isset($_SESSION['user_id'])) {echo $_SESSION['user_id'];}else{echo "false";} ?>";
var items = document.querySelectorAll('.item');

items.forEach(function(item) {
    item.addEventListener('click', function() {
        var id = parseInt(item.dataset.id);

        
        document.getElementById('Modal_title').textContent = item.dataset.title;
        document.getElementById('Modal_image').src = item.dataset.image;
        document.getElementById('Modal_genre').textContent = item.dataset.genre;
        document.getElementById('Modal_rating').textContent = item.dataset.rating;
        document.getElementById('Modal_id').textContent = id;
        document.getElementById('Modal_user').textContent = item.dataset.user;
        document.getElementById('Modal_time').textContent = item.dataset.time;
        document.getElementById('Modal_price').textContent = item.dataset.price;
        document.getElementById('Modal_length').textContent = item.dataset.length;
        document.getElementById('Modal_created_at').textContent = item.dataset.created_at;
        document.getElementById('Modal_desc').textContent = item.dataset.desc;
        document.getElementById('delete').dataset.postId = id;
        document.getElementById('delete').dataset.userId = item.dataset.user_id;
        var PostUserId = document.getElementById('delete').dataset.userId;

        if(CurrentUserId !== PostUserId){
            document.getElementById("delete").style.display = "none";
        }else{
            document.getElementById("delete").style.display = "block";
        }

        
        var likeCheckbox = document.getElementById('like');
        likeCheckbox.checked = likedPosts.includes(id);
        likeCheckbox.dataset.postId = id;

       
        likeCheckbox.replaceWith(likeCheckbox.cloneNode(true));
        likeCheckbox = document.getElementById('like');

        likeCheckbox.addEventListener('click', function() {
            var postId = parseInt(this.dataset.postId);
            var liked = this.checked;

            
            var svgPath = this.querySelector('path');
            if (svgPath) svgPath.setAttribute('fill', liked ? '#FF0000' : 'none');

            
            if (liked) {
                if (!likedPosts.includes(postId)) likedPosts.push(postId);
            } else {
                var index = likedPosts.indexOf(postId);
                if (index > -1) likedPosts.splice(index, 1);
            }

            
            fetch('php/like.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'post_id=' + postId + '&liked=' + (liked ? 1 : 0)
            })
            .then(function(res) { return res.text(); })
            .then(function(data) {
                console.log('Like updated:', data);
                if (data=="Nav pieteicies"){
                    window.location.replace("php/register.php");
                }
            })
            .catch(function(err) {
                console.error(err);
            });
        });
        var deletePost = document.getElementById('delete');
        deletePost.addEventListener('click', async function() {
        let postId = this.dataset.postId;
        let userId = this.dataset.userId;
         await fetch('php/delete_post.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'post_id=' + postId + '&user_id=' + userId
        });
        location.reload();
        });
        document.getElementById('myModal').style.display = "block";
    });
});
                  
var span = document.getElementsByClassName("close")[0];
var modal = document.getElementById("myModal");

span.onclick = function() {
    modal.style.display = "none";
};

window.onclick = function(event) {
    if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>
        </div>
    </main>
    </div>
</body>
</html>

