<?php require('views/layouts/header.php') ?>


<h1>Connexion :</h1>
<form action="<?= BASE_URL ?>/users/auth/" method="POST">
    <div class="form-group">
        <?= isset($_SESSION['___FLASH___']['errors']) ? '<div class="alert alert-danger" role="alert"> ' . $_SESSION['___FLASH___']['errors'] . ' </div>' : '' ?>
        <label for="exampleInputEmail1">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" placeholder="Nom d'utilisateur">
    </div>
    <div class=" form-group">
        <?= isset($_SESSION['___FLASH___']['errors']) ? '<div class="alert alert-danger" role="alert"> ' . $_SESSION['___FLASH___']['errors'] . ' </div>' : '' ?>
        <label for="exampleInputEmail1">Mot de passe</label>
        <input type="password" class="form-control" id="title" aria-describedby="emailHelp" name="password" placeholder="Mot de passe">
    </div>
    <button type="submit" class="btn btn-primary">Connexion</button>
</form>


<?php require('views/layouts/footer.php'); ?>
