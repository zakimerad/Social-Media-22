<?php if (isset($_SESSION['currentUser'])) : ?>
    <h1 class="welcome">Bienvenue <?php echo $_SESSION['currentUser']['username'] ?? "Inconnu"?></h1>
<?php else : ?>
    <div class="container">
        <div class="button-stack">
            <div class="button">
                <a href="index.php?log=connect">Se Connecter</a>
            </div>
            <div class="button">
                <a href="index.php?log=create">Créer un compte</a>
            </div>
        </div>
        <hr>
        <?php if(isset($_GET['log']) && $_GET['log'] == "create"):?>
            <?php require_once __DIR__."/create_user_view.php"; ?>
        <?php else:?>
            <?php require_once __DIR__."/log_view.php"; ?>
        <?php endif;?>
    </div>
<?php endif; ?>