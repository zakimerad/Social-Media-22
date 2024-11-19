<form action="actions/login.php" method="post">
    <label for="email">
        <p>Email</p>
        <input type="text" name="email" placeholder="Entrez votre adresse mail">
    </label>
    <label for="password">
        <p>Mot de passe</p>
        <input type="password" name="password" placeholder="Entrez votre mot de passe">
    </label>
    <br>
    <button type="submit">Valider</button>
    <p><?php echo $_SESSION['error'] ?? ""?></p>
</form>