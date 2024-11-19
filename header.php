<?php require_once __DIR__ . "/logic/data_handler.php"?>
<header>
    <a href="index.php"><h1>My Social Network</h1></a>
    <?php if (isset($_SESSION['currentUser'])):?>
    <a href="profile.php">
        <img src=<?php echo getImageUrl($_SESSION['currentUser']['profilePicture']?? null)?> alt="Photo" class="avatar">
    </a>
    <?php else:?>
        <img src=<?php echo getImageUrl(null)?> alt="Photo" class="avatar">
    <?php endif;?>
</header>