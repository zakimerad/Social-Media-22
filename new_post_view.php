<?php require_once __DIR__."/logic/data_handler.php"?>
<?php if (isset($_SESSION['currentUser'])):?>
    <div class="container">
        <div class=new-post-top>
            <img src=<?php echo getImageUrl($_SESSION['currentUser']['profilePicture'] ?? null) ?> alt="logo" class='avatar'>
            <h3>Quoi de neuf?</h3>
        </div>
        <form action="actions/create_post.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="text" placeholder="Quoi de neuf?">
                <input type="file" name="file">
                <button type="submit">OK</button>
            </form>
            <p><?php echo $_SESSION['error_post'] ?? "" ?></p>
    </div>
<?php else:?>
    <h1>Veuillez vous connecter pour accéder au site</h1>
<?php endif;?> 